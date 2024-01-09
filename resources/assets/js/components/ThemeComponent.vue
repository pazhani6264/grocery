<template>
  <div class="container-fluid">
   <div style="margin-top:10px;">
    <div  v-if="this.responses.themeSetResponse == 1" class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> Theme Has been activated!.
    </div>
    <div  v-if="this.responses.themeSetResponse == 0" class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Opps!</strong> No Change has been made!.
    </div>
    <div class="row">
      <h2 class="page_build_heading">Home Page Builder</h2>
      <p class="page_build_paragraph">Laravel Ecommerce comes with home page builder, you can choose header, footer, slider and banner style as per your client needs. We have designed many sections. You can drag and drop each section to set the arrangement of sections for your site home page. In case, you don't want to show any purticular section, you can hide it as well. We shall add more sections in next updates.</p>
    </div>
  </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <a :href="'/admin/webPagesSettings'+'/1'" class="btn  btn-danger btn_custom_style1"> Cancel </a>&nbsp;
        <button  @click="setTheme()" class="btn btn-primary btn_custom_style1">Apply Changes </button>
      </div>
    </div>
      <div class="row">
        <div class="col-sm-3 col-md-6 col-lg-4">
          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Header </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="header in headers" @click="HeaderSetter(header)" style="width:100%"  v-bind:src="'/'+header.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="carousalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Carousal </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="carousal in carousals" @click="CarousalSetter(carousal)" style="width:100%"  v-bind:src="'/'+carousal.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Banner </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed active">
                          <img data-dismiss="modal" v-for="banner in banners" @click="BannerSetter(banner)" style="width:100%"  v-bind:src="'/'+banner.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Footer </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="footer in footers" @click="FooterSetter(footer)" style="width:100%"  v-bind:src="'/'+footer.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Brand </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="brand in brands" @click="BrandSetter(brand)" style="width:100%"  v-bind:src="'/'+brand.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="infoBoxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Info Box </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="info_box in info_boxes" @click="InfoBoxSetter(info_box)" style="width:100%"  v-bind:src="'/'+info_box.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


           <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="instagramModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Info Box </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="instagram in instagrams" @click="InstagramSetter(instagram)" style="width:100%"  v-bind:src="'/'+instagram.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>



          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="specialProModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Special Product </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="special_pro in special_pros" @click="SpecialProSetter(special_pro)" style="width:100%"  v-bind:src="'/'+special_pro.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


           <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="trendProModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Trending Product </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="trend_pro in trend_pros" @click="TrendProSetter(trend_pro)" style="width:100%"  v-bind:src="'/'+trend_pro.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="newDealModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose New Deal </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="new_deal in new_deals" @click="NewDealSetter(new_deal)" style="width:100%"  v-bind:src="'/'+new_deal.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


           <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="tabSectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Tab Section </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="tab_section in tab_sections" @click="TabSectionSetter(tab_section)" style="width:100%"  v-bind:src="'/'+tab_section.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="topSellModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Top Selling </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="top_sell in top_sells" @click="TopSellSetter(top_sell)" style="width:100%"  v-bind:src="'/'+top_sell.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="recentArrivalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose New Arrival </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="recent_arrival in recent_arrivals" @click="RecentArrivalSetter(recent_arrival)" style="width:100%"  v-bind:src="'/'+recent_arrival.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="multibannerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Banner </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="multibanner in multibanners" @click="MultibannerSetter(multibanner)" style="width:100%"  v-bind:src="'/'+multibanner.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="multibanneroneModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Banner </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="multibanner_one in multibanners_one" @click="MultibanneroneSetter(multibanner_one)" style="width:100%"  v-bind:src="'/'+multibanner_one.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


           <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="multibannertwoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Banner </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="multibanner_two in multibanners_two" @click="MultibannertwoSetter(multibanner_two)" style="width:100%"  v-bind:src="'/'+multibanner_two.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Category </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="category in categories" @click="CategorySetter(category)" style="width:100%"  v-bind:src="'/'+category.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="productcategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Product Category </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="productcategory in productcategories" @click="ProductCategorySetter(productcategory)" style="width:100%"  v-bind:src="'/'+productcategory.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Blog </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="blog in blogs" @click="BlogSetter(blog)" style="width:100%"  v-bind:src="'/'+blog.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="whychooseusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Why Choose Us </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="whychooseus in whychooseuss" @click="WhychooseusSetter(whychooseus)" style="width:100%"  v-bind:src="'/'+whychooseus.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>


           <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="customer_reviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Customer Review </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="customer_review in customer_reviews" @click="CustomerReviewSetter(customer_review)" style="width:100%"  v-bind:src="'/'+customer_review.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Subscribe </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="subscribe in subscribes" @click="SubscribeSetter(subscribe)" style="width:100%"  v-bind:src="'/'+subscribe.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          


          <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="flashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h3 class="modal-title text-primary" id="myModalLabel">Choose Flash Sales </h3>
                        </div>
                        <div class="modal-body manufacturer-image-embed">
                          <img data-dismiss="modal" v-for="flash in flashes" @click="FlashSetter(flash)" style="width:100%"  v-bind:src="'/'+flash.image">
                        </div>
                    </div>
                </div>
            </div>
          </div>
          

        </div>
        <div class="col-sm-12 dragable-content">
          <div class="row">
              <div class="col-sm-12 dragable-box" id="header_img">
                <div class="row">
                    <div class="col-sm-12">
                      <img   style="width:100%" v-for="header in headers" v-if="header.id == current_theme.header && path_of_header == ''" v-bind:src="'/'+header.image">
                      <img   style="width:100%" v-if="path_of_header != ''" v-bind:src="'/'+path_of_header">
                    </div>
                    <div class="hover_option header_options">
                      <button data-toggle="modal" data-target="#myModal" class="btn  btn-primary btn_custom_style">
                        <i data-toggle="tooltip" title="Choose Header"  class="fa fa-check-square-o"></i> &nbsp;Choose
                      </button>
                    </div>
                  </div>
              </div>
              <div class="col-sm-12 dragable-box" id="carousal_img">
                <div class="row">
                    <div class="col-sm-12">
                      <img   style="width:100%" v-for="carousal in carousals" v-if="carousal.id == current_theme.carousel && path_of_carousal == ''" v-bind:src="'/'+carousal.image">
                      <img   style="width:100%" v-if="path_of_carousal != ''" v-bind:src="'/'+path_of_carousal">
                    </div>
                    <div class="hover_option carousal_options">
                      <button data-toggle="modal" data-target="#carousalModal" class="btn  btn-primary btn_custom_style">
                        <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Carousal"></i> &nbsp;Choose
                      </button>                    
                      
                    </div>
                  </div>
              </div>
              <div class="col-sm-12">
                  <div class="row">
                  <draggable v-model="product_section_orderss" @change="update">
                    <div :id="['banner_img_' + product_section_order.order]" class="col-sm-12 dragable-box dragable-box-cursor" v-for="product_section_order in product_section_orderss">
                      <div class="row" >
                        <div class="col-sm-12">
                             <img v-if="product_section_order['id'] != 1  && product_section_order['status'] == 1" style="width:100%" v-bind:alt="product_section_order['name']" v-bind:src="'/'+product_section_order['image']">
                             <img v-if="product_section_order['id'] != 1 && product_section_order['status'] == 0" style="width:100%" v-bind:alt="product_section_order['name']" v-bind:src="'/'+product_section_order['disabled_image']">
                             <img v-for="banner in banners" style="width:100%" v-if="product_section_order['id'] == 1 && product_section_order['status'] == 1 && banner.id == current_theme.banner && path_of_banner == ''"  v-bind:alt="product_section_order['name']" v-bind:src="'/'+banner.image">
                             <img v-for="banner in banners" style="width:100%" v-if="product_section_order['id'] == 1 && product_section_order['status'] == 0 && banner.id == current_theme.banner && path_of_banner == ''"  v-bind:alt="product_section_order['name']" v-bind:src="'/images/prototypes/banner1-cross.jpg'">
                             <img style="width:100%" v-if="product_section_order['id'] == 1 && product_section_order['status'] == 1 && path_of_banner != ''"  v-bind:src="'/'+path_of_banner">
                             <img style="width:100%" v-if="product_section_order['id'] == 1 && product_section_order['status'] == 0 && path_of_banner != ''"  v-bind:src="'/images/prototypes/banner1-cross.jpg'">
                        </div>

                        <div :class="['hover_option banner_options_' + product_section_order.order]">
                          <div class="" v-if="product_section_order['id'] == 1 ">
                            <button data-toggle="modal" data-target="#bannerModal" class="btn  btn-primary btn_custom_style">
                              <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Banner"></i> &nbsp; Choose
                            </button>
                          </div>
                          <div class="">
                            <button @click="changeStatus(product_section_order['id'])"class="btn  btn-primary btn_custom_style">
                              <i v-if="product_section_order['status'] == 1"class="fa fa-eye"  data-toggle="tooltip" title="Deactive this Section"></i>
                              <i v-if="product_section_order['status'] == 0"class="fa fa-eye" data-toggle="tooltip" title="Active this Section"></i> &nbsp; Show/Hide
                            </button>
                          </div>
                          
                        </div>
                      </div>
                      </div>
                  </draggable>
                  </div>
                </div>
              <div class="col-sm-12 dragable-box" id="footer_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="footer in footers" v-if="footer.id == current_theme.footer && path_of_footer == ''" v-bind:src="'/'+footer.image">
                  <img   style="width:100%" v-if="path_of_footer != ''" v-bind:src="'/'+path_of_footer">
                </div>
                <div class="hover_option footer_options">
                  <button data-toggle="modal" data-target="#footerModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Footer"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

              <div class="col-sm-12 dragable-box" id="brand_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="brand in brands" v-if="brand.id == current_theme.brand && path_of_brand == ''" v-bind:src="'/'+brand.image">
                  <img   style="width:100%" v-if="path_of_brand != ''" v-bind:src="'/'+path_of_brand">
                </div>
                <div class="hover_option brand_options">
                  <button data-toggle="modal" data-target="#brandModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Brand"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

               <div class="col-sm-12 dragable-box" id="info_box_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="info_box in info_boxes" v-if="info_box.id == current_theme.info_box && path_of_info_box == ''" v-bind:src="'/'+info_box.image">
                  <img   style="width:100%" v-if="path_of_info_box != ''" v-bind:src="'/'+path_of_info_box">
                </div>
                <div class="hover_option info_box_options">
                  <button data-toggle="modal" data-target="#infoBoxModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Info Box"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


               <div class="col-sm-12 dragable-box" id="instagram_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="instagram in instagrams" v-if="instagram.id == current_theme.instagram && path_of_instagram == ''" v-bind:src="'/'+instagram.image">
                  <img   style="width:100%" v-if="path_of_instagram != ''" v-bind:src="'/'+path_of_instagram">
                </div>
                <div class="hover_option instagram_options">
                  <button data-toggle="modal" data-target="#instagramModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Instagram"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


              <div class="col-sm-12 dragable-box" id="special_pro_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="special_pro in special_pros" v-if="special_pro.id == current_theme.special_pro && path_of_special_pro == ''" v-bind:src="'/'+special_pro.image">
                  <img   style="width:100%" v-if="path_of_special_pro != ''" v-bind:src="'/'+path_of_special_pro">
                </div>
                <div class="hover_option special_pro_options">
                  <button data-toggle="modal" data-target="#specialProModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Info Box"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>




               <div class="col-sm-12 dragable-box" id="trend_pro_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="trend_pro in trend_pros" v-if="trend_pro.id == current_theme.trend_pro && path_of_trend_pro == ''" v-bind:src="'/'+trend_pro.image">
                  <img   style="width:100%" v-if="path_of_trend_pro != ''" v-bind:src="'/'+path_of_trend_pro">
                </div>
                <div class="hover_option trend_pro_options">
                  <button data-toggle="modal" data-target="#infoBoxModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Info Box"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


              <div class="col-sm-12 dragable-box" id="new_deal_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="new_deal in new_deals" v-if="new_deal.id == current_theme.new_deal && path_of_new_deal == ''" v-bind:src="'/'+new_deal.image">
                  <img   style="width:100%" v-if="path_of_new_deal != ''" v-bind:src="'/'+path_of_new_deal">
                </div>
                <div class="hover_option new_deal_options">
                  <button data-toggle="modal" data-target="#newDealModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose New Deal"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


               <div class="col-sm-12 dragable-box" id="tab_section_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="tab_section in tab_sections" v-if="tab_section.id == current_theme.tab_section && path_of_tab_section == ''" v-bind:src="'/'+tab_section.image">
                  <img   style="width:100%" v-if="path_of_tab_section != ''" v-bind:src="'/'+path_of_tab_section">
                </div>
                <div class="hover_option tab_section_options">
                  <button data-toggle="modal" data-target="#tabSectionModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Tab section"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

              <div class="col-sm-12 dragable-box" id="top_sell_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="top_sell in top_sells" v-if="top_sell.id == current_theme.top_sell && path_of_top_sell == ''" v-bind:src="'/'+top_sell.image">
                  <img   style="width:100%" v-if="path_of_top_sell != ''" v-bind:src="'/'+path_of_top_sell">
                </div>
                <div class="hover_option top_sell_options">
                  <button data-toggle="modal" data-target="#topSellModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Top Selling"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


               <div class="col-sm-12 dragable-box" id="recent_arrival_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="recent_arrival in recent_arrivals" v-if="recent_arrival.id == current_theme.recent_arrival && path_of_recent_arrival == ''" v-bind:src="'/'+recent_arrival.image">
                  <img   style="width:100%" v-if="path_of_recent_arrival != ''" v-bind:src="'/'+path_of_recent_arrival">
                </div>
                <div class="hover_option recent_arrival_options">
                  <button data-toggle="modal" data-target="#recentArrivalModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose New Arrival"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


              <div class="col-sm-12 dragable-box" id="multibanner_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="multibanner in multibanners" v-if="multibanner.id == current_theme.multibanner && path_of_multibanner == ''" v-bind:src="'/'+multibanner.image">
                  <img   style="width:100%" v-if="path_of_multibanner != ''" v-bind:src="'/'+path_of_multibanner">
                </div>
                <div class="hover_option multibanner_options">
                  <button data-toggle="modal" data-target="#multibannerModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Banner"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

               <div class="col-sm-12 dragable-box" id="multibanner_one_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="multibanner_one in multibanners_one" v-if="multibanner_one.id == current_theme.multibanner_one && path_of_multibanner_one == ''" v-bind:src="'/'+multibanner_one.image">
                  <img   style="width:100%" v-if="path_of_multibanner_one != ''" v-bind:src="'/'+path_of_multibanner_one">
                </div>
                <div class="hover_option multibanner_one_options">
                  <button data-toggle="modal" data-target="#multibanneroneModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Banner"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

               <div class="col-sm-12 dragable-box" id="multibanner_two_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="multibanner_two in multibanners_two" v-if="multibanner_two.id == current_theme.multibanner_two && path_of_multibanner_two == ''" v-bind:src="'/'+multibanner_two.image">
                  <img   style="width:100%" v-if="path_of_multibanner_two != ''" v-bind:src="'/'+path_of_multibanner_two">
                </div>
                <div class="hover_option multibanner_two_options">
                  <button data-toggle="modal" data-target="#multibannertwoModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Banner"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


              <div class="col-sm-12 dragable-box" id="category_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="category in categories" v-if="category.id == current_theme.category && path_of_category == ''" v-bind:src="'/'+category.image">
                  <img   style="width:100%" v-if="path_of_category != ''" v-bind:src="'/'+path_of_category">
                </div>
                <div class="hover_option category_options">
                  <button data-toggle="modal" data-target="#categoryModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Category"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


               <div class="col-sm-12 dragable-box" id="productcategory_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="productcategory in productcategories" v-if="productcategory.id == current_theme.productcategory && path_of_productcategory == ''" v-bind:src="'/'+productcategory.image">
                  <img   style="width:100%" v-if="path_of_productcategory != ''" v-bind:src="'/'+path_of_productcategory">
                </div>
                <div class="hover_option productcategory_options">
                  <button data-toggle="modal" data-target="#productcategoryModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Product Category"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>


              <div class="col-sm-12 dragable-box" id="blog_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="blog in blogs" v-if="blog.id == current_theme.blog && path_of_blog == ''" v-bind:src="'/'+blog.image">
                  <img   style="width:100%" v-if="path_of_blog != ''" v-bind:src="'/'+path_of_blog">
                </div>
                <div class="hover_option blog_options">
                  <button data-toggle="modal" data-target="#blogModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Blog"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

              <div class="col-sm-12 dragable-box" id="whychooseus_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="whychooseus in whychooseuss" v-if="whychooseus.id == current_theme.whychooseus && path_of_whychooseus == ''" v-bind:src="'/'+whychooseus.image">
                  <img   style="width:100%" v-if="path_of_whychooseus != ''" v-bind:src="'/'+path_of_whychooseus">
                </div>
                <div class="hover_option whychooseus_options">
                  <button data-toggle="modal" data-target="#whychooseusModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Why Choose Us"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

               <div class="col-sm-12 dragable-box" id="customer_review_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="customer_review in customer_reviews" v-if="customer_review.id == current_theme.customer_review && path_of_customer_review == ''" v-bind:src="'/'+customer_review.image">
                  <img   style="width:100%" v-if="path_of_customer_review != ''" v-bind:src="'/'+path_of_customer_review">
                </div>
                <div class="hover_option customer_review_options">
                  <button data-toggle="modal" data-target="#customer_reviewModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Customer Review"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>

              <div class="col-sm-12 dragable-box" id="subscribe_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="subscribe in subscribes" v-if="subscribe.id == current_theme.subscribe && path_of_subscribe == ''" v-bind:src="'/'+subscribe.image">
                  <img   style="width:100%" v-if="path_of_subscribe != ''" v-bind:src="'/'+path_of_subscribe">
                </div>
                <div class="hover_option subscribe_options">
                  <button data-toggle="modal" data-target="#subscribeModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Subscribe"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>



               <div class="col-sm-12 dragable-box" id="flash_img">
               <div class="row">
                <div class="col-sm-12">
                  <img   style="width:100%" v-for="flash in flashes" v-if="flash.id == current_theme.flash && path_of_flash == ''" v-bind:src="'/'+flash.image">
                  <img   style="width:100%" v-if="path_of_flash != ''" v-bind:src="'/'+path_of_flash">
                </div>
                <div class="hover_option flash_options">
                  <button data-toggle="modal" data-target="#flashModal" class="btn  btn-primary btn_custom_style">
                    <i class="fa fa-check-square-o"  data-toggle="tooltip" title="Choose Info Box"></i> &nbsp; Choose
                  </button>
                </div>

               </div>
              </div>



           </div>
        </div>
        <div class="box-footer text-right">
            <a :href="'/admin/webPagesSettings'+'/1'" class="btn  btn-danger btn_custom_style1"> Cancel </a>&nbsp;
            <button  @click="setTheme()" class="btn btn-primary btn_custom_style1">Apply Changes </button>
        </div>
      </div>


    </div>

</template>

<script>

import draggable from 'vuedraggable'
import axios from 'axios'
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};

    export default {
      components: {
        draggable,
        },
        props: [
          'data'
        ],
        data() {
          return {
              formRequest: {
                header_id : this.data.current_theme.header,
                carousel_id : this.data.current_theme.carousel,
                banner_id : this.data.current_theme.banner,
                banner_two_id : this.data.current_theme.banner_two,
                footer_id : this.data.current_theme.footer,
                brand_id : this.data.current_theme.brand,
                info_box_id : this.data.current_theme.info_box,
                instagram_id : this.data.current_theme.instagram,
                special_pro_id : this.data.current_theme.special_pro,
                trend_pro_id : this.data.current_theme.trend_pro,
                new_deal_id : this.data.current_theme.new_deal,
                tab_section_id : this.data.current_theme.tab_section,
                top_sell_id : this.data.current_theme.top_sell,
                recent_arrival_id : this.data.current_theme.recent_arrival,
                multibanner_id : this.data.current_theme.multibanner,
                multibanner_one_id : this.data.current_theme.multibanner_one,
                multibanner_two_id : this.data.current_theme.multibanner_two,
                category_id : this.data.current_theme.category,
                productcategory_id : this.data.current_theme.productcategory,
                blog_id : this.data.current_theme.blog,
                whychooseus_id : this.data.current_theme.whychooseus,
                customer_review_id : this.data.current_theme.customer_review,
                subscribe_id : this.data.current_theme.subscribe,
                flash_id : this.data.current_theme.flash,
                cart_id : 1,
                news_id : 1,
                detail_id : 1,
                shop_id : 1,
                contact_id : 1
              },
              fileupload : '',
              responses:{
                themeSetResponse : -1
              },
              headers : this.data.data.headers,
              carousals : this.data.data.carousels,
              banners : this.data.data.banners,
              product_section_orderss : this.data.data.product_section_order,
              footers : this.data.data.footers,
              brands : this.data.data.brands,
              info_boxes : this.data.data.info_boxes,
              instagrams : this.data.data.instagrams,
              special_pros : this.data.data.special_pros,
              trend_pros : this.data.data.trend_pros,
              new_deals : this.data.data.new_deals,
              tab_sections : this.data.data.tab_sections,
              top_sells : this.data.data.top_sells,
              recent_arrivals : this.data.data.recent_arrivals,
              multibanners : this.data.data.multibanners,
              multibanners_one : this.data.data.multibanners_one,
              multibanners_two : this.data.data.multibanners_two,
              categories : this.data.data.categories,
              productcategories : this.data.data.productcategories,
              flashes : this.data.data.flashes,
              current_theme : this.data.current_theme,
              banners_for_styles :  this.data.data.homeBanners,
              path_of_header : '',
              path_of_carousal : '',
              path_of_banner : '',
              banner_id_for_href : this.data.current_theme.banner,
              banner_two_id_for_href : this.data.current_theme.banner_two,
              path_of_footer : '',
              path_of_brand : '',
              path_of_info_box : '',
              path_of_instagram : '',
              path_of_special_pro : '',
              path_of_trend_pro : '',
              path_of_new_deal : '',
              path_of_tab_section : '',
              path_of_top_sell : '',
              path_of_recent_arrival : '',
              path_of_multibanner : '',
              path_of_multibanner_one : '',
              path_of_multibanner_two : '',
              path_of_category : '',
              path_of_productcategory : '',
              path_of_blog : '',
              path_of_whychooseus : '',
              path_of_customer_review : '',
              path_of_subscribe : '',
              path_of_flash : '',

          }
        },

        methods: {
           HeaderSetter(header){
             this.path_of_header = header.image;
             this.formRequest.header_id = header.id;
           },
           CarousalSetter(carousal){
             this.path_of_carousal = carousal.image;
             this.formRequest.carousel_id = carousal.id;
           },
           BannerSetter(banner){
             this.path_of_banner = banner.image;
             this.formRequest.banner_id = banner.id;
             this.banner_id_for_href = banner.id;
           },
           FooterSetter(footer){
             this.path_of_footer = footer.image;
             this.formRequest.footer_id = footer.id;
           },
           BrandSetter(brand){
             this.path_of_brand = brand.image;
             this.formRequest.brand_id = brand.id;
           },
           InfoBoxSetter(info_box){
             this.path_of_info_box = info_box.image;
             this.formRequest.info_box_id = info_box.id;
           },
            InstagramSetter(instagram){
             this.path_of_instagram = instagram.image;
             this.formRequest.instagram_id = instagram.id;
           },
           SpecialProSetter(special_pro){
             this.path_of_special_pro = special_pro.image;
             this.formRequest.special_pro_id = special_pro.id;
           },
           TrendProSetter(trend_pro){
             this.path_of_trend_pro = trend_pro.image;
             this.formRequest.trend_pro_id = trend_pro.id;
           },
           NewDealSetter(new_deal){
             this.path_of_new_deal = new_deal.image;
             this.formRequest.new_deal_id = new_deal.id;
           },
           TabSectionSetter(tab_section){
             this.path_of_tab_section = tab_section.image;
             this.formRequest.tab_section_id = tab_section.id;
           },
           TopSellSetter(top_sell){
             this.path_of_top_sell = top_sell.image;
             this.formRequest.top_sell_id = top_sell.id;
           },
           RecentArrivalSetter(recent_arrival){
             this.path_of_recent_arrival = recent_arrival.image;
             this.formRequest.recent_arrival_id = recent_arrival.id;
           },
           MultibannerSetter(multibanner){
             this.path_of_multibanner = multibanner.image;
             this.formRequest.multibanner_id = multibanner.id;
           },
            MultibanneroneSetter(multibanner_one){
             this.path_of_multibanner_one = multibanner_one.image;
             this.formRequest.multibanner_one_id = multibanner_one.id;
           },
           MultibannertwoSetter(multibanner_two){
             this.path_of_multibanner_two = multibanner_two.image;
             this.formRequest.multibanner_two_id = multibanner_two.id;
           },
            CategorySetter(category){
             this.path_of_category = category.image;
             this.formRequest.category_id = category.id;
           },
            ProductCategorySetter(productcategory){
             this.path_of_productcategory = productcategory.image;
             this.formRequest.productcategory_id = productcategory.id;
           },
           BlogSetter(blog){
             this.path_of_blog = blog.image;
             this.formRequest.blog_id = blog.id;
           },
            WhychooseusSetter(whychooseus){
             this.path_of_whychooseus = whychooseus.image;
             this.formRequest.whychooseus_id = whychooseus.id;
           },
           CustomerReviewSetter(customer_review){
             this.path_of_customer_review = customer_review.image;
             this.formRequest.customer_review_id = customer_review.id;
           },
            SubscribeSetter(subscribe){
             this.path_of_subscribe = subscribe.image;
             this.formRequest.subscribe_id = subscribe.id;
           },
           FlashSetter(flash){
             this.path_of_flash = flash.image;
             this.formRequest.flash_id = flash.id;
           },
           update(){
             this.product_section_orderss.map((product_section_orders, index) => {
               product_section_orders.order = index + 1;
             })
             axios.post('reorder', {
               product_section_orders : this.product_section_orderss
              }).then((response) => {
             })
           },
           changeStatus(id){
             axios.post('changestatus', {
                    id: id,
                    product_section_orders : this.product_section_orderss

                  })
                  .then(response => {
                    if(response.status===200){
                      this.product_section_orderss = response.data;
                    }
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
           },
           setTheme(){
             axios.post('setting/set', {
                    request: this.formRequest
                  })
                  .then(response => {
                    if(response.status===200){
                      this.responses.themeSetResponse = response.data;
                       window.scrollTo(0,0);
                    }
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
           }

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
