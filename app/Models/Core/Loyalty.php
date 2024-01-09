<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Loyalty extends Model
{
    use Sortable;

    public $sortable =['id'];


	 public function paginator($data){

        $sort = $data['sort'];
        $direction = $data['direction'];

        if($sort != '')
        {
	 	$earn_points = DB::table('earn_points_settings')
	 	->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('earn_points_description as parent_description', function ($join) {
                $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
            'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
            'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
            'earn_points_description.language_id','categoryTable.path as imgpath', 
            'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
         
           ->where('earn_points_description.language_id', '1')
           ->groupby('earn_points_settings.id')
           ->orderBy($sort, $direction)
           ->paginate(50);
        }
        else
        {
            $earn_points = DB::table('earn_points_settings')
	 	->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('earn_points_description as parent_description', function ($join) {
                $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
            'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
            'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
            'earn_points_description.language_id','categoryTable.path as imgpath', 
            'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
         
           ->where('earn_points_description.language_id', '1')
           ->groupby('earn_points_settings.id')
           ->paginate(50);

        }
           return ($earn_points);


	 }

     public function filter($data)
     {
        $sort = $data['sort'];
        $direction = $data['direction'];
        $name = $data['FilterBy'];
        $param = $data['parameter'];

        if($sort != '')
        {
        
         switch ( $name ) {
              case 'Name':
                $earn_points = DB::table('earn_points_settings')
	 	->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('earn_points_description as parent_description', function ($join) {
                $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
            'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
            'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
            'earn_points_description.language_id','categoryTable.path as imgpath', 
            'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
         
                  
                    ->where('earn_points_description.earn_points_title', 'LIKE', '%' . $param . '%')
                    ->where('earn_points_description.language_id', '1')
                    ->groupby('earn_points_settings.id')
                    ->orderBy($sort, $direction)
                    ->paginate(10);
              break;
              default:
              $earn_points = DB::table('earn_points_settings')
              ->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
               ->LeftJoin('image_categories as categoryTable', function ($join) {
                     $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                         ->where(function ($query) {
                             $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                 ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                 ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                         });
               })
     
               ->LeftJoin('earn_points_description as parent_description', function ($join) {
                     $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                         ->where(function ($query) {
                             $query->where('parent_description.language_id', '=', 1)->limit(1);
                         });
                 })
     
                ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
                 'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
                 'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
                 'earn_points_description.language_id','categoryTable.path as imgpath', 
                 'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
              
                ->where('earn_points_description.language_id', '1')
                ->groupby('earn_points_settings.id')
                ->orderBy($sort, $direction)
                
            ->paginate(10);
              break;
         }
        }
        else{
            switch ( $name ) {
                case 'Name':
                  $earn_points = DB::table('earn_points_settings')
           ->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                  $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                      ->where(function ($query) {
                          $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                              ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                              ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                      });
            })
  
            ->LeftJoin('earn_points_description as parent_description', function ($join) {
                  $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                      ->where(function ($query) {
                          $query->where('parent_description.language_id', '=', 1)->limit(1);
                      });
              })
  
             ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
              'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
              'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
              'earn_points_description.language_id','categoryTable.path as imgpath', 
              'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
           
                    
                      ->where('earn_points_description.earn_points_title', 'LIKE', '%' . $param . '%')
                      ->where('earn_points_description.language_id', '1')
                      ->groupby('earn_points_settings.id')
                      ->paginate(10);
                break;
                default:
                $earn_points = DB::table('earn_points_settings')
                ->leftJoin('earn_points_description','earn_points_description.earn_points_id', '=', 'earn_points_settings.id')
                 ->LeftJoin('image_categories as categoryTable', function ($join) {
                       $join->on('categoryTable.image_id', '=', 'earn_points_settings.image')
                           ->where(function ($query) {
                               $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                   ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                   ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                           });
                 })
       
                 ->LeftJoin('earn_points_description as parent_description', function ($join) {
                       $join->on('parent_description.earn_points_id', '=', 'earn_points_settings.id')
                           ->where(function ($query) {
                               $query->where('parent_description.language_id', '=', 1)->limit(1);
                           });
                   })
       
                  ->select('earn_points_settings.id as id', 'earn_points_settings.image as image',
                   'earn_points_settings.points as points',  'earn_points_settings.created_at as date_added',
                   'earn_points_settings.updated_at as last_modified', 'earn_points_description.earn_points_title as name','earn_points_description.earn_points_description as description',
                   'earn_points_description.language_id','categoryTable.path as imgpath', 
                   'earn_points_settings.status  as earn_points_status','earn_points_settings.no_rm')
                
                  ->where('earn_points_description.language_id', '1')
                  ->groupby('earn_points_settings.id')
                  
              ->paginate(10);
                break;
           }
        }
         return $earn_points;
     }


	 public function insert($uploadImage,$points,$date_added,$categories_status,$no_rm){
        $earn_points = DB::table('earn_points_settings')->insertGetId([
            'image'   =>   $uploadImage,
            'points'  =>   $points,
            'status'  =>   $categories_status,
            'created_at' =>	  $date_added,
            'updated_at' =>   $date_added,
            'no_rm'      => $no_rm
        ]);
        return $earn_points;
    }

    public function insertearndescription($titleNameSub,$earn_points_id,$languages_data_id, $descriptions)
    {
    	DB::table('earn_points_description')->insert([
            'earn_points_id'   =>   $earn_points_id,
            'language_id'      =>   $languages_data_id,
            'earn_points_title'       =>   $titleNameSub,
            'earn_points_description' => $descriptions
        ]);
    }
    public function editdescription_earn($languages_id,$id)
    {
    	$description = DB::table('earn_points_description')->where([
            ['language_id', '=', $languages_id],
            ['earn_points_id', '=', $id],
        ])->get();
        return $description;
    }

    public function editearnpoints($request)
    {
    	$editearnpoints = DB::table('earn_points_settings')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'earn_points_settings.image')
            ->select('earn_points_settings.*','categoryTable.path as imgpath')
            ->where('earn_points_settings.id', $request->id)->get();
        return $editearnpoints;
    }

    public function updaterecord_earn_point($earn_point_id,$uploadImage,$points,$last_modified,$categories_status,$no_rm)
    {
    	DB::table('earn_points_settings')->where('id', $earn_point_id)->update(
        [
            'image'      =>   $uploadImage,
            'points'     =>   $points,
            'updated_at' =>   $last_modified,
            'status'     =>   $categories_status,
            'no_rm'      =>   $no_rm
        ]);
    }

    public function checkExit_earn_point($earn_point_id,$languages_data)
    {
    	$checkExist = DB::table('earn_points_description')->where('earn_points_id','=',$earn_point_id)->where('language_id','=',$languages_data->languages_id)->get();
        return $checkExist;
    }

    public function updatedescription_earn_point($title,$languages_data,$earn_point_id,$descriptions)
    {
    	$earn_point =  DB::table('earn_points_description')->where('earn_points_id','=',$earn_point_id)->where('language_id','=',$languages_data->languages_id)->update([
             'earn_points_title'  	  =>  $title,
             'earn_points_description' => $descriptions
         ]);
        return $earn_point;
    }

   public function insertcategorydescription_earn_point($title,$earn_point_id,$languages_data_id, $descriptions)
    {
    	DB::table('earn_points_description')->insert([
            'earn_points_title'   =>   $title,
            'earn_points_id'     =>   $earn_point_id,
            'language_id'       =>   $languages_data_id,
            'earn_points_description' => $descriptions
        ]);
    }

    public function paginator_redeem($data)
    {
        $sort = $data['sort'];
        $direction = $data['direction'];

        if($sort != '')
        {
            
    	$redeem_points = DB::table('redeem_points_settings')
	 	->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
            'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
            'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
            'redeem_points_description.language_id','categoryTable.path as imgpath', 
            'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
         
           ->where('redeem_points_description.language_id', '1')
           ->orderBy($sort, $direction)
           ->groupby('redeem_points_settings.id')
           ->paginate(10);
        }
        else
        {
            $redeem_points = DB::table('redeem_points_settings')
	 	->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
	 	 ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

	 	 ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
            'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
            'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
            'redeem_points_description.language_id','categoryTable.path as imgpath', 
            'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
         
           ->where('redeem_points_description.language_id', '1')
           ->groupby('redeem_points_settings.id')
           ->paginate(10);

        }

           return ($redeem_points);
    }
    public function filter_redeem($data)
    {
        $name = $data['FilterBy'];
        $param = $data['parameter'];
        $param2 = $data['parameter2'];
        $param3 = $data['parameter3'];
        $sort = $data['sort'];
        $direction = $data['direction'];

        if($sort != '')
        {
            switch ( $name ) {
                case 'Name':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_description.redeem_points_title', 'LIKE', '%' . $param . '%')
                    ->orderBy($sort, $direction)
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;

                case 'Status':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_settings.status', $param2)
                    ->orderBy($sort, $direction)
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;
                case 'type':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_settings.discount_type', $param3)
                    ->where('redeem_points_description.redeem_points_title', 'LIKE', '%' . $param . '%')
                    ->orderBy($sort, $direction)
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;

                default:
                    $redeem_points = DB::table('redeem_points_settings')
            ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                    $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                        ->where(function ($query) {
                            $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                        });
            })

            ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                    $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->where(function ($query) {
                            $query->where('parent_description.language_id', '=', 1)->limit(1);
                        });
                })

            ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                'redeem_points_description.language_id','categoryTable.path as imgpath', 
                'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
            
            ->where('redeem_points_description.language_id', '1')
            ->groupby('redeem_points_settings.id')
            ->orderBy($sort, $direction)
            ->paginate(10);
                break;
            }
        }
        else{

            switch ( $name ) {
                case 'Name':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_description.redeem_points_title', 'LIKE', '%' . $param . '%')
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;
                case 'status':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_settings.status', $param2)
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;
                case 'type':
                    $redeem_points = DB::table('redeem_points_settings')
                    ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
                    ->LeftJoin('image_categories as categoryTable', function ($join) {
                            $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                                ->where(function ($query) {
                                    $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                        ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                        ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                                });
                    })

                    ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                            $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                                ->where(function ($query) {
                                    $query->where('parent_description.language_id', '=', 1)->limit(1);
                                });
                        })

                    ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                        'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                        'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                        'redeem_points_description.language_id','categoryTable.path as imgpath', 
                        'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
                    
                    ->where('redeem_points_description.language_id', '1')
                    ->where('redeem_points_settings.discount_type', $param3)
                    ->groupby('redeem_points_settings.id')
                    ->paginate(10);
                break;
                default:
                    $redeem_points = DB::table('redeem_points_settings')
            ->leftJoin('redeem_points_description','redeem_points_description.redeem_points_id', '=', 'redeem_points_settings.id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                    $join->on('categoryTable.image_id', '=', 'redeem_points_settings.image')
                        ->where(function ($query) {
                            $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                                ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                        });
            })

            ->LeftJoin('redeem_points_description as parent_description', function ($join) {
                    $join->on('parent_description.redeem_points_id', '=', 'redeem_points_settings.id')
                        ->where(function ($query) {
                            $query->where('parent_description.language_id', '=', 1)->limit(1);
                        });
                })

            ->select('redeem_points_settings.id as id', 'redeem_points_settings.image as image',
                'redeem_points_settings.points as points',  'redeem_points_settings.created_at as date_added',
                'redeem_points_settings.updated_at as last_modified', 'redeem_points_description.redeem_points_title as name','redeem_points_description.redeem_points_description as description',
                'redeem_points_description.language_id','categoryTable.path as imgpath', 
                'redeem_points_settings.status  as redeem_points_status','redeem_points_settings.no_rm','redeem_points_settings.discount_type','redeem_points_settings.cap_amount')
            
            ->where('redeem_points_description.language_id', '1')
            ->groupby('redeem_points_settings.id')
            ->paginate(10);
                break;
            }

        }
        return $redeem_points;
    }

    public function insert_redeem($uploadImage,$points,$date_added,$categories_status,$no_rm,$discount_type,$cap_amount,$products_id)
    {
    	$redeem_points = DB::table('redeem_points_settings')->insertGetId([
            'image'   =>   $uploadImage,
            'points'  =>   $points,
            'status'  =>   $categories_status,
            'created_at' =>	  $date_added,
            'updated_at' =>   $date_added,
            'no_rm'		=> 	$no_rm,
            'discount_type'=>$discount_type,
            'cap_amount'=>$cap_amount,
            'products_id'=>$products_id
        ]);
        return $redeem_points;
    }
    public function insertearndescription_redeem($titleNameSub,$redeem_points_id,$languages_data_id, $descriptions)
    {
    	DB::table('redeem_points_description')->insert([
            'redeem_points_id' =>   $redeem_points_id,
            'language_id'      =>   $languages_data_id,
            'redeem_points_title'       =>  $titleNameSub,
            'redeem_points_description' => $descriptions
        ]);
    }

    public function editredeem_points($request)
    {
    	$redeem_points = DB::table('redeem_points_settings')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'redeem_points_settings.image')
            ->select('redeem_points_settings.*','categoryTable.path as imgpath')
            ->where('redeem_points_settings.id', $request->id)->get();
        return $redeem_points;
    }
    public function editdescription_redeem($languages_id,$id)
    {
    	$description = DB::table('redeem_points_description')->where([
            ['language_id', '=', $languages_id],
            ['redeem_points_id', '=', $id],
        ])->get();
        return $description;
    }

    public function updaterecord_redeem_points($redeem_point_id,$uploadImage,$points,$last_modified,$status,$no_rm,$discount_type,$cap_amount,$products_id,$qrcode)
    {
    	DB::table('redeem_points_settings')->where('id', $redeem_point_id)->update(
        [
            'image'          =>   $uploadImage,
            'points'         =>   $points,
            'updated_at'     =>   $last_modified,
            'status'         =>	  $status,
            'no_rm'		     =>   $no_rm,
            'discount_type'  =>   $discount_type,
            'cap_amount'     =>   $cap_amount,
            'products_id'    =>   $products_id,
            'qrcode'         =>   $qrcode
        ]);
    }

    public function checkExit_redeem_points($redeem_point_id,$languages_data)
    {
    	$checkExist = DB::table('redeem_points_description')->where('redeem_points_id','=',$redeem_point_id)->where('language_id','=',$languages_data->languages_id)->get();
        return $checkExist;
    }
    public function updatedescription_redeem_points($title,$languages_data,$redeem_point_id,$descriptions)
    {
    	$redeem_point =  DB::table('redeem_points_description')->where('redeem_points_id','=',$redeem_point_id)->where('language_id','=',$languages_data->languages_id)->update([
             'redeem_points_title'  	  =>  $title,
             'redeem_points_description' => $descriptions
         ]);
        return $redeem_point;
    }
    public function insertcategorydescription_redeem_points($title,$redeem_point_id, $languages_data_id, $descriptions)
    {
    	DB::table('redeem_points_description')->insert([
            'redeem_points_title'       => $title,
            'redeem_points_id'          => $redeem_point_id,
            'language_id'               => $languages_data_id,
            'redeem_points_description' => $descriptions
        ]);
    }
    public function member_type_view()
    {
        $member_type = DB::table('member_type')
         ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'member_type.member_card')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
          })

         ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'member_type.member_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })

         
          ->select('member_type.*','categoryTable.path as member_card_imgpath','iconTable.path as member_icon_imgpath')
           ->groupby('member_type.id')
           ->paginate(50);
           return ($member_type);
    }
    public function insert_member_type($title,$point,$no_rm,$rate_others,$rate_wallet,$member_card,$member_icon,$categories_status,$date_added)
    {
        $checkExist = DB::table('member_type')->where('member_type_name','=',$title)->get();

        if(count($checkExist)=='0')
        {
             $member_type = DB::table('member_type')->insertGetId([
                'member_type_name'=> $title,
                'points'        =>   $point,
                'number_amount' =>   $no_rm,
                'rate_others'   =>   $rate_others,
                'rate_wallet'   =>   $rate_wallet,
                'member_card'   =>   $member_card,
                'member_icon'   =>   $member_icon,
                'status'        =>   $categories_status,
                'created_at'    =>   $date_added,
                'updated_at'    =>   $date_added
          ]);
            return 'success';
           
        }else{
            return 'failure';
        }
    }

    public function edit_member_type($request)
    {
        $member_type = DB::table('member_type')
            ->leftJoin('image_categories as categoryTable','categoryTable.image_id', '=', 'member_type.member_card')
            ->leftJoin('image_categories as iconTable','iconTable.image_id', '=', 'member_type.member_icon')
            ->select('member_type.*','categoryTable.path as member_card_imgpath','iconTable.path as member_icon_imgpath')
            ->where('member_type.id', $request->id)->get();
        return $member_type;
    }

    public function edit_member_type_action($member_type_id,$title,$point,$no_rm,$rate_others,$rate_wallet,$member_card,$member_icon,$categories_status,$date_added)
    {
       $checkExist = DB::table('member_type')->where('member_type_name','=',$title)->where('id','!=', $member_type_id)->first();
       if(empty($checkExist)){ 

           DB::table('member_type')->where('id', $member_type_id)->update(
            [
                'member_type_name'=> $title,
                'points'        =>   $point,
                'number_amount' =>   $no_rm,
                'rate_others'   =>   $rate_others,
                'rate_wallet'   =>   $rate_wallet,
                'member_card'   =>   $member_card,
                'member_icon'   =>   $member_icon,
                'status'        =>   $categories_status,
                'updated_at'    =>   $date_added
            ]); 
           return 'success';
        }else{
           return 'failure';  
        }
    }
    public function deleterecord_member_type($request)
    {
        $member_id = $request->id;
        //print_r($member_id);die();
        DB::table('member_type')->where('id', $member_id)->delete();
    }

    public function deleterecord_redeem($request)
    {
        $redeem_id = $request->id;
        //print_r($redeem_id);die();
        DB::table('redeem_points_settings')->where('id', $redeem_id)->delete();
        DB::table('redeem_points_description')->where('redeem_points_id', $redeem_id)->delete();
    }
    public function cutomers(){

        $products = DB::table('products')
            ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->select('products_name', 'products.products_id', 'products.products_model')->get();

        return $products;
    }

}
?>