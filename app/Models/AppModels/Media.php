<?php
	namespace App\Models\AppModels;

	use Illuminate\Database\Eloquent\Model;
	use App\Http\Controllers\Admin\AdminSiteSettingController;
	use App\Http\Controllers\Admin\AdminCategoriesController;
	use App\Http\Controllers\Admin\AdminProductsController;
	use App\Http\Controllers\App\AppSettingController;
	use App\Http\Controllers\App\AlertController;
	

	use DB;
	use Lang;

	use Illuminate\Foundation\Auth\ThrottlesLogins;
	
	use Validator;
	use Mail;
	use DateTime;
	use Auth;
	//use Carbon;
	use Carbon\Carbon;

	class Media extends Model{

		public static function getimages($request){

		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		if($authenticate==1){

			
			if($request->perpage == ""){
				$perPage = 10;
			}else{
				$perPage = $request->perpage;
			}
			if ($request->pageno == "") {
                $skip = 0;
            }else {
               $skip = $perPage * $request->pageno;
            }
	       $allimagesth = DB::table('images')
	            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
	            ->select('path','images.id','image_type','path_type')
	            ->where('image_categories.image_type','THUMBNAIL')
	            ->orderby('images.id','DESC')
	            ->skip($skip)
        		->take($perPage)
	            ->get();
	        $allimages = DB::table('images')
	            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
	            ->select('path','images.id','image_type','path_type')
	            ->where('image_categories.image_type','ACTUAL')
	            ->orderby('images.id','DESC')
	            ->skip($skip)
        		->take($perPage)
	            ->get();

	         $result =$allimages->merge($allimagesth)->keyBy('id');
	         $responseData = array('success'=>'1','message'=>"Returned all image",'data'=>$allimagesth);

    	}else{
    		$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
    	}

    	$mediaResponse = json_encode($responseData);
			 return $mediaResponse;

    }

    public static function addimages($request)
    {
    	$authController = new AppSettingController();

    	$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
    	if($authenticate==1){

		$setting = $authController->getSetting();
		$val=$setting['image_upload'];
		$time = Carbon::now();

		$image = $request->file('file');
		//print_r($image);die();
		if($request->file('file') == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
		}else{
			 foreach($request->file('file') as $file){
			 	$size = getimagesize($file);
			 	list($width, $height, $type, $attr) = $size;
			 	$extension = $file->getClientOriginalExtension();

			 	$filename = str_random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

			 	 if($val=='1'){

			 	 	$directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
			 	 	$upload_success = $file->storeAs($directory, $filename, 'public');
			 	 	$Path = 'images/media/' . $directory . '/' . $filename;
			 	 	$Paths = 'images/media/' . $directory . '/';
			 	 	$Pathss = 'images/media/' . $directory . '/' . $filename;
			 	 	$pathtype = 'local';
			 	 	$imageicon = $authController->imagedata($filename,$Pathss, $Path, $width, $height,$pathtype);

			 	 }else{

					$resuluser = DB::table('users')->where('role_id', 1)->first();

			 	 	$aws_url=$setting['aws_url'];
			 	 	$directory =  $resuluser->user_name .'/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
			 	 	$upload_success = $file->storeAs($directory, $filename, 'public');
			 	 	$file->storeAs($directory, $filename, 's3');
			 	 	$Path = 'images/media/' . $directory . '/' . $filename;
			 	 	$Paths = $aws_url . $directory . '/';
			 	 	$Pathss = $aws_url . $directory . '/' . $filename;
			 	 	$pathtype = 'aws';
			 	 	$imageicon = $authController->imagedata($filename, $Pathss,$Path ,$width, $height,$pathtype);
			 	 }

			 	 $AllImagesSettingData = $authController->AllimagesHeightWidth();

			 	 switch (true) {
                    case ($width >= $AllImagesSettingData[5]->value || $height >= $AllImagesSettingData[4]->value):
                        $tuhmbnail = $authController->storeThumbnialApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        $mediumimage = $authController->storeMediumApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        //$largeimage = $authController->storeLargeApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        break;
                    case ($width >= $AllImagesSettingData[3]->value || $height >= $AllImagesSettingData[2]->value):
                        $tuhmbnail =$authController->storeThumbnialApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        $mediumimage = $authController->storeMediumApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                        break;
                    case ($width >= $AllImagesSettingData[0]->value || $height >= $AllImagesSettingData[1]->value):
                        $tuhmbnail = $authController->storeThumbnialApp($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                        //                $storeMediumImage = $Images->Mediumrecord($filename,$Path,$width,$height);

                        break;
                        //            default:
                        //                $tuhmbnail = $this->storeThumbnial($Path,$filename,$directory,$filename);
                        //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                        //                $storeMediumImage = $Images->Mediumrecord($filename,$Path,$width,$height);
                }

	                if($val!='1'){
	                    $folder_path = 'images/media/'.$directory;
	                    $files = glob($folder_path.'/*'); 
	                    
	                    // Deleting all the files in the list
	                    foreach($files as $file) {
	                        if(is_file($file)) 
	                            // Delete the given file
	                            unlink($file); 
	                    }
	                    
	                }
			 }
			 $responseData = array('success'=>'1','message'=>"Image added successfully");
		}
	}else{
		$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");	
	}
		$mediaResponse = json_encode($responseData);
        return $mediaResponse;
		//print_r($time);die();
    }

     public function storeThumbnial($Path, $filename, $directory, $input,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $thumbnail_values = $Images->thumbnailHeightWidth();

        $originalImage = $Path;

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values[1]->value,

            'height' => $thumbnail_values[0]->value,

            'grayscale' => false));

        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . time() . $filename);
        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/thumbnail' . time() . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }
       
      
        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . time() . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
       
        $Paths = $Paths . 'thumbnail' . time() . $filename;

        //$storethumbnail = $Images->thumbnailrecord($input, $Paths, $width, $height ,$pathtype);
        $storethumbnail = $authController->thumbnailrecord($input, $Path, $width, $height,$pathtype);

        return $namethumbnail;
    }
}
?>