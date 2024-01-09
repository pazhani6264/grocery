<style>
.category-3-main-outer
{
  padding: 30px 40px 0 40px;
}
.section-header {
    margin-bottom: 40px;
}
.new-grid {
    display: flex;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
    word-break: break-word;
}
[data-view="6-3"] .grid-item, [data-view="6-2"] .grid-item {
    flex: 0 0 16.66667%;
}
.grid-item {
    flex: 0 0 100%;
    align-items: stretch;
    display: flex;
    margin-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
}
.section-header__title {
    font-weight: 700 !important;
}
.collection-item {
    position: relative;
    display: block;
    flex: 1 1 100%;
    text-align: center;
    margin-bottom: 5px;
}
.collection-image--is-collection img {
    -o-object-fit: cover;
    object-fit: cover;
}
.collection-item {
    margin-bottom: 15px;
}
.collection-image--circle, .collection-image--square {
    padding-bottom: 100%;
}
.collection-image-wrap {
    position: relative;
    transition: all .2s ease;
}
.collection-image-wrap:after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    background-color: #00000007;
    pointer-events: none;
    transition: all .2s ease;
}
.collection-image img {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    -o-object-fit: contain;
    object-fit: contain;
    padding:35px;
}
.collection-item__title {

    font-weight: 600;

}
.collection-item__title {
    display: block;
    margin-top: 5px;
    font-weight: 700;
    padding: 0 7%;
}
.collection-image-wrap:hover {
    transform: translateY(-3px);
    box-shadow: 0 3px 10px #0000001a;
  
}
.collection-item:active .collection-image-wrap {
    transform: scale(.97);
    transition: transform .05s ease-out;
}
.collection-image-wrap:hover:after {
    background-color: transparent;
}
@media only screen and (max-width: 1150px)
{
 
.collection-image img {
    padding: 25px;
}
}

@media only screen and (max-width: 768px)
{
  [data-view="6-3"] .grid-item {
    flex: 0 0 33.33333%;
}
.collection-image img {
    padding:40px;
}
.category-3-main-outer {
    padding: 10px 20px 0 20px;
}
.section-header {
    margin-bottom: 30px;
}
.collection-item {
    margin-bottom: 5px;
}
.section-header .section-header__title {
    margin: 0;
    line-height: 1;
    font-size:18px;
}
.collection-item__title {
    font-weight: 600;
    line-height: 1.5;
    letter-spacing: 0px;
}
}

@media only screen and (max-width: 600px)
{
  .category-3-main-outer {
    padding: 10px 15px 0 15px;
}
.section-header .section-header__title {
    font-size:18px;
}
.collection-image img {
    padding: 15px;
}
.collection-item__title {
    font-size: 12px;
    font-weight: 600;
    line-height: 1.5;
    letter-spacing: 0px;
}
.collection-item {
    margin-bottom: 5px;
}
}


</style>


 @if(!empty($result['commonContent']['categories']))

<?php   $sliced_array = array_slice($result['commonContent']['categories'], 0, 12); ?>
<div class="category-3-main-outer page-width">
  <div class="section-header">
    <h2 class="section-header__title">Popular Categories</h2>
  </div>
  <div class="new-grid" data-view="6-3">
    @foreach($sliced_array as $categories_data)         
    <?php  $url = url('/shop?category='.$categories_data->slug);?>
      <div class="grid-item">
        <a href="{{$url}}" class="collection-item">
          <div class="collection-image-wrap collection-image--square">
            <div class="collection-image collection-image--is-collection image-wrap">
              @if($result['commonContent']['settings']['home_categories_img_icn'] == 'Image')
                <img class="" src="{{asset($categories_data->path)}}" alt="{{$categories_data->name}}">
              @else
                <img class="" src="{{asset($categories_data->iconPath)}}" alt="{{$categories_data->name}}">
              @endif
            </div>
          </div>
          <span class="collection-item__title">{{$categories_data->name}}</span>
        </a>
      </div>
    @endforeach
  </div>
</div>

@endif