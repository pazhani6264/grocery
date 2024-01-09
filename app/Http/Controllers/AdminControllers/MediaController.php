<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Lang;
use DB;

class MediaController extends Controller
{
    //
    public function __construct(Images $images, Setting $setting)
    {
        $this->Images = $images;
        $this->Setting = $setting;

    }

    public function refresh()
    {
        $Images = new Images();
        $allimage = $Images->getimages();
        return view("admin.media.loadimages")->with('allimage', $allimage);
    }

    public function display()
    {
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.media.index")->with('result', $result);
    }

    public function updatemediasetting(Request $request)
    {
        $messages = "Content has been updated successfully!";

        try {
            $setting = new Setting;
            $mediasetting = $setting->settingmedia($request);

            if(isset($request->regenrate) and $request->regenrate=='yes'){
                $Images = new Images();
                $regenrate = $Images->regenrateAll($request);
                $messages =  Lang::get("labels.Setting and Sizes are updated now");
            }    

            return redirect()->back()->with('update', $messages);

        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Redirect::back()->withErrors($messages)->withInput($request->all());
        }

    }

    public function add()
    {
        $Images = new Images();
        $images = $Images->getimages();
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin.media.addimages')->with('images', $images)->with('result', $result);
    }

    public function fileUpload(Request $request)
    {

        $result['commonContent'] = $this->Setting->commonContent();
        $val=$result['commonContent']['setting']['image_upload'];
       /*  if($val=='1'){ */
        // Creating a new time instance, we'll use it to name our file and declare the path
        $time = Carbon::now();
        // Requesting the file from the form
        $image = $request->file('file');
        $extensions = Setting::imageType();
        if ($request->hasFile('file') and in_array($request->file->extension(), $extensions)) {

            // getting size
            $size = getimagesize($image);
            list($width, $height, $type, $attr) = $size;
            // Getting the extension of the file
            $extension = $image->getClientOriginalExtension();
            // Creating the directory, for example, if the date = 18/10/2017, the directory will be 2017/10/
          
           
            // Creating the file name: random string followed by the day, random number and the hour
            $filename = str_random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
            // This is our upload main function, storing the image in the storage that named 'public'
            if($val=='1'){
                $directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
                $upload_success = $image->storeAs($directory, $filename, 'public');
                $Path = 'images/media/' . $directory . '/' . $filename;
                $Paths = 'images/media/' . $directory . '/';
                $Pathss = 'images/media/' . $directory . '/' . $filename;
                $pathtype = 'local';
                $Images = new Images();
                $imagedata = $Images->imagedata($filename, $Pathss,  $width, $height,$pathtype);
            }
            else
            {
                $resuluser = DB::table('users')->where('role_id', 1)->first();

                $result['commonContent'] = $this->Setting->commonContent();
                $aws_url=$result['commonContent']['setting']['aws_url'];
                $directory = $resuluser->user_name .'/' . date_format($time, 'Y') . '/' . date_format($time, 'm');
                $upload_success = $image->storeAs($directory, $filename, 'public');
                $image->storeAs($directory, $filename, 's3');
                $Path = 'images/media/' . $directory . '/' . $filename;
                $Paths = $aws_url . $directory . '/';
                $Pathss = $aws_url . $directory . '/' . $filename;
                $pathtype = 'aws';
                $Images = new Images();
                $imagedata = $Images->imagedata($filename, $Pathss,  $width, $height,$pathtype);
            }

            //store DB
          
           

            $AllImagesSettingData = $Images->AllimagesHeightWidth();

           
                switch (true) {
                    case ($width >= $AllImagesSettingData[5]->value || $height >= $AllImagesSettingData[4]->value):
                        $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        $largeimage = $this->storeLarge($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        break;
                    case ($width >= $AllImagesSettingData[3]->value || $height >= $AllImagesSettingData[2]->value):
                        $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        $mediumimage = $this->storeMedium($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
                        //                $storeLargeImage = $Images->Largerecord($filename,$Path,$width,$height);
                        break;
                    case ($width >= $AllImagesSettingData[0]->value || $height >= $AllImagesSettingData[1]->value):
                        $tuhmbnail = $this->storeThumbnial($Path, $filename, $directory, $filename,$pathtype,$Paths,$val);
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
 
            
       

        } else {
            return "Invalid Image";
        }

    /* }else{
        $time = Carbon::now();
        $image = $request->file('file');
        $extensions = Setting::imageType();
        if ($request->hasFile('file') and in_array($request->file->extension(), $extensions)) {
           // getting size
            $size = getimagesize($image);
            list($width, $height, $type, $attr) = $size;
            // Getting the extension of the file
            $extension = $image->getClientOriginalExtension();
            //$imageName=time().$image->getClientOriginalName();

             $filename = str_random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
             $filePath = 'pc-grocery/' . $filename;
             Storage::disk('s3')->put($filePath, file_get_contents($image));
              return "success";
             
        }else{
            return "Invalid Image";
        } 
    } */

    }

    public function storeThumbnial($Path, $filename, $directory, $input,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $thumbnail_values = $Images->thumbnailHeightWidth();

        $originalImage = $Path;
        $time = time();

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $thumbnail_values[1]->value,

            'height' => $thumbnail_values[0]->value,

            'grayscale' => false));

        $namethumbnail = $thumbnailImage->save($destinationPath . 'thumbnail' . $time . $filename);
        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/thumbnail' . $time . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }
       
      
        $Path = 'images/media/' . $directory . '/' . 'thumbnail' . $time . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;
       
        $Paths = $Paths . 'thumbnail' . $time . $filename;

        $storethumbnail = $Images->thumbnailrecord($input, $Paths, $width, $height ,$pathtype);

        return $namethumbnail;
    }

    public function storeMedium($Path, $filename, $directory, $input ,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $Medium_values = $Images->MediumHeightWidth();

        $originalImage = $Path;

        $time = time();

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Medium_values[1]->value,

            'height' => $Medium_values[0]->value,

            'grayscale' => false));
        $namemedium = $thumbnailImage->save($destinationPath . 'medium' . $time . $filename);

        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/medium' . $time . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }

       

        $Path = 'images/media/' . $directory . '/' . 'medium' . $time . $filename;

        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $Paths = $Paths . 'medium' . $time . $filename;

        $storeMediumImage = $Images->Mediumrecord($input, $Paths, $width, $height ,$pathtype);

        return $namemedium;
    }

    public function storeLarge($Path, $filename, $directory, $input ,$pathtype,$Paths,$val)
    {
        $Images = new Images();
        $Large_values = $Images->LargeHeightWidth();

        $originalImage = $Path;
        $time = time();

        $destinationPath = public_path('images/media/' . $directory . '/');
        $thumbnailImage = Image::make($originalImage, array(

            'width' => $Large_values[1]->value,

            'height' => $Large_values[0]->value,

            'grayscale' => false));
//        $upload_success = $thumbnailImage->save($directory, $filename, 'public');
        $namelarge = $thumbnailImage->save($destinationPath . 'large' . $time . $filename);

        if($val != 1)
        {
            Storage::disk('s3')->put($directory .'/large' . $time . $filename,$thumbnailImage->__toString(), ['visibility' => 'public']);
        }

        


        $Path = 'images/media/' . $directory . '/' . 'large' . $time . $filename;
        $destinationFile = public_path($Path);
        $size = getimagesize($destinationFile);
        list($width, $height, $type, $attr) = $size;

        $Paths = $Paths . 'large' . $time . $filename;
        $storeLargeImage = $Images->Largerecord($input, $Paths, $width, $height ,$pathtype);

        return $namelarge;
    }

    public function detailimage($id)
    {
        $Images = new Images();
        $images = $Images->getimagedetail($id);
        //dd($imageDetail);
        //$returnHTML = view('admin.modal-body-view')->with('imageDetail', $imageDetail);
        $result['images'] = $images;
        $result['commonContent'] = $this->Setting->commonContent();
        $returnHTML = view('admin.media.detail')->with('result', $result);

        return ($returnHTML);

    }

    public function regenerateimage(Request $request)
    {
        $Images = new Images();
        $images = $Images->regenerate($request->image_id, $request->id, $request->width, $request->height);
        //dd($imageDetail);
        //$returnHTML = view('admin.modal-body-view')->with('imageDetail', $imageDetail);
        $result['images'] = $images;
        $result['commonContent'] = $this->Setting->commonContent();
        return redirect()->back()->with('success', Lang::get("labels.imageresizedmsg"));
    }

    public function deleteimage(Request $request)
    {
        $images = explode(",", $request->images);
        foreach ($images as $image) {
            $Images = new Images();
            $imagedelete = $Images->imagedelete($image);
        }
        return 'success';

    }

}
