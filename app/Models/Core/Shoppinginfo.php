<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Shoppinginfo extends Model
{
    public function paginator()
	{
		$shoppinginfo = DB::table('shopping_info')
	 	->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'shopping_info.shopping_info_icon')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('shopping_info_description as parent_description', function ($join) {
                $join->on('parent_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('shopping_info.shopping_info_id as id', 'shopping_info.shopping_info_icon as image',
              'shopping_info.created_at as date_added',
            'shopping_info.update_at as last_modified', 'shopping_info_description.shopping_info_name as name','shopping_info_description.shopping_info_description as description',
            'shopping_info_description.language_id','categoryTable.path as imgpath', 
            'shopping_info.shopping_info_status as shopping_info_status','shopping_info.tint')
         
           ->where('shopping_info_description.language_id', '1')
           ->groupby('shopping_info.shopping_info_id')
           ->paginate(10);
           return ($shoppinginfo);
	}

    public function insert($uploadImage,$date_added,$tint){
        $shoppinginfo = DB::table('shopping_info')->insertGetId([
            'tint'   =>   $tint,
            'shopping_info_icon'   =>   $uploadImage,
            'shopping_info_status'  =>   1,
            'created_at' =>	  $date_added,
            'update_at' =>   $date_added
        ]);
        return $shoppinginfo;
    }

    public function insertearndescription($title,$shoppinginfo_id,$languages_data_id, $descriptions)
    {
    	DB::table('shopping_info_description')->insert([
            'shopping_info_id'   =>   $shoppinginfo_id,
            'language_id'      =>   $languages_data_id,
            'shopping_info_name'       => $title,
            'shopping_info_description' => $descriptions
        ]);
    }

    public function edit($id)
    {
    	$editshoppinginfo = DB::table('shopping_info')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'shopping_info.shopping_info_icon')
            ->select('shopping_info.*','categoryTable.path as imgpath')
            ->where('shopping_info.shopping_info_id', $id)->get();
        return $editshoppinginfo;
    }

    public function editdescription_Shoppinginfo($languages_id,$id)
    {
    	$description = DB::table('shopping_info_description')->where([
            ['language_id', '=', $languages_id],
            ['shopping_info_id', '=', $id],
        ])->get();
        return $description;
    }
    public function updaterecord_Shoppinginfo($shoppinginfo_id,$uploadImage,$last_modified,$tint)
    {
    	DB::table('shopping_info')->where('shopping_info_id', $shoppinginfo_id)->update(
        [
            'tint'      =>   $tint,
            'shopping_info_icon'      =>   $uploadImage,
            'update_at' =>   $last_modified,
        ]);
    }

    public function updatedescription_shoppinginfo($title,$languages_data,$shoppinginfo_id,$descriptions)
    {
    	$earn_point =  DB::table('shopping_info_description')->where('shopping_info_id','=',$shoppinginfo_id)->where('language_id','=',$languages_data->languages_id)->update([
             'shopping_info_name'  	  =>  $title,
             'shopping_info_description' => $descriptions
         ]);
        return $earn_point;
    }

    public function filter($data){
        $name = $data['FilterBy'];
         $param = $data['parameter'];

         switch ( $name ) {
            case 'Name':

                $shoppinginfo = DB::table('shopping_info')
	 	->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'shopping_info.shopping_info_icon')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('shopping_info_description as parent_description', function ($join) {
                $join->on('parent_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('shopping_info.shopping_info_id as id', 'shopping_info.shopping_info_icon as image',
              'shopping_info.created_at as date_added',
            'shopping_info.update_at as last_modified', 'shopping_info_description.shopping_info_name as name','shopping_info_description.shopping_info_description as description',
            'shopping_info_description.language_id','categoryTable.path as imgpath', 
            'shopping_info.shopping_info_status as shopping_info_status')
         
           ->where('shopping_info_description.language_id', '1')
           ->where('shopping_info_description.shopping_info_name', 'LIKE', '%' . $param . '%')
           ->groupby('shopping_info.shopping_info_id')
           ->paginate(10);
          
           
          break;
         default:
         $shoppinginfo = DB::table('shopping_info')
	 	->leftJoin('shopping_info_description','shopping_info_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'shopping_info.shopping_info_icon')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('shopping_info_description as parent_description', function ($join) {
                $join->on('parent_description.shopping_info_id', '=', 'shopping_info.shopping_info_id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('shopping_info.shopping_info_id as id', 'shopping_info.shopping_info_icon as image',
              'shopping_info.created_at as date_added',
            'shopping_info.update_at as last_modified', 'shopping_info_description.shopping_info_name as name','shopping_info_description.shopping_info_description as description',
            'shopping_info_description.language_id','categoryTable.path as imgpath', 
            'shopping_info.shopping_info_status as shopping_info_status')
         
           ->where('shopping_info_description.language_id', '1')
           ->groupby('shopping_info.shopping_info_id')
           ->paginate(10);
           return ($shoppinginfo);
         break;
         }
         return ($shoppinginfo);
    }

    public function deleterecord($request){
        $shoppinginfo_id = $request->id;

        DB::table('shopping_info')->where('shopping_info_id', $shoppinginfo_id)->delete();
        DB::table('shopping_info_description')->where('shopping_info_id', $shoppinginfo_id)->delete();
        
        return "success";
    }


}
