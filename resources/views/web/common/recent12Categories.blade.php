<?php

 function recent12Categories(){
  $categories = recent12Recursivecategories();
  if($categories){
  $parent_id = 0;
  $option = '';
   // dd($categories);
    foreach($categories as $parents){

     $parent_slug  = $parents->slug;
     

     if(isset($parents->childs)){
        $hasChildicon = '<i class="fa fa-chevron-down"></i>'; 
        $hasChild = "#".$parents->slug;
      }else {
        $hasChildicon = "";
        $hasChild = url('filter_index?category=').$parents->slug;
      }


      $option .= '<li>
      <div class="link"><a href='.$hasChild.'><img style="width:16px;height:16px;margin-right: 7px;" class="img-fuild" src="'.asset($parents->path).'"> '.$parents->categories_name. ' '.$hasChildicon.'</a></div>';

        if(isset($parents->childs)){
          $total = '';
          $i = 1;
          $option.=' <ul class="submenu">';
          $option .= recent12Childcat($parents->childs, $i, $parent_id);
           $option.=' </ul></li>';
        }

    }

  echo $option;
}
}
 function recent12Childcat($childs, $i, $parent_id){

  $contents = '';
  foreach($childs as $key => $child){
    $dash = '';
    for($j=1; $j<=$i; $j++){
        $dash .=  '&nbsp;&nbsp;';
    }

    $contents.= '<li>
        <a class="list-link common-hover" href='.url('filter_index?category=').$child->slug.' > '.$dash.'
        <span  class="fa">&#xf105;</span>

        '.$child->categories_name.'
        </a>
      </li>';

    if(isset($child->childs)){
      $k = $i+1;
      $contents.= shopChildcat($child->childs,$k,$parent_id);
    }
    elseif($i>0){
      $i=1;
     
    }

  }
  return $contents;
}


 function recent12Recursivecategories(){
  $items = DB::table('categories')
      ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
      ->leftJoin('image_categories', 'categories.categories_icon', '=', 'image_categories.image_id')
      ->select('categories.categories_id', 'categories.categories_slug as slug', 'image_categories.path as path', 'categories_description.categories_name', 'categories.parent_id', 'categories.categories_status')
      ->where('categories_description.language_id','=', Session::get('language_id'))
      ->where('categories.categories_status','=', 1)
      ->groupBy('categories.categories_id')
      ->get();
   if($items->isNotEmpty()){
      $childs = array();

      foreach($items as $item)
          $childs[$item->parent_id][] = $item;

      foreach($items as $item) if (isset($childs[$item->categories_id]))
          $item->childs = $childs[$item->categories_id];

      $tree = $childs[0];
      return  $tree;
    }
}

 ?>
