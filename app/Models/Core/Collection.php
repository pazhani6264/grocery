<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Collection extends Model
{
	public function paginator()
	{
		$collection = DB::table('collections')
	 	->leftJoin('collections_description','collections_description.collections_id', '=', 'collections.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'collections.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('collections_description as parent_description', function ($join) {
                $join->on('parent_description.collections_id', '=', 'collections.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('collections.id as id', 'collections.image as image',
              'collections.created_at as date_added',
            'collections.updated_at as last_modified', 'collections_description.collections_name as name','collections_description.collections_description as description',
            'collections_description.language_id','categoryTable.path as imgpath', 
            'collections.status as collections_status')
         
           ->where('collections_description.language_id', '1')
           ->groupby('collections.id')
           ->paginate(10);
           return ($collection);
	}
	public function insert($uploadImage,$date_added,$categories_status){
        $collection = DB::table('collections')->insertGetId([
            'image'   =>   $uploadImage,
            'status'  =>   $categories_status,
            'created_at' =>	  $date_added,
            'updated_at' =>   $date_added
        ]);
        return $collection;
    }

    public function insertearndescription($title,$collection_id,$languages_data_id, $descriptions)
    {
    	DB::table('collections_description')->insert([
            'collections_id'   =>   $collection_id,
            'language_id'      =>   $languages_data_id,
            'collections_name'       => $title,
            'collections_description' => $descriptions
        ]);
    }

    public function edit($id)
    {
    	$editcollection = DB::table('collections')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'collections.image')
            ->select('collections.*','categoryTable.path as imgpath')
            ->where('collections.id', $id)->get();
        return $editcollection;
    }

    public function editdescription_Collection($languages_id,$id)
    {
    	$description = DB::table('collections_description')->where([
            ['language_id', '=', $languages_id],
            ['collections_id', '=', $id],
        ])->get();
        return $description;
    }
    public function updaterecord_Collection($collection_id,$uploadImage,$last_modified,$status)
    {
    	DB::table('collections')->where('id', $collection_id)->update(
        [
            'image'      =>   $uploadImage,
            'updated_at' =>   $last_modified,
            'status'     =>   $status
        ]);
    }
    public function checkExit_earn_point($collection_id,$languages_data)
    {
    	$checkExist = DB::table('collections_description')->where('collections_id','=',$collection_id)->where('language_id','=',$languages_data->languages_id)->get();
        return $checkExist;
    }

    public function updatedescription_collection($title,$languages_data,$collection_id,$descriptions)
    {
    	$earn_point =  DB::table('collections_description')->where('collections_id','=',$collection_id)->where('language_id','=',$languages_data->languages_id)->update([
             'collections_name'  	  =>  $title,
             'collections_description' => $descriptions
         ]);
        return $earn_point;
    }

    public function destroyrecord($request)
    {
        DB::table('collections')->where('id', $request->collection_id)->delete();
        DB::table('collections_description')->where('collections_id', $request->collection_id)->delete();
        DB::table('collections_product')->where('collection_id', $request->collection_id)->delete();
        return 'success';
    }
    public function destroyrecord_product($request)
    {

        DB::table('collections_product')->where('id', $request->product_id)->delete();
        return 'success';
    }


     public function filter($data){
     	$name = $data['FilterBy'];
      	$param = $data['parameter'];

      	switch ( $name ) {
      	   case 'Name':
      	   $collection = DB::table('collections')
	 	->leftJoin('collections_description','collections_description.collections_id', '=', 'collections.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'collections.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('collections_description as parent_description', function ($join) {
                $join->on('parent_description.collections_id', '=', 'collections.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('collections.id as id', 'collections.image as image',
              'collections.created_at as date_added',
            'collections.updated_at as last_modified', 'collections_description.collections_name as name','collections_description.collections_description as description',
            'collections_description.language_id','categoryTable.path as imgpath', 
            'collections.status as collections_status')
         
           ->where('collections_description.language_id', '1')
           ->where('collections_description.collections_name', 'LIKE', '%' . $param . '%')
           ->groupby('collections.id')
           ->paginate(10);
           break;
          default:
          	$collection = DB::table('collections')
	 	->leftJoin('collections_description','collections_description.collections_id', '=', 'collections.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'collections.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('collections_description as parent_description', function ($join) {
                $join->on('parent_description.collections_id', '=', 'collections.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('collections.id as id', 'collections.image as image',
              'collections.created_at as date_added',
            'collections.updated_at as last_modified', 'collections_description.collections_name as name','collections_description.collections_description as description',
            'collections_description.language_id','categoryTable.path as imgpath', 
            'collections.status as collections_status')
         
           ->where('collections_description.language_id', '1')
           ->groupby('collections.id')
           ->paginate(10);
           return ($collection);
          break;
      	}
      	return ($collection);
     }

     public function get_collection()
     {
     	$collection = DB::table('collections')
	 	->leftJoin('collections_description','collections_description.collections_id', '=', 'collections.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'collections.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('collections_description as parent_description', function ($join) {
                $join->on('parent_description.collections_id', '=', 'collections.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('collections.id as id', 'collections.image as image',
              'collections.created_at as date_added',
            'collections.updated_at as last_modified', 'collections_description.collections_name as name','collections_description.collections_description as description',
            'collections_description.language_id','categoryTable.path as imgpath', 
            'collections.status as collections_status')
         
           ->where('collections_description.language_id', '1')
           ->where('collections.status', '1')
           ->groupby('collections.id')
           ->get();
           return ($collection);
     }

     public function get_category()
     {
        $category = DB::table('categories')
        ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
        ->select('categories.*','categories_description.categories_name')
        ->where('categories_description.language_id', '1')
        ->where('categories.categories_status', '1')
        ->groupby('categories.categories_id')
        ->get();
        return ($category);

     }

     public function insert_product($request,$jesproid)
     {
         $checkExist = DB::table('collections_product')->where('collection_id','=',$request->collection_id)->where('category_id','=',$request->categories)->where('product_id','=',$jesproid)->first();
        if($checkExist){
          return 'failure';
        }else{
          $date_added = date('y-m-d h:i:s');
              DB::table('collections_product')->insert([
                'collection_id'  => $request->collection_id,
                'category_id'    => $request->categories,
                'product_id'     => $jesproid,
                'status' => '1',
                'created_at'=>$date_added,
                'updated_at'=>$date_added
            ]);
            return 'success';
        }
     }
     public function collection_product($id)
     {
        $product = DB::table('collections_product')
        ->leftJoin('collections_description','collections_description.collections_id', '=', 'collections_product.collection_id')
         ->leftJoin('categories_description','categories_description.categories_id', '=', 'collections_product.category_id')
        ->leftJoin('products_description','products_description.products_id', '=', 'collections_product.product_id')
        ->select('collections_product.*','collections_description.collections_name','categories_description.categories_name','products_description.products_name')
        ->where('collections_description.language_id', '1')
        ->where('categories_description.language_id', '1')
        ->where('products_description.language_id', '1')
        //->where('collections_product.status', '1')
        ->where('collections_product.collection_id', $id)
        ->get();
        return ($product);

     }

     public function collection_product_edit($id)
     {
        $product = DB::table('collections_product')
        ->select('collections_product.*')
        ->where('collections_product.id', $id)
        ->first();
        return ($product);
     }
     public function get_product()
     {
        $getproduct = DB::table('products_to_categories')
         ->leftJoin('products_description','products_description.products_id', '=', 'products_to_categories.products_id')
        ->select('products_to_categories.products_id','products_description.products_name')
         ->where('products_description.language_id', '1')
        //->where('products_to_categories.categories_id', $request->categories_id)
        ->groupby('products_to_categories.products_id')
        ->get();
         return ($getproduct);
     }
     public function update_product($request)
     {
          $checkExist = DB::table('collections_product')->where('collection_id','=',$request->collection_id)->where('category_id','=',$request->categories)->where('product_id','=',$request->product_id)->where('id','!=',$request->id)->first();

          if(empty($checkExist)){
               $date_added = date('y-m-d h:i:s');
              DB::table('collections_product')->where('id', $request->id)->update(
              [
                'collection_id' =>   $request->collection_id,
                'category_id'   =>   $request->categories,
                'product_id'    =>   $request->product_id,
                'status'        =>   $request->status,
                'updated_at'    =>   $request->date_added
              ]);
              return 'success';
          }else{
              return 'failure';
          }
     }
}
?>