<?php
namespace App\Models\AppModels;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\App\AppSettingController;
use App\Http\Controllers\App\AlertController;
use DB;
use Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Mail;
use DateTime;
use Auth;
use Carbon;

class Loyalty extends Model
{
	public static function getloyalty($request)
	{
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
			 $language_id=$request->language_id;

			 $items = DB::table('earn_points_settings')
                       ->leftJoin('image_categories', 'earn_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('earn_points_description', 'earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
                        ->select('earn_points_settings.*', 'image_categories.path as image_path','image_categories.path_type as path_type','earn_points_description.earn_points_title', 'earn_points_description.earn_points_description')
                        ->where('earn_points_description.language_id', '=', $language_id)
                        ->where('earn_points_settings.status', 1)
                        ->groupBy('earn_points_settings.id')
                         ->get();

                $redeem = DB::table('redeem_points_settings')
                       ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->select('redeem_points_settings.*', 'image_categories.path as image_path', 'image_categories.path_type as path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
                        ->where('redeem_points_description.language_id', '=', $language_id)
                        ->where('redeem_points_settings.status', 1)
                        ->groupBy('redeem_points_settings.id')
                         ->get();


	              if(!empty($items)){
	              	$earn_points=$items;
	              }else{
	              	$earn_points=[];
	              }

	              if(!empty($redeem)){
	              	$redeem_points=$redeem;
	              }else{
	              	$redeem_points=[];
	              }

			 $responseData = array('success'=>'1','message'=>"Returned all loyalty",'earn_points'=>$earn_points,'redeem_points'=>$redeem_points);
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}

		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;
	}

	public static function availablecoupon($request)
	{
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
			$currentDate = date('Y-m-d');
			$language_id = $request->language_id;
			$customers_id = $request->customers_id;

			$user = DB::table('users')->where([['id', '=', $customers_id],['role_id', '=', '2']])->first();
			if($user){
				$redeem = DB::table('redeem_points_settings')
                       ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
                       ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->select('redeem_points_settings.*', 'image_categories.path as image_path', 'image_categories.path_type as path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
                        ->whereIn('redeem_points_settings.discount_type', ['percent', 'fixed_cart'])
                        ->where('redeem_points_description.language_id', '=', $language_id)
                        ->where('redeem_points_settings.status', 1)
                        ->groupBy('redeem_points_settings.id')
                         ->get();


			              $items=DB::table('coupons')
			            ->leftJoin('image_categories', 'coupons.image', '=', 'image_categories.image_id')
			             ->select('coupons.*', 'image_categories.path as image_path','image_categories.path_type as path_type')
			             ->whereIn('coupons.discount_type', ['percent', 'fixed_cart'])
			             ->whereDate('expiry_date','>',$currentDate)
			             ->groupBy('coupons.coupans_id')
			             ->get();

                if(!empty($redeem)){
	              	$redeem_points=$redeem;
	             }else{
	              	$redeem_points=[];
	             }

	             if(!empty($items)){
	              	$voucher=$items;
	              }else{
	              	$voucher=[];
	              }

	             $responseData = array('success'=>'1','message'=>"Returned all available coupon",'redeem_points'=>$redeem_points,'voucher'=>$voucher);

			}else{
				$responseData = array('success'=>'0','message'=>"Invalid customers id");
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;
	}
  public static function applyredeempoints($request)
  {
  		$consumer_data 		 				  =  array();
		$consumer_data['consumer_key'] 	 	  =  request()->header('consumer-key');
  		$consumer_data['consumer_secret']	  =  request()->header('consumer-secret');
		$consumer_data['consumer_nonce']	  =  request()->header('consumer-nonce');
		$consumer_data['consumer_device_id']  =  request()->header('consumer-device-id');
		$consumer_data['consumer_ip']  =  request()->header('consumer-ip');
		$consumer_data['consumer_url']  	  =  __FUNCTION__;
		$authController = new AppSettingController();
		$authenticate = $authController->apiAuthenticate($consumer_data);
		$currentDate = date('Y-m-d');
		$settings = $authController->getSetting();
        $voucher_redeem =$settings['voucher_redeem'];
		if($authenticate==1){

			if($request->customers_id == ''|| $request->redeemid == ''|| $request->total == '' || $request->transaction_id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$gettype=DB::table('transaction_points')->where('user_id', $request->customers_id)->where('id', $request->transaction_id)->first();
			
				if($gettype){
				
					if($gettype->type == 'Active')
					{
						$check=DB::table('redeem_points_voucher')->where('id', $request->redeemid)->where('status', '0')->first();
						$point=DB::table('redeem_points_settings')->where('id',$check->redeem_id)->first();
					}
					else
					{
						$point=DB::table('redeem_points_settings')->where('id', $request->redeemid)->first();
					}
				}
				else
					{
						$point=DB::table('redeem_points_settings')->where('id', $request->redeemid)->first();
					}
				
			
				 	if($point->no_rm < $request->total){
				 		$date_added = date('Y-m-d H:i:s');

				 		if($request->transaction_id !='0'){

				 			$old=DB::table('transaction_points')->where('user_id', $request->customers_id)->where('id', $request->transaction_id)->where('status', '0')->first();
				 			if($old){
				 				 $cdata = DB::table('users')->where('id', $request->customers_id)->first();
				 				 $new=$cdata->loyalty_points+$old->points;
				 				  // update user table
		                            DB::table('users')->where('id', $request->customers_id)->update([
		                                'loyalty_points' => $new,
		                            ]);
		                           // detete old trancation date
                    				DB::table('transaction_points')->where('id', $request->transaction_id)->delete();
                    				DB::table('temp_point_transaction')->where('trans_id', $request->transaction_id)->delete();
				 			}	
				 		}

				 		$userdata = DB::table('users')->where('id', $request->customers_id)->first();
				 		$oldbalnce=$userdata->loyalty_points;
                 		$newbalnce=$userdata->loyalty_points-$point->points;

                 		if ($point->discount_type == 'fixed_cart') {
                 			$discount_amount = $point->no_rm;
                 		}elseif ($point->discount_type == 'percent') {
                 			$dis_amount = $point->no_rm / 100 *  $request->total;
                 			if(!empty($point->cap_amount)){
                 				if($dis_amount < $point->cap_amount){
                 					$discount_amount=$dis_amount;
                 				}else{
                 					$discount_amount= $point->cap_amount;
                 				}
                 			}else{
                 				$discount_amount=$dis_amount;
                 			}
                 		}
						 if($voucher_redeem =='1'){
                 	//insert point details
                 	$trns_id=DB::table('transaction_points')->insertGetId([
                         'user_id' => $request->customers_id,
                         'order_id'=> '0',
                         'loyalty_id'=>$point->id,
                         'points' => $point->points,
                         'balance_points' => $newbalnce,
                         'points_status' => 'out',
                         'description'=>'Apply point coupon',
						 'type'=>'Direct',
                         'created_at' => $date_added,
                         'updated_at' => $date_added
                    ]);
                    // update user table
                        DB::table('users')->where('id', $request->customers_id)->update([
                             'loyalty_points' => $newbalnce,
                        ]);

                     DB::table('temp_point_transaction')->insert([
                         'trans_id' => $trns_id,
                         'loyalty_id'=>$point->id,
                         'user_id'=> $request->customers_id,
                         'created_at' => $date_added
                     ]);
					}

					else
					{
						
						$trns_id = $request->transaction_id;
					}

                     $responseData = array('success'=>'1','transaction_id'=>$trns_id,'discount_amount'=>$discount_amount,'message'=>"Redeem successful.");

				 	}else{
				 		$responseData = array('success'=>'0','message'=>"Redeem amount is greater than total price");
				 	}
				 	
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;	
  }
  public static function removeloyalty($request)
  {
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
			if($request->transaction_id == '' || $request->customers_id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$check=DB::table('transaction_points')->where('user_id', $request->customers_id)->where('id', $request->transaction_id)->where('status', '0')->first();
				if($check){
					$trans = DB::table('transaction_points')->where('id', $request->transaction_id)->first();
         			$cdata = DB::table('users')->where('id', $request->customers_id)->first();
         			$newbalnce=$cdata->loyalty_points+$trans->points;
         			// update user table
            		DB::table('users')->where('id', $request->customers_id)->update(['loyalty_points' => $newbalnce,]);
            		 //delete transaction_points table
            		DB::table('transaction_points')->where([['id', '=', $request->transaction_id]])->delete();
            		 //delete temp_point_transaction table 
            		DB::table('temp_point_transaction')->where([['trans_id', '=',$request->transaction_id]])->delete();
            		$responseData = array('success'=>'1','transaction_id'=>'0','discount_amount'=>'0','message'=>"Redeem successful.");
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid transaction id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}
		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;
  }
  
  public static function activeredeempoint($request)
  {
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
			if($request->redeem_id == '' || $request->customers_id == '' || $request->language_id ==''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$userdata = DB::table('users')->where('id', $request->customers_id)->first();
				$point=DB::table('redeem_points_settings')->where('id', $request->redeem_id)->first();
				$code=$authController->generateRandomString('5');
				
				//$check = DB::table('redeem_points_voucher')->where('redeem_id',$request->redeem_id)->where('user_id',$request->customers_id)->where('status','0')->first();
				//if(!empty($check)){
					//$responseData = array('success'=>'0','message'=>"Already activated");
				//}else{
					if($userdata->loyalty_points >= $point->points){
						$date_added = date('Y-m-d H:i:s');
						//user point reeduce
				        $oldbalnce=$userdata->loyalty_points;
				        $newbalnce=$userdata->loyalty_points-$point->points;

						$trnss_id=DB::table('redeem_points_voucher')->insertGetId([
							'redeem_id' => $request->redeem_id,
							'user_id'=> $request->customers_id,
							'code'=>$code,
							'status' => '0',
							'created_at' => $date_added,
							'updated_at' => $date_added
						]);

				        //insert point details
					      $trns_id=DB::table('transaction_points')->insertGetId([
					            'user_id' => $request->customers_id,
					            'order_id'=> '0',
					            'loyalty_id'=>$trnss_id,
					            'points' => $point->points,
					            'balance_points' => $newbalnce,
					            'points_status' => 'out',
					            'description'=>'Apply point coupon',
					            'status'=>'1',
					            'type'=>'Active',
					            'created_at' => $date_added,
					            'updated_at' => $date_added
					          ]);

					     DB::table('temp_point_transaction')->insert([
				              'trans_id' => $trns_id,
				              'loyalty_id'=> $point->id,
				              'user_id'=> $request->customers_id,
				              'created_at' => $date_added
				      	 ]);

				      	 // update user table
					        DB::table('users')->where('id', $request->customers_id)->update([
					            'loyalty_points' => $newbalnce,
					        ]);

					     
						

				           $redeem = DB::table('redeem_points_voucher')
				              ->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
				              ->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
				              ->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
				              ->select('redeem_points_settings.*', 'image_categories.path as image_path','image_categories.path_type as path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description')
				              ->where('redeem_points_description.language_id', '=', $request->language_id)
				              ->where('redeem_points_voucher.user_id', $request->customers_id)
				              ->where('redeem_points_settings.status', 1)
				              ->where('redeem_points_voucher.status', 0)
				              ->groupBy('redeem_points_settings.id')
							  ->orderBy('redeem_points_voucher.id', 'DESC' )
				              ->get();

				      $responseData = array('success'=>'1','data'=>$redeem,'message'=>"Active redeempoint successful.");

					}else{
						$responseData = array('success'=>'0','message'=>"Insufficient loyalty point");
					}
				//}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}

		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;
  }

   public static function viewyourrewards($request)
   {
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
			if($request->customers_id == '' || $request->language_id == ''){
				$responseData = array('success'=>'0','message'=>"Required all Fields.");
			}else{
				$userdata = DB::table('users')->where('id', $request->customers_id)->first();
				if($userdata){
					
		              $your_redeem = DB::table('redeem_points_voucher')
              			->leftJoin('redeem_points_settings', 'redeem_points_settings.id', '=', 'redeem_points_voucher.redeem_id')
              			->Join('transaction_points', 'transaction_points.loyalty_id', '=', 'redeem_points_voucher.id')
              			->leftJoin('image_categories', 'redeem_points_settings.image', '=', 'image_categories.image_id')
              			->leftJoin('redeem_points_description', 'redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
              			->select('redeem_points_settings.*', 'image_categories.path as image_path','image_categories.path_type as path_type','redeem_points_description.redeem_points_title', 'redeem_points_description.redeem_points_description','redeem_points_voucher.id as voucher_id', 'redeem_points_voucher.code as code', 'transaction_points.id as transaction_id', 'redeem_points_voucher.created_at as voucher_date','image_categories.image_id')
              		->where('redeem_points_description.language_id', '=', $request->language_id)
              		->where('redeem_points_voucher.user_id', $request->customers_id)
              		->where('redeem_points_voucher.status', 0)
              		->where('image_categories.image_type', '=', 'ACTUAL')
					  ->orderBy('redeem_points_voucher.id', 'DESC' )
              		->get();

		              if(!empty($your_redeem)){
		              	$responseData = array('success'=>'1','data'=>$your_redeem,'message'=>"Your rewards list.");
		              }else{
		              	$responseData = array('success'=>'0','message'=>"No data found");
		              }
				}else{
					$responseData = array('success'=>'0','message'=>"Invalid customers id");
				}
			}
		}else{
			$responseData = array('success'=>'0', 'data'=>array(),  'message'=>"Unauthenticated call.");
		}

		$loyaltyResponse = json_encode($responseData);
		return $loyaltyResponse;
   }
}
?>