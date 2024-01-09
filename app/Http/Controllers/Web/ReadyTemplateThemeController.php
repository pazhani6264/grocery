<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Routing\Controller;
use Lang;
use View;

class ReadyTemplateThemeController extends Controller
{

    public function theme()
    {
        $index = new Index();
        $data = $index->demofinalTheme();
        $header_id = $data->header;
        $carousel_id = $data->carousel;
        $brand_id = $data->brand;
        $info_boxes_id = $data->info_box;
        $categories_id = $data->category;
        $flash_id = $data->flash;
        $banner_id = $data->banner;
        $footer_id = $data->footer;
        $cart = $data->cart;
        $blog = $data->news;
        $detail = $data->detail;
        $shop = $data->shop;
        $contact = $data->contact;
        $login = $data->login;
        $transitions = $data->transitions;
        $product_section_order = $data->product_section_order;
        $top_offer = $this->setTopOffer();
        $header = $this->setHeader($header_id);
        $mobileheader = $this->mobileHeader($header_id);
        $carousel = $this->setCarousal($carousel_id);
        $brand = $this->setBrand($brand_id);
        $info_boxes = $this->setInfoBoxes($info_boxes_id);
        $categories = $this->setCategories($categories_id);
        $flashes = $this->setFlash($flash_id);
        $banner = $this->setBanner($banner_id);
        $footer = $this->setFooter($footer_id);
        $mobilefooter = $this->mobileFooter($footer_id);  

       
        
        if($detail == 7)
        {
            $layout ='web.remembirdmelayout';
        }   
        else
        {
            $layout ='web.layout';
        }  
        $final_theme = array(
            'top_offer' => $top_offer,
            'header' => $header,
            'mobile_header' => $mobileheader,
            'carousel' => $carousel,
            'brand' => $brand,
            'info_box' => $info_boxes,
            'category' => $categories,
            'flash' => $flashes,
            'banner' => $banner,
            'footer' => $footer,
            'mobile_footer' => $mobilefooter,
            'cart' => $cart,
            'blog' => $blog,
            'detail' => $detail,
            'layout' => $layout,
            'shop' => $shop,
            'contact' => $contact,
            'login'=>$login,
            'transitions'=>$transitions,
            'product_section_order' => $product_section_order,
        );

        return ($final_theme);
    }

    private function setTopOffer()
    {
        $index = new Index();
		$result['commonContent'] = $index->commonContent();
        $top_offer = (string) View::make('web.headers.topoffer', ['result' => $result])->render();
        return $top_offer;
    }

    private function setHeader($header_id)
    {
        $index = new Index();
        $languages = new Languages();
        $products = new Products();
        $currencies = new Currency();

        $languages = $languages->languages();
        $currencies = $currencies->getter();
        $productcategories = $products->productCategories();
        if (Auth::guard('customer')->check()) {
            $count = $index->compareCount();
        } else {
            $count = "";
        }
        $title = array('pageTitle' => Lang::get("website.Home"));
        $result = array();
        $result['commonContent'] = $index->commonContent();

        if ($header_id == 1) {

            $header = (string) View::make('web.headers.headerOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 2) {
            $header = (string) View::make('web.headers.headerTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 3) {
            $header = (string) View::make('web.headers.headerThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 4) {
            $header = (string) View::make('web.headers.headerFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 5) {
            $header = (string) View::make('web.headers.headerFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 6) {
            $header = (string) View::make('web.headers.headerSix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 7) {
            $header = (string) View::make('web.headers.headerSeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 8) {
            $header = (string) View::make('web.headers.headerEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 9) {
            $header = (string) View::make('web.headers.headerNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 10) {
            $header = (string) View::make('web.headers.headerTen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 11) {
            $header = (string) View::make('web.headers.headerEleven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 12) {
            $header = (string) View::make('web.headers.headerTwele', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 13) {
            $header = (string) View::make('web.headers.headerThirteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 14) {
            $header = (string) View::make('web.headers.headerFourteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 15) {
            $header = (string) View::make('web.headers.headerFifteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 16) {
            $header = (string) View::make('web.headers.headerSixteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 17) {
            $header = (string) View::make('web.headers.headerSeventeen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 18) {
            $header = (string) View::make('web.headers.headerEighteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 19) {
            $header = (string) View::make('web.headers.headerNinteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 20) {
            $header = (string) View::make('web.headers.headerTwenty', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 21) {
            $header = (string) View::make('web.headers.headerTwentyOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 22) {
            $header = (string) View::make('web.headers.headerTwentyTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 23) {
            $header = (string) View::make('web.headers.headerTwentyThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 24) {
            $header = (string) View::make('web.headers.headerTwentyFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 25) {
            $header = (string) View::make('web.headers.headerTwentyFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 26) {
            $header = (string) View::make('web.headers.headerTwentySix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 27) {
            $header = (string) View::make('web.headers.headerTwentySeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 28) {
            $header = (string) View::make('web.headers.headerTwentyEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 29) {
            $header = (string) View::make('web.headers.headerTwentyNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 30) {
            $header = (string) View::make('web.headers.headerThirty', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 31) {
            $header = (string) View::make('web.headers.headerThirtyOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 32) {
            $header = (string) View::make('web.headers.headerThirtyTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 33) {
            $header = (string) View::make('web.headers.headerThirtyThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 34) {
            $header = (string) View::make('web.headers.headerThirtyFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 35) {
            $header = (string) View::make('web.headers.headerThirtyFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 36) {
            $header = (string) View::make('web.headers.headerThirtySix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 37) {
            $header = (string) View::make('web.headers.headerThirtySeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 38) {
            $header = (string) View::make('web.headers.headerThirtyEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } elseif ($header_id == 39) {
            $header = (string) View::make('web.headers.headerThirtyNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }
        
        
        return $header;
    }

    private function mobileHeader($header_id)
    {
        $index = new Index();
        $languages = new Languages();
        $products = new Products();
        $currencies = new Currency();

        $languages = $languages->languages();
        $currencies = $currencies->getter();
        $productcategories = $products->productCategories();
        if (Auth::guard('customer')->check()) {
            $count = $index->compareCount();
        } else {
            $count = "";
        }
        $title = array('pageTitle' => Lang::get("website.Home"));
        $result = array();
        $result['commonContent'] = $index->commonContent();
        if($header_id == 1 || $header_id == 2 || $header_id == 3 || $header_id == 4 || $header_id == 5 || $header_id == 6 || $header_id == 7 || $header_id == 8 || $header_id == 9 || $header_id == 10) {
            $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 11){
            $header = (string) View::make('web.headers.mobile11', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        } else if($header_id == 13){
            $header = (string) View::make('web.headers.mobile13', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 14){
            $header = (string) View::make('web.headers.mobile14', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 15 ){
            $header = (string) View::make('web.headers.mobile15', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 16){
            $header = (string) View::make('web.headers.mobile16', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 17){
            $header = (string) View::make('web.headers.mobile17', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 18){
            $header = (string) View::make('web.headers.mobile18', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 19){
            $header = (string) View::make('web.headers.mobile19', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 20){
            $header = (string) View::make('web.headers.mobile20', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 22){
            $header = (string) View::make('web.headers.mobile22', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 23){
            $header = (string) View::make('web.headers.mobile23', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 24){
            $header = (string) View::make('web.headers.mobile24', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 25){
            $header = (string) View::make('web.headers.mobile25', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 27){
            $header = (string) View::make('web.headers.mobile27', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 28){
            $header = (string) View::make('web.headers.mobile28', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 29){
            $header = (string) View::make('web.headers.mobile29', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 30){
            $header = (string) View::make('web.headers.mobile30', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 32){
            $header = (string) View::make('web.headers.mobile32', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 33){
            $header = (string) View::make('web.headers.mobile33', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 34){
            $header = (string) View::make('web.headers.mobile34', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 35){
            $header = (string) View::make('web.headers.mobile35', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 36){
            $header = (string) View::make('web.headers.mobile36', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 37){
            $header = (string) View::make('web.headers.mobile37', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 38){
            $header = (string) View::make('web.headers.mobile38', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else if($header_id == 39){
            $header = (string) View::make('web.headers.mobile39', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }else{
            $header = (string) View::make('web.headers.mobile12', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
        }

        return $header;
    }



    private function setCarousal($carousel_id)
    {
        $languages = new Languages();
        $products = new Products();
        $currencies = new Currency();
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $currentDate = Carbon\Carbon::now();
        $currentDate = $currentDate->toDateTimeString();
        $slides = $index->slidesByCarousel($currentDate, $carousel_id);
        $cates = $products->productCategories1();
        $cates_car = $products->productCategories_car();
        $result['cat'] = $cates_car;

        $cates_old = $products->productCategories_old();
        $result['cat_old'] = $cates_old;

        $result['slides'] = $slides;
        if ($carousel_id == 1) {
            $carousel = (string) View::make('web.carousels.boot-carousel-content-full-screen', ['result' => $result])->render();
        } elseif ($carousel_id == 2) {
            $carousel = (string) View::make('web.carousels.boot-carousel-content-full-width', ['result' => $result])->render();
        } elseif ($carousel_id == 3) {
            $carousel = (string) View::make('web.carousels.boot-carousel-content-with-left-banner', ['result' => $result])->render();
        } elseif ($carousel_id == 4) {
            $carousel = (string) View::make('web.carousels.boot-carousel-content-with-navigation', ['result' => $result])->render();
        } elseif ($carousel_id == 5) {
            $carousel = (string) View::make('web.carousels.boot-carousel-content-with-right-banner', ['result' => $result])->render();
        } elseif ($carousel_id == 6) {
            $carousel = (string) View::make('web.carousels.carousal6', ['result' => $result])->render();
        } elseif ($carousel_id == 7) {
            $carousel = (string) View::make('web.carousels.carousal7', ['result' => $result])->render();
        } elseif ($carousel_id == 8) {
            $carousel = (string) View::make('web.carousels.carousal8', ['result' => $result])->render();
        } elseif ($carousel_id == 9) {
            $carousel = (string) View::make('web.carousels.carousal9', ['result' => $result])->render();
        } elseif ($carousel_id == 10) {
            $carousel = (string) View::make('web.carousels.carousal10', ['result' => $result])->render();
        } elseif ($carousel_id == 11) {
            $carousel = (string) View::make('web.carousels.carousal11', ['result' => $result])->render();
        } elseif ($carousel_id == 12) {
            $carousel = (string) View::make('web.carousels.carousal14', ['result' => $result])->render();
        } elseif ($carousel_id == 13) {
            $carousel = (string) View::make('web.carousels.carousal16', ['result' => $result])->render();
        } elseif ($carousel_id == 14) {
            $carousel = (string) View::make('web.carousels.carousal19', ['result' => $result])->render();
        } elseif ($carousel_id == 15) {
            $carousel = (string) View::make('web.carousels.carousal26', ['result' => $result])->render();
        } elseif ($carousel_id == 16) {
            $carousel = (string) View::make('web.carousels.carousal31', ['result' => $result])->render();
        } elseif ($carousel_id == 17) {
            $carousel = (string) View::make('web.carousels.carousal33', ['result' => $result])->render();
        } elseif ($carousel_id == 18) {
            $carousel = (string) View::make('web.carousels.carousal38', ['result' => $result])->render();
        } 
        elseif ($carousel_id == 19) {
            $carousel = (string) View::make('web.carousels.carousal40', ['result' => $result])->render();
        } 
        return $carousel;
    }



    private function setBrand($brand_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();

        if ($brand_id == 1) {
            $brand = (string) View::make('web.brand.brand1', ['result' => $result])->render();
        } else if ($brand_id == 2){
            $brand = (string) View::make('web.brand.brand2', ['result' => $result])->render();
        } else if ($brand_id == 3){
            $brand = (string) View::make('web.brand.brand3', ['result' => $result])->render();
        } else if ($brand_id == 4){
            $brand = (string) View::make('web.brand.brand4', ['result' => $result])->render();
        } else if ($brand_id == 5){
            $brand = (string) View::make('web.brand.brand5', ['result' => $result])->render();
        } else if ($brand_id == 6){
            $brand = (string) View::make('web.brand.brand6', ['result' => $result])->render();
        } else if ($brand_id == 7){
            $brand = (string) View::make('web.brand.brand7', ['result' => $result])->render();
        } else if ($brand_id == 8){
            $brand = (string) View::make('web.brand.brand8', ['result' => $result])->render();
        } else if ($brand_id == 9){
            $brand = (string) View::make('web.brand.brand9', ['result' => $result])->render();
        } else if ($brand_id == 10){
            $brand = (string) View::make('web.brand.brand10', ['result' => $result])->render();
        }
        return $brand;
    }
    

    private function setBanner($banner_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();

        if ($banner_id == 1) {
            $banner = (string) View::make('web.banners.banner1', ['result' => $result])->render();
        } elseif ($banner_id == 2) {
            $banner = (string) View::make('web.banners.banner2', ['result' => $result])->render();
        } elseif ($banner_id == 3) {
            $banner = (string) View::make('web.banners.banner3', ['result' => $result])->render();
        } elseif ($banner_id == 4) {
            $banner = (string) View::make('web.banners.banner4', ['result' => $result])->render();
        } elseif ($banner_id == 5) {
            $banner = (string) View::make('web.banners.banner5', ['result' => $result])->render();
        } elseif ($banner_id == 6) {
            $banner = (string) View::make('web.banners.banner6', ['result' => $result])->render();
        } elseif ($banner_id == 7) {
            $banner = (string) View::make('web.banners.banner7', ['result' => $result])->render();
        } elseif ($banner_id == 8) {
            $banner = (string) View::make('web.banners.banner8', ['result' => $result])->render();
        } elseif ($banner_id == 9) {
            $banner = (string) View::make('web.banners.banner9', ['result' => $result])->render();
        } elseif ($banner_id == 10) {
            $banner = (string) View::make('web.banners.banner10', ['result' => $result])->render();
        } elseif ($banner_id == 11) {
            $banner = (string) View::make('web.banners.banner11', ['result' => $result])->render();
        } elseif ($banner_id == 12) {
            $banner = (string) View::make('web.banners.banner12', ['result' => $result])->render();
        } elseif ($banner_id == 13) {
            $banner = (string) View::make('web.banners.banner13', ['result' => $result])->render();
        } elseif ($banner_id == 14) {
            $banner = (string) View::make('web.banners.banner14', ['result' => $result])->render();
        } elseif ($banner_id == 15) {
            $banner = (string) View::make('web.banners.banner15', ['result' => $result])->render();
        } elseif ($banner_id == 16) {
            $banner = (string) View::make('web.banners.banner16', ['result' => $result])->render();
        } elseif ($banner_id == 17) {
            $banner = (string) View::make('web.banners.banner17', ['result' => $result])->render();
        } elseif ($banner_id == 18) {
            $banner = (string) View::make('web.banners.banner18', ['result' => $result])->render();
        } elseif ($banner_id == 19) {
            $banner = (string) View::make('web.banners.banner19', ['result' => $result])->render();
        } elseif ($banner_id == 20) {
            $banner = (string) View::make('web.banners.banner20', ['result' => $result])->render();
        } elseif ($banner_id == 21) {
            $banner = (string) View::make('web.banners.banner21', ['result' => $result])->render();
        }  elseif ($banner_id == 22) {
            $banner = (string) View::make('web.banners.banner22', ['result' => $result])->render();
        }  elseif ($banner_id == 23) {
            $banner = (string) View::make('web.banners.banner23', ['result' => $result])->render();
        }  elseif ($banner_id == 24) {
            $banner = (string) View::make('web.banners.banner24', ['result' => $result])->render();
        }  elseif ($banner_id == 25) {
            $banner = (string) View::make('web.banners.banner25', ['result' => $result])->render();
        }  elseif ($banner_id == 26) {
            $banner = (string) View::make('web.banners.banner26', ['result' => $result])->render();
        }  elseif ($banner_id == 27) {
            $banner = (string) View::make('web.banners.banner27', ['result' => $result])->render();
        }  elseif ($banner_id == 28) {
            $banner = (string) View::make('web.banners.banner28', ['result' => $result])->render();
        }  elseif ($banner_id == 29) {
            $banner = (string) View::make('web.banners.banner29', ['result' => $result])->render();
        }  elseif ($banner_id == 30) {
            $banner = (string) View::make('web.banners.banner30', ['result' => $result])->render();
        }  elseif ($banner_id == 31) {
            $banner = (string) View::make('web.banners.banner31', ['result' => $result])->render();
        }  elseif ($banner_id == 32) {
            $banner = (string) View::make('web.banners.banner32', ['result' => $result])->render();
        }  elseif ($banner_id == 33) {
            $banner = (string) View::make('web.banners.banner33', ['result' => $result])->render();
        } 
        return $banner;
    }

    private function setFooter($footer_id)
    {
        //print_r($footer_id);die();
        $index = new Index();
        $newss = new News();
        $products = new Products();
        $result['commonContent'] = $index->commonContent();
        $categories_id = '';
        $categories_name = '';
        $limit = 16;
        $type = '';
        $data = array('page_number' => 0, 'type' => $type, 'is_feature' => '', 'limit' => $limit, 'categories_id' => $categories_id, 'load_news' => 0);
        $news = $newss->getAllNews($data);
        $result['news'] = $news;
        $result['categories'] = $products->categories();

        if ($footer_id == 1) {
            $footer = (string) View::make('web.footers.footer1', ['result' => $result])->render();
        } elseif ($footer_id == 2) {
            $footer = (string) View::make('web.footers.footer2', ['result' => $result])->render();
        } elseif ($footer_id == 3) {
            $footer = (string) View::make('web.footers.footer3', ['result' => $result])->render();
        } elseif ($footer_id == 4) {
            $footer = (string) View::make('web.footers.footer4', ['result' => $result])->render();
        } elseif ($footer_id == 5) {
            $footer = (string) View::make('web.footers.footer5', ['result' => $result])->render();
        } elseif ($footer_id == 6) {
            $footer = (string) View::make('web.footers.footer6', ['result' => $result])->render();
        } elseif ($footer_id == 7) {
            $footer = (string) View::make('web.footers.footer7', ['result' => $result])->render();
        } elseif ($footer_id == 8) {
            $footer = (string) View::make('web.footers.footer8', ['result' => $result])->render();
        } elseif ($footer_id == 9) {
            $footer = (string) View::make('web.footers.footer9', ['result' => $result])->render();
        } elseif ($footer_id == 10) {
            $footer = (string) View::make('web.footers.footer10', ['result' => $result])->render();
        }elseif ($footer_id == 11) {
            $footer = (string) View::make('web.footers.footer11', ['result' => $result])->render();
        }elseif ($footer_id == 12) {
            $footer = (string) View::make('web.footers.footer12', ['result' => $result])->render();
        }elseif ($footer_id == 13) {
            $footer = (string) View::make('web.footers.footer13', ['result' => $result])->render();
        }elseif ($footer_id == 14) {
            $footer = (string) View::make('web.footers.footer14', ['result' => $result])->render();
        }elseif ($footer_id == 15) {
            $footer = (string) View::make('web.footers.footer15', ['result' => $result])->render();
        }elseif ($footer_id == 16) {
            $footer = (string) View::make('web.footers.footer16', ['result' => $result])->render();
        }elseif ($footer_id == 17) {
            $footer = (string) View::make('web.footers.footer17', ['result' => $result])->render();
        }elseif ($footer_id == 18) {
            $footer = (string) View::make('web.footers.footer18', ['result' => $result])->render();
        }elseif ($footer_id == 19) {
            $footer = (string) View::make('web.footers.footer19', ['result' => $result])->render();
        }elseif ($footer_id == 20) {
            $footer = (string) View::make('web.footers.footer20', ['result' => $result])->render();
        }elseif ($footer_id == 21) {
            $footer = (string) View::make('web.footers.footer21', ['result' => $result])->render();
        }elseif ($footer_id == 22) {
            $footer = (string) View::make('web.footers.footer22', ['result' => $result])->render();
        }elseif ($footer_id == 23) {
            $footer = (string) View::make('web.footers.footer23', ['result' => $result])->render();
        }elseif ($footer_id == 24) {
            $footer = (string) View::make('web.footers.footer24', ['result' => $result])->render();
        }elseif ($footer_id == 25) {
            $footer = (string) View::make('web.footers.footer25', ['result' => $result])->render();
        }elseif ($footer_id == 26) {
            $footer = (string) View::make('web.footers.footer26', ['result' => $result])->render();
        }elseif ($footer_id == 27) {
            $footer = (string) View::make('web.footers.footer27', ['result' => $result])->render();
        }elseif ($footer_id == 28) {
            $footer = (string) View::make('web.footers.footer28', ['result' => $result])->render();
        }elseif ($footer_id == 29) {
            $footer = (string) View::make('web.footers.footer29', ['result' => $result])->render();
        }elseif ($footer_id == 30) {
            $footer = (string) View::make('web.footers.footer30', ['result' => $result])->render();
        }elseif ($footer_id == 31) {
            $footer = (string) View::make('web.footers.footer31', ['result' => $result])->render();
        }elseif ($footer_id == 32) {
            $footer = (string) View::make('web.footers.footer32', ['result' => $result])->render();
        }elseif ($footer_id == 33) {
            $footer = (string) View::make('web.footers.footer33', ['result' => $result])->render();
        }
        return $footer;
    }

    private function mobileFooter($footer_id)
    {
         //print_r($footer_id);die();
         $index = new Index();
         $newss = new News();
         $products = new Products();
         $result['commonContent'] = $index->commonContent();
         $categories_id = '';
         $categories_name = '';
         $limit = 16;
         $type = '';
         $data = array('page_number' => 0, 'type' => $type, 'is_feature' => '', 'limit' => $limit, 'categories_id' => $categories_id, 'load_news' => 0);
         $news = $newss->getAllNews($data);
         $result['news'] = $news;
         $result['categories'] = $products->categories();

        if($footer_id == 1 || $footer_id == 2 || $footer_id == 3 || $footer_id == 4 || $footer_id == 5 || $footer_id == 6 || $footer_id == 7 || $footer_id == 8 || $footer_id == 9 || $footer_id == 10) {
            $footer = (string) View::make('web.footers.mobile', ['result' => $result])->render();
        }else if($footer_id == 11 ){
            $footer = (string) View::make('web.footers.mobile11', ['result' => $result])->render();
        }else if($footer_id == 12 ){
            $footer = (string) View::make('web.footers.mobile12', ['result' => $result])->render();
        }else if($footer_id == 13 ){
            $footer = (string) View::make('web.footers.mobile13', ['result' => $result])->render();
        }else if($footer_id == 14 ){
            $footer = (string) View::make('web.footers.mobile14', ['result' => $result])->render();
        }else if($footer_id == 15 ){
            $footer = (string) View::make('web.footers.mobile15', ['result' => $result])->render();
        }else if($footer_id == 16 ){
            $footer = (string) View::make('web.footers.mobile16', ['result' => $result])->render();
        }else if($footer_id == 17 ){
            $footer = (string) View::make('web.footers.mobile17', ['result' => $result])->render();
        }else if($footer_id == 18 ){
            $footer = (string) View::make('web.footers.mobile18', ['result' => $result])->render();
        }else if($footer_id == 19 ){
            $footer = (string) View::make('web.footers.mobile19', ['result' => $result])->render();
        }else if($footer_id == 20 ){
            $footer = (string) View::make('web.footers.mobile20', ['result' => $result])->render();
        }else if($footer_id == 21 ){
            $footer = (string) View::make('web.footers.mobile21', ['result' => $result])->render();
        }else if($footer_id == 22 ){
            $footer = (string) View::make('web.footers.mobile22', ['result' => $result])->render();
        }else if($footer_id == 23 ){
            $footer = (string) View::make('web.footers.mobile23', ['result' => $result])->render();
        }else if($footer_id == 24 ){
            $footer = (string) View::make('web.footers.mobile24', ['result' => $result])->render();
        }else if($footer_id == 25 ){
            $footer = (string) View::make('web.footers.mobile25', ['result' => $result])->render();
        }else if($footer_id == 26 ){
            $footer = (string) View::make('web.footers.mobile26', ['result' => $result])->render();
        }else if($footer_id == 27 ){
            $footer = (string) View::make('web.footers.mobile27', ['result' => $result])->render();
        }else if($footer_id == 28 ){
            $footer = (string) View::make('web.footers.mobile28', ['result' => $result])->render();
        }else if($footer_id == 29 ){
            $footer = (string) View::make('web.footers.mobile29', ['result' => $result])->render();
        }else if($footer_id == 30 ){
            $footer = (string) View::make('web.footers.mobile30', ['result' => $result])->render();
        }else if($footer_id == 31 ){
            $footer = (string) View::make('web.footers.mobile31', ['result' => $result])->render();
        }else if($footer_id == 32 ){
            $footer = (string) View::make('web.footers.mobile32', ['result' => $result])->render();
        }else if($footer_id == 33 ){
            $footer = (string) View::make('web.footers.mobile33', ['result' => $result])->render();
        }else if($footer_id == 34 ){
            $footer = (string) View::make('web.footers.mobile34', ['result' => $result])->render();
        }
        return $footer;
    }


    private function setInfoBoxes($info_boxes_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        if ($info_boxes_id == 1) {
            $info_boxes = (string) View::make('web.info_box.info_box1', ['result' => $result])->render();
        }else if ($info_boxes_id == 2){
            $info_boxes = (string) View::make('web.info_box.info_box2', ['result' => $result])->render();
        } else if ($info_boxes_id == 3){
            $info_boxes = (string) View::make('web.info_box.info_box3', ['result' => $result])->render();
        } else if ($info_boxes_id == 4){
            $info_boxes = (string) View::make('web.info_box.info_box4', ['result' => $result])->render();
        } else if ($info_boxes_id == 5){
            $info_boxes = (string) View::make('web.info_box.info_box5', ['result' => $result])->render();
        } else if ($info_boxes_id == 6){
            $info_boxes = (string) View::make('web.info_box.info_box6', ['result' => $result])->render();
        } else if ($info_boxes_id == 7){
            $info_boxes = (string) View::make('web.info_box.info_box7', ['result' => $result])->render();
        } else if ($info_boxes_id == 8){
            $info_boxes = (string) View::make('web.info_box.info_box8', ['result' => $result])->render();
        } else if ($info_boxes_id == 9){
            $info_boxes = (string) View::make('web.info_box.info_box9', ['result' => $result])->render();
        } else if ($info_boxes_id == 10){
            $info_boxes = (string) View::make('web.info_box.info_box10', ['result' => $result])->render();
        } else if ($info_boxes_id == 11){
            $info_boxes = (string) View::make('web.info_box.info_box11', ['result' => $result])->render();
        } else if ($info_boxes_id == 12){
            $info_boxes = (string) View::make('web.info_box.info_box12', ['result' => $result])->render();
        }
        return $info_boxes;
    }


    private function setCategories($categories_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        if ($categories_id == 1) {
            $categories = (string) View::make('web.category.category1', ['result' => $result])->render();
        }else  if ($categories_id == 2) {
            $categories = (string) View::make('web.category.category2', ['result' => $result])->render();
        }
        return $categories;
    }



    private function setFlash($flash_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        $cart = '';
        $result['cartArray'] = $products->cartIdArray($cart);

        $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => '10', 'min_price' => '', 'max_price' => '');
        $result['flash_sale'] = $products->products($data);

        if ($flash_id == 1) {
            $flash = (string) View::make('web.flash.flash1', ['result' => $result])->render();
        } else if ($flash_id == 2){
            $flash = (string) View::make('web.flash.flash2', ['result' => $result])->render();
        } else if ($flash_id == 3){
            $flash = (string) View::make('web.flash.flash3', ['result' => $result])->render();
        } else if ($flash_id == 4){
            $flash = (string) View::make('web.flash.flash4', ['result' => $result])->render();
        } else if ($flash_id == 5){
            $flash = (string) View::make('web.flash.flash5', ['result' => $result])->render();
        } 
        return $flash;
    }


}
