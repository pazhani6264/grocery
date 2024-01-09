<?php

namespace App\Models\Core;;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Shipping_method extends Model
{
    //

    public function upsDescription(){
        $ups_description = DB::table('shipping_description')->where([
            ['language_id', '=', '1'],
            ['table_name', '=', 'ups_shipping']
        ])->get();
        return $ups_description;
    }

    public function ups_shipping(){
        $ups_shipping = DB::table('ups_shipping')
            ->where('ups_id', '=', '1')->first();
        return $ups_shipping;
    }

    public function flateRate(){
        $flate_rate = DB::table('flate_rate')->first();
        return $flate_rate;
    }


    public function flateRateDescription(){
        $flatrate_description = DB::table('shipping_description')->where([
            ['language_id', '=', '1'],
            ['table_name', '=', 'flate_rate']
        ])->get();
        return $flatrate_description;

    }

    public function updateshipingStatus($request,$status){
        if($request->id == 16)
        {
            DB::table('shipping_description')->update([
                'status'		 =>	  0,
                'isDefault'		 =>	  0
            ]);
            $updatestatus =  DB::table('shipping_description')->where('id', '=', $request->id)->update([
                'status'		 =>	  $status,
                'isDefault'		 =>	  1
            ]);

        }
        else
        {
            DB::table('shipping_description')->where('id', '=', 16)->update([
                'status'		 =>	  0,
                'isDefault'		 =>	  0
            ]);
            DB::table('shipping_description')->update([
                'isDefault'		 =>	  0
            ]);
            if($status == 1)
            {
                $updatestatus =  DB::table('shipping_description')->where('id', '=', $request->id)->update([
                    'status'		 =>	  $status,
                    'isDefault'		 =>	  1
                ]);
            }
            else
            {
                

                $updatestatus =  DB::table('shipping_description')->where('id', '=', $request->id)->update([
                    'status'		 =>	  $status
                ]);

                $shipping_methods = DB::table('shipping_description')->where('id', '!=', 16)->where('status', '=', 1)->first();
                if($shipping_methods != ''){
               DB::table('shipping_description')->where('id', '=', $shipping_methods->id)->update([
                    'isDefault'		 =>	  1
                ]);
            }
            }

        }
       
       return $updatestatus;
    }


    public function shipingMethod(){
        $shipping_methods = DB::table('shipping_methods')
            ->leftJoin('shipping_description','shipping_description.table_name','=','shipping_methods.table_name')
            ->where('shipping_description.language_id','1')
            ->paginate(10);
        return $shipping_methods;
    }

    public function countriues(){
        $countries = DB::table('countries')->get();
        return $countries;
    }

    public function shipingMethopd(){
        $shipping_methods = DB::table('shipping_methods')->where('shipping_methods_id', '=', '1')->get();
        return $shipping_methods;
    }


    public  function description($languages_data,$shipping_methods,$id){
        $description = DB::table('shipping_description')->where([
            ['language_id', '=', $languages_data->languages_id],
            ['id', '=', $id],
            ['table_name', '=', $shipping_methods[0]->table_name],
        ])->get();
        return $description;
    }

    public function shipingMethods($id){
        $shipping_methods = DB::table('shipping_description')->where('id', '=', $id)->get();
        return $shipping_methods;
    }

    public function shipingMethod4($id){
        $shipping_methods = DB::table('shipping_description')->where('id', '=', $id)->get();
        return $shipping_methods;
    }


    public function updateflaterate($request){

      $flateRate =  DB::table('shipping_description')->where('id', '=',  $request->id)->update([
            'flate_rate'  		 =>   $request->flate_rate,
            'currency'			 =>	  $request->currency
        ]);

      return $flateRate;

    }

    public function updateShipingMethodStatus($request){

        $methodStatus = DB::table('shipping_description')->where('id', '=', $request->id)->update([
            'status'  		 =>   $request->status,
        ]);

        return $methodStatus;

    }

    public function CheckExit($table_name,$languages_data,$id){


        $checkExist = DB::table('shipping_description')->where('id','=',$id)->where('language_id','=',$languages_data->languages_id)->get();


        return $checkExist;

    }

    public function shipingDescription($table_name,$languages_data_id,$request_name,$id,$flate_rate,$currency){

        $shipingDes = DB::table('shipping_description')->where('id','=',$id)->where('language_id','=',$languages_data_id)->update([
            'name'  	    		 =>   $request_name,
            'flate_rate'  		 =>   $flate_rate,
            'currency'			 =>	  $currency
        ]);

        return $shipingDes;

    }

    public function insertDescription($request_name,$languages_data_id,$table_name,$flate_rate,$currency){

      $insertDescription =  DB::table('shipping_description')->insert([
            'name'  	     		 =>   $request_name,
            'language_id'			 =>   $languages_data_id,
            'table_name'			 =>   $table_name,
            'flate_rate'  		 =>   $flate_rate,
            'currency'			 =>	  $currency
        ]);

      return $insertDescription ;

    }

    public function insterUPS($request){

       $insertUPD = DB::table('ups_shipping')->where('ups_id', '=', '1')->update([
            'pickup_method'  		 =>   $request->pickup_method,
            'serviceType'			 =>   implode(',', $request->serviceType),
            'shippingEnvironment'	 =>   $request->shippingEnvironment,
            'user_name'	 			 =>   $request->user_name,
            'access_key'	 		 =>   $request->access_key,
            'password'	 			 =>   $request->password,
            'address_line_1'	 	 =>   $request->address_line_1,
            'country'	 			 =>   $request->country,
            'state'	 			 	 =>   $request->state,
            'post_code'	 			 =>   $request->post_code,
            'city'	 				 =>   $request->city,

        ]);
       return $insertUPD;

    }


    public function updateUPSstatus($request){

       $shippingMethod = DB::table('shipping_methods')->where('shipping_methods_id', '=', '1')->update([
            'status'  		 =>   $request->status,
        ]);

       return $shippingMethod;

    }

    public function updateUPSshippingDescription($table_name,$languages_data_id,$request_name,$sub_labels){
        DB::table('shipping_description')->where('table_name','=',$table_name)->where('language_id','=',$languages_data_id)->update([
            'name'  	    		=>   $request_name,
            'sub_labels'  	    	=>   json_encode($sub_labels),
        ]);
    }

    public function insertUPSinsetDesctription($request_name,$sub_labels,$languages_data_id,$table_name){

       $UpsInsert = DB::table('shipping_description')->insert([
            'name'  	     		 =>   $request_name,
            'sub_labels'  	    	 =>   json_encode($sub_labels),
            'language_id'			 =>   $languages_data_id,
            'table_name'			 =>   $table_name,
        ]);

        return $UpsInsert;
    }

    public function defualtshipingMethod(){

        $updateDefualt = DB::table('shipping_description')->update([
            'isDefault'  		 =>   0,
        ]);

        return $updateDefualt;

    }
    public function DefualtshipingMethod1($request){


        if($request->shipping_id == 16)
        {

            DB::table('shipping_description')->update([
                'status'		 =>	  0,
                'isDefault'		 =>	  0
            ]);
          
            $defualt01 = DB::table('shipping_description')->where('id', '=', $request->shipping_id)->update([
                'isDefault'  		 =>   1,
                'status'  		 =>   1,
            ]);
           

        }
        else
        {

            DB::table('shipping_description')->where('id', '=', 16)->update([
                'status'		 =>	  0,
                'isDefault'		 =>	  0
            ]);
            $defualt01 = DB::table('shipping_description')->where('id', '=', $request->shipping_id)->update([
                'isDefault'  		 =>   1,
                'status'  		 =>   1,
            ]);
    

            

       
    
        }
       
       

    

       return $defualt01;

    }

    public function getshippingMethod($request){


        $shppingMethods = DB::table('shipping_methods')
            ->where('table_name', $request->table_name)->get();


        return $shppingMethods;


    }


    public function getdescription($languages_data_id,$table_name){

        $description = DB::table('shipping_description')->where([
            ['language_id', '=', $languages_data_id],
            ['table_name', '=', $table_name],
        ])->get();

        return $description;

    }

    public function updatecheckExit($table_name,$languages_data_id){

        $checkExist = DB::table('shipping_description')->where('table_name','=',$table_name)
            ->where('language_id','=',$languages_data_id)->get();

        return $checkExist;

    }

    public function ifcheckIsSet($table_name,$languages_data_id,$re_name){

      $ifcheckis =  DB::table('shipping_description')->where('table_name','=',$table_name)->where('language_id','=',$languages_data_id)->update([
            'name'  	    		 =>   $re_name,
        ]);


        return $ifcheckis;

    }


    public function ifnotsetcheck($re_name,$languages_data_id,$table_name){

        $ifnotsetcheck = DB::table('shipping_description')->insert([
            'name'  	     		 =>   $re_name,
            'language_id'			 =>   $languages_data_id,
            'table_name'			 =>   $table_name,
        ]);

        return $ifnotsetcheck;

    }


}
