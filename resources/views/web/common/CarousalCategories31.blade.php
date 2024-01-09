
<?php

 function productCategories31(){
  $categories = recursivecategories31();
  if($categories){
  $parent_id = 0;
  $option = '';
   // dd($categories);
    foreach($categories as $parents){

     $parent_slug  = $parents->slug;
     

     if(isset($parents->childs)){
        $hasChild = "href=#".$parents->slug."  data-toggle='collapse' data-target='#submenu$parents->categories_id'"; 
        $iconspan = "<span class='pull-right'><i class='fa fa-angle-down'></i></span>";
      }else {
        $hasChild = "href=".url('shop?category=').$parents->slug;
        $iconspan = "";
      }

      $option .= '<li class="csal-31">
       <a  class="accordion-heading"'. $hasChild .'>'.$parents->categories_name.$iconspan.'</a>';

        if(isset($parents->childs)){
          $total = '';
          $i = 1;
          $option.=' <ul class="nav nav-list collapse" id="submenu'.$parents->categories_id.'"">';
          $option .= childcat31($parents->childs, $i, $parent_id);
           $option.=' </ul> </li>';
        }

    }

  echo $option;
}
}
 function childcat31($childs, $i, $parent_id){

  $contents = '';
  foreach($childs as $key => $child){
    $dash = '';
    for($j=1; $j<=$i; $j++){
        $dash .=  '&nbsp;&nbsp;';
    }

    $contents.= '<li class="csal-31">
        <a class="accordion-heading" href='.url('shop?category=').$child->slug.' > '.$dash.''.$child->categories_name.'
        </a>
      </li>';

    if(isset($child->childs)){
      $k = $i+1;
      $contents.= childcat31($child->childs,$k,$parent_id);
    }
    elseif($i>0){
      $i=1;
     
    }

  }
  return $contents;
}


 function recursivecategories31(){
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
