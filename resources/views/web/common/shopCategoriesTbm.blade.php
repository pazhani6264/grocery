<?php

 function shopCategories(){
  $categories = shopRecursivecategories();
  if($categories){
  $parent_id = 0;
  $option = '';
   // dd($categories);
    foreach($categories as $parents){

     $parent_slug  = $parents->slug;

     $product_count = DB::table('products_to_categories')->where('categories_id', $parents->categories_id)->count();
     

     if(isset($parents->childs)){
        $hasChildicon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
      </svg>'; 
        $hasChild = "#".$parents->slug;
        $product_count = "";
      }else {
        $hasChildicon = "";
        $product_count = '<span class="">('.$product_count.')</span>';
        $hasChild = url('shop?category=').$parents->slug;
      }


      $option .= '<li>
      <div class="link"><a class="p24-hover-underline" href='.$hasChild.'>'.$parents->categories_name. ' '.$hasChildicon.' '.$product_count.'</a></div>';

        if(isset($parents->childs)){
          $total = '';
          $i = 1;
          $option.=' <ul class="submenu">';
          $option .= shopChildcat($parents->childs, $i, $parent_id);
           $option.=' </ul></li>';
        }

    }

  echo $option;
}
}
 function shopChildcat($childs, $i, $parent_id){

  $contents = '';
  
  foreach($childs as $key => $child){
    $product_count_child = DB::table('products_to_categories')->where('categories_id', $child->categories_id)->count();

    $dash = '';
    for($j=1; $j<=$i; $j++){
        $dash .=  '&nbsp;&nbsp;';
    }

    $contents.= '<li>
        <a class="list-link common-hove p24-hover-underline" href='.url('shop?category=').$child->slug.' > '.$dash.'
        <span  class="fa">&#xf105;</span>

        '.$child->categories_name.'  <span class="">('.$product_count_child.')</span>
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


 function shopRecursivecategories(){
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
