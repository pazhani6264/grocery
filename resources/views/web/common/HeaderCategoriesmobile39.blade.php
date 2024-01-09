
<?php

function productCategoriesmobile11(){
 $categories = recursivecategoriesmobile11();
 if($categories){
 $parent_id = 0;
 $option = '';
  // dd($categories);
   foreach($categories as $parents){

    $parent_slug  = $parents->slug;
    

    if(isset($parents->childs)){
       $hasChild = "href=#".$parents->slug."  data-toggle='collapse' role='button' aria-expanded='false' aria-controls='men-cloth'"; 
     }else {
       $hasChild = "href=".url('shop?category=').$parents->slug;;
     }

     $option .= '
      <a style="display:block;" class=" main-manu cate-39-bottom-border mobile-balck"'. $hasChild .'>'.$parents->categories_name.'</a>';

       if(isset($parents->childs)){
         $total = '';
         $i = 1;
         $option.=' <div class="sub-manu collapse multi-collapse" id="'.$parent_slug.'">
                      <ul class="unorder-list">';
         $option .= childcatmobile11($parents->childs, $i, $parent_id);
          $option.=' </div>
                      </ul> ';
       }

   }

 echo $option;
}
}
function childcatmobile11($childs, $i, $parent_id){

 $contents = '';
 foreach($childs as $key => $child){
   $dash = '';
   for($j=1; $j<=$i; $j++){
       $dash .=  '&nbsp;&nbsp;';
   }

   $contents.= '<li style="padding:10px 0px" class="list-item cate-39-bottom-border mobile-balck">
       <a style="padding-left:20px;color:#fff" class="list-link" href='.url('shop?category=').$child->slug.' > '.$dash.''.$child->categories_name.'
       </a>
     </li>';

   if(isset($child->childs)){
     $k = $i+1;
     $contents.= childcatmobile11($child->childs,$k,$parent_id);
   }
   elseif($i>0){
     $i=1;
    
   }

 }
 return $contents;
}


function recursivecategoriesmobile11(){
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
