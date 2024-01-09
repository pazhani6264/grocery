<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\ReadyTemplate;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ReadyTemplateController extends Controller
{
    //

    public function __construct(Setting $setting)
    {
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
    }

    //banners
    public function viewTemplate(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingBanners"));

        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.readyTemplate.index", $title)->with('result', $result);
    }


    

    
    public function updateTemplate($id)
    {
        $message = 'Template Applied Successfully .....';



         if($id == '0'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 1;
            $subscribe_modal = 1;
            $font='roboto';
            $web_color_style='app';
            $color_code = '#28B293';
             $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 0;
            $top_offer = 1;
            $header = 2;
            $carousel = 2;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 1;
            $footer = 9;
            $cart = 1;
            $news = 2;
            $detail =1;
            $shop = 1;
            $contact = 1;
            $login = 2;
            $transitions = 6;
            $banner_two = 1;
            $category = 1;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 1;
            $subscribe = 20;
            $blog = 1;
            $customer_review = 3;
            $tab_section = 1;
            $top_sell = 1;
            $recent_arrival = 1;
            $checkout = 1;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 1;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":11,"name":"Tab Products View","order":1,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":5,"name":"Categories","order":2,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":9,"name":"Top Selling","order":3,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":1,"name":"Banner Section","order":5,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":13,"name":"Category","order":6,"file_name":"Category_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":3,"name":"Special Products Section","order":7,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":14,"name":"Brand Section","order":9,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":11,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":12,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 





        

       elseif($id == '1'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 19;
            $subscribe_modal = 3;
            $font='jost';
            $web_color_style='app.theme.20';
            $color_code = '#a6c76c';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 1;
            $top_offer = 1;
            $header = 11;
            $carousel = 6;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 20;
            $footer = 11;
            $cart = 4;
            $news = 2;
            $detail =8; 
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 2;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":11,"name":"Tab Products View","order":3,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":4,"file_name":"flash_sale_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":5,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":6,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":7,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":8,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":9,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":10,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":11,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        }  else if($id == '2'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 19;
            $subscribe_modal = 3;
            $font='manrope';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 2;
            $top_offer = 1;
            $header = 12;
            $carousel = 7;
            $brand = 1;
            $info_box = 2;
            $flash = 1;
            $banner = 39;
            $footer = 12;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 5;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 3;
            $blog = 4;
            $customer_review = 3;
            $tab_section = 3;
            $top_sell = 2;
            $recent_arrival = 2;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":11,"name":"Tab Products View","order":1,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":7,"name":"Info Boxes","order":4,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":6,"name":"Blog Section","order":5,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":2,"name":"Flash Sale Section","order":7,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":9,"name":"Top Selling","order":9,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":5,"name":"Categories","order":10,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":11,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 
        else if($id == '3'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 20;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.22';
            $color_code = '#fcb941';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 3;
            $top_offer = 1;
            $header = 13;
            $carousel = 8;
            $brand = 12;
            $info_box = 13;
            $flash = 2;
            $banner = 20;
            $footer = 13;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 4;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 4;
            $top_sell = 3;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 1;
            $trend_pro = 1;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":11,"name":"Tab Products View","order":1,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":20,"name":"New Deal","order":2,"file_name":"new_deal","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":2,"name":"Flash Sale Section","order":3,"file_name":"flash_sale_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":14,"name":"Brand Section","order":4,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":21,"name":"Trend Product Section","order":5,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":9,"name":"Top Selling","order":6,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":7,"name":"Info Boxes","order":7,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":8,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":1,"name":"Banner Section","order":9,"file_name":"banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":6,"name":"Blog Section","order":10,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":12,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":13,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":15,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '4'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 21;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.23';
            $color_code = '#39f';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 4;
            $top_offer = 1;
            $header = 14;
            $carousel = 9;
            $brand = 13;
            $info_box = 13;
            $flash = 3;
            $banner = 40;
            $footer = 19;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 4;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 5;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 3;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 2;
            $special_pro = 2;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":5,"name":"Categories","order":1,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":20,"name":"New Deal","order":4,"file_name":"new_deal","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":2,"name":"Flash Sale Section","order":5,"file_name":"flash_sale_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":21,"name":"Trend Product Section","order":7,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":3,"name":"Special Products Section","order":8,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":7,"name":"Info Boxes","order":9,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":10,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":11,"name":"Tab Products View","order":11,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":9,"name":"Top Selling","order":12,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":13,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":15,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '5'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 22;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.24';
            $color_code = '#c66';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 5;
            $top_offer = 1;
            $header = 15;
            $carousel = 10;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 22;
            $footer = 11;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 41;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 6;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 4;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 3;
            $special_pro = 3;
            $instagram = 1;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":3,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":3,"name":"Special Products Section","order":5,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":6,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":18,"name":"Subscribe","order":7,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":22,"name":"Instagram Section","order":8,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":11,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":12,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":13,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":14,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '6'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 23;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 6;
            $top_offer = 1;
            $header = 16;
            $carousel = 11;
            $brand = 3;
            $info_box = 4;
            $flash = 4;
            $banner = 23;
            $footer = 14;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 41;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 7;
            $blog = 5;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 5;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 4;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":2,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":2,"name":"Flash Sale Section","order":3,"file_name":"flash_sale_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":4,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":8,"name":"Newest Product Section","order":5,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":18,"name":"Subscribe","order":7,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":9,"name":"Top Selling","order":10,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":12,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '7'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 24;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.24';
            $color_code = '#c66';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 7;
            $top_offer = 1;
            $header = 17;
            $carousel = 39;
            $brand = 4;
            $info_box = 1;
            $flash = 1;
            $banner = 24;
            $footer = 15;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 6;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 41;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 6;
            $customer_review = 2;
            $tab_section = 5;
            $top_sell = 2;
            $recent_arrival = 7;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 5;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":2,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":6,"name":"Blog Section","order":4,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":19,"name":"Customer Review","order":5,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":7,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":8,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":9,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":7,"name":"Info Boxes","order":10,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":11,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":12,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":13,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":15,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '8'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 25;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.26';
            $color_code = '#eea287';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 8;
            $top_offer = 1;
            $header = 18;
            $carousel = 22;
            $brand = 12;
            $info_box = 5;
            $flash = 1;
            $banner = 25;
            $footer = 16;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 9;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 43;
            $multibanner_one = 44;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 5;
            $top_sell = 2;
            $recent_arrival = 8;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 2;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":14,"name":"Brand Section","order":2,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":3,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":16,"name":"Banner Section three","order":5,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":8,"name":"Newest Product Section","order":6,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":7,"name":"Info Boxes","order":7,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":22,"name":"Instagram Section","order":8,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":2,"name":"Flash Sale Section","order":9,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":10,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":11,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":12,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":13,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":14,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":16,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":17,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '9'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 26;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.27';
            $color_code = '#1cc0a0';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 9;
            $top_offer = 1;
            $header = 19;
            $carousel = 12;
            $brand = 15;
            $info_box = 1;
            $flash = 1;
            $banner = 26;
            $footer = 16;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 7;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 8;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 10;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 6;
            $special_pro = 5;
            $instagram = 3;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":14,"name":"Brand Section","order":2,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":21,"name":"Trend Product Section","order":3,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":3,"name":"Special Products Section","order":5,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":22,"name":"Instagram Section","order":7,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":11,"name":"Tab Products View","order":8,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":9,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":10,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":11,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":12,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":13,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":15,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '10'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 27;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.28';
            $color_code = '#445f84';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 10;
            $top_offer = 1;
            $header = 20;
            $carousel = 23;
            $brand = 1;
            $info_box = 7;
            $flash = 1;
            $banner = 27;
            $footer = 12;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 48;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 9;
            $blog = 8;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 5;
            $recent_arrival = 11;
            $checkout = 3;
            $new_deal = 3;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":7,"name":"Info Boxes","order":2,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":9,"name":"Top Selling","order":5,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":20,"name":"New Deal","order":6,"file_name":"new_deal","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":8,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":14,"name":"Brand Section","order":9,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":5,"name":"Categories","order":12,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":13,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '11'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 28;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 11;
            $top_offer = 1;
            $header = 18;
            $carousel = 13;
            $brand = 1;
            $info_box = 7;
            $flash = 1;
            $banner = 27;
            $footer = 17;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 48;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 9;
            $blog = 8;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 5;
            $recent_arrival = 12;
            $checkout = 3;
            $new_deal = 3;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":8,"name":"Newest Product Section","order":1,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":14,"name":"Brand Section","order":2,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":3,"file_name":"banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":11,"name":"Tab Products View","order":4,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":5,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":6,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":8,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":9,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":10,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":11,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '12'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 29;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 12;
            $top_offer = 1;
            $header = 41;
            $carousel = 25;
            $brand = 1;
            $info_box = 16;
            $flash = 1;
            $banner = 28;
            $footer = 17;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 6;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 13;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":2,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":5,"name":"Categories","order":3,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":7,"name":"Info Boxes","order":4,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":14,"name":"Brand Section","order":5,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":6,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":7,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":8,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":9,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":10,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":3,"name":"Special Products Section","order":11,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '13'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 30;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.23';
            $color_code = '#39f';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 13;
            $top_offer = 1;
            $header = 22;
            $carousel = 26;
            $brand = 5;
            $info_box = 17;
            $flash = 1;
            $banner = 51;
            $footer = 11;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 7;
            $multibanner = 52;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 3;
            $subscribe = 10;
            $blog = 10;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 7;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":5,"name":"Categories","order":1,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":3,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":13,"name":"Category","order":5,"file_name":"Category_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":18,"name":"Subscribe","order":7,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":9,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":12,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":3,"name":"Special Products Section","order":13,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":14,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '14'){


            $topoffer = 0;
            $style = 1;

            $web_card_style = 31;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.22';
            $color_code = '#fcb941';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 14;
            $top_offer = 1;
            $header = 23;
            $carousel = 14;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 73;
            $footer = 18;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 21;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 17;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 15;
            $special_pro = 15;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":9,"name":"Top Selling","order":2,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":3,"name":"Special Products Section","order":3,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":21,"name":"Trend Product Section","order":4,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":18,"name":"Subscribe","order":5,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":7,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":8,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":6,"name":"Blog Section","order":9,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":10,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":8,"name":"Newest Product Section","order":12,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '15'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 22;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 15;
            $top_offer = 1;
            $header = 24;
            $carousel = 30;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 53;
            $footer = 35;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 11;
            $blog = 11;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 6;
            $recent_arrival = 15;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 8;
            $special_pro = 7;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":9,"name":"Top Selling","order":1,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":3,"name":"Special Products Section","order":2,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":1,"name":"Banner Section","order":3,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":21,"name":"Trend Product Section","order":5,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":11,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":12,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '16'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 22;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 16;
            $top_offer = 1;
            $header = 42;
            $carousel = 27;
            $brand = 1;
            $info_box = 8;
            $flash = 1;
            $banner = 53;
            $footer = 14;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 12;
            $blog = 12;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 7;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 8;
            $instagram = 5;
            $whychooseus = 1;
            $product_section_order = '[{"id":7,"name":"Info Boxes","order":1,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":9,"name":"Top Selling","order":2,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":3,"name":"Special Products Section","order":3,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":1,"name":"Banner Section","order":4,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":6,"name":"Blog Section","order":5,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":22,"name":"Instagram Section","order":7,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":8,"name":"Newest Product Section","order":12,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '17'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 22;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.27';
            $color_code = '#1cc0a0';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 17;
            $top_offer = 1;
            $header = 46;
            $carousel = 39;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 54;
            $footer = 20;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 13;
            $blog = 13;
            $customer_review = 3;
            $tab_section = 6;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 6;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":11,"name":"Tab Products View","order":2,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":18,"name":"Subscribe","order":3,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":4,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":22,"name":"Instagram Section","order":5,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":14,"name":"Brand Section","order":6,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":2,"name":"Flash Sale Section","order":7,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":8,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":7,"name":"Info Boxes","order":9,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":10,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":11,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":12,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '18'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 29;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 18;
            $top_offer = 1;
            $header = 43;
            $carousel = 28;
            $brand = 17;
            $info_box = 1;
            $flash = 1;
            $banner = 30;
            $footer = 36;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 16;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 7;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":2,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":14,"name":"Brand Section","order":3,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":22,"name":"Instagram Section","order":4,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":11,"name":"Tab Products View","order":5,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":6,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":7,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":9,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":10,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":12,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '19'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 32;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.29';
            $color_code = '#fcb842';
            $background_type='2';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 19;
            $top_offer = 1;
            $header = 27;
            $carousel = 39;
            $brand = 1;
            $info_box = 11;
            $flash = 1;
            $banner = 55;
            $footer = 23;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 56;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 14;
            $blog = 14;
            $customer_review = 3;
            $tab_section = 7;
            $top_sell = 2;
            $recent_arrival = 17;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 9;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":7,"name":"Info Boxes","order":2,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":11,"name":"Tab Products View","order":3,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":5,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":21,"name":"Trend Product Section","order":7,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":14,"name":"Brand Section","order":9,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":11,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":5,"name":"Categories","order":12,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":13,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '20'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 33;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.27';
            $color_code = '#1cc0a0';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 20;
            $top_offer = 1;
            $header = 44;
            $carousel = 39;
            $brand = 1;
            $info_box = 18;
            $flash = 1;
            $banner = 57;
            $footer = 21;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 58;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 15;
            $blog = 15;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 8;
            $recent_arrival = 18;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 10;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":7,"name":"Info Boxes","order":2,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":9,"name":"Top Selling","order":3,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":15,"name":"Banner Section","order":5,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":6,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":8,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":14,"name":"Brand Section","order":9,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":5,"name":"Categories","order":12,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":13,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '21'){

            $topoffer = 1;
            $style = 3;

            $web_card_style = 34;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.30';
            $color_code = '#66f';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 21;
            $top_offer = 1;
            $header = 28;
            $carousel = 15;
            $brand = 1;
            $info_box = 19;
            $flash = 1;
            $banner = 20;
            $footer = 37;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 8;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 16;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 9;
            $recent_arrival = 19;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 9;
            $instagram = 8;
            $whychooseus = 1;
            $product_section_order = '[{"id":9,"name":"Top Selling","order":1,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":3,"name":"Special Products Section","order":2,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":5,"name":"Categories","order":3,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":18,"name":"Subscribe","order":5,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":7,"name":"Info Boxes","order":6,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":22,"name":"Instagram Section","order":7,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":9,"file_name":"banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":6,"name":"Blog Section","order":12,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '22'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 35;
            $subscribe_modal = 3;
            $font='open-sanserif';
            $web_color_style='app.theme.22';
            $color_code = '#fcb941';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 22;
            $top_offer = 1;
            $header = 29;
            $carousel = 29;
            $brand = 18;
            $info_box = 11;
            $flash = 1;
            $banner = 59;
            $footer = 23;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 8;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 17;
            $blog = 16;
            $customer_review = 3;
            $tab_section = 8;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 4;
            $trend_pro = 11;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":2,"file_name":"tab","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":18,"name":"Subscribe","order":3,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":1,"name":"Banner Section","order":4,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":7,"name":"Info Boxes","order":5,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":21,"name":"Trend Product Section","order":6,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":20,"name":"New Deal","order":7,"file_name":"new_deal","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":2,"name":"Flash Sale Section","order":9,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":10,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":5,"name":"Categories","order":11,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":12,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":13,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":15,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '23'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 46;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 23;
            $top_offer = 1;
            $header = 45;
            $carousel = 31;
            $brand = 19;
            $info_box = 20;
            $flash = 1;
            $banner = 60;
            $footer = 22;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 9;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 5;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 20;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 12;
            $special_pro = 10;
            $instagram = 9;
            $whychooseus = 1;
            $product_section_order = '[{"id":7,"name":"Info Boxes","order":1,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":8,"name":"Newest Product Section","order":2,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":19,"name":"Customer Review","order":3,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":3,"name":"Special Products Section","order":4,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":1,"name":"Banner Section","order":5,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":6,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":14,"name":"Brand Section","order":7,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":22,"name":"Instagram Section","order":8,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":11,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":12,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":13,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":14,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":16,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '24'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 36;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.22';
            $color_code = '#fcb941';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 24;
            $top_offer = 1;
            $header = 30;
            $carousel = 32;
            $brand = 8;
            $info_box = 1;
            $flash = 1;
            $banner = 61;
            $footer = 38;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 62;
            $multibanner_one = 41;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 18;
            $blog = 17;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 10;
            $recent_arrival = 21;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 10;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":9,"name":"Top Selling","order":3,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":5,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":16,"name":"Banner Section three","order":6,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":18,"name":"Subscribe","order":7,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":22,"name":"Instagram Section","order":9,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":12,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":13,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":14,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":16,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":17,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '25'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 37;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 25;
            $top_offer = 1;
            $header = 48;
            $carousel = 33;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 63;
            $footer = 24;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 64;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 11;
            $recent_arrival = 22;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 11;
            $instagram = 11;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":2,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":9,"name":"Top Selling","order":3,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":3,"name":"Special Products Section","order":5,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":22,"name":"Instagram Section","order":6,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":14,"name":"Brand Section","order":7,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":8,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":9,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":6,"name":"Blog Section","order":10,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":11,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":12,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":13,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '26'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 38;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.31';
            $color_code = '#61ab00';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 26;
            $top_offer = 1;
            $header = 47;
            $carousel = 16;
            $brand = 20;
            $info_box = 1;
            $flash = 1;
            $banner = 31;
            $footer = 25;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 9;
            $multibanner = 65;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 18;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 12;
            $recent_arrival = 23;
            $checkout = 3;
            $new_deal = 5;
            $trend_pro = 13;
            $special_pro = 12;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":5,"name":"Categories","order":1,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":20,"name":"New Deal","order":4,"file_name":"new_deal","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":9,"name":"Top Selling","order":5,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":21,"name":"Trend Product Section","order":6,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":15,"name":"Banner Section","order":7,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":3,"name":"Special Products Section","order":8,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":14,"name":"Brand Section","order":9,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":6,"name":"Blog Section","order":10,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":11,"name":"Tab Products View","order":11,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":12,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":13,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":14,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":23,"name":"Blog Section","order":15,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '27'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 46;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 27;
            $top_offer = 1;
            $header = 32;
            $carousel = 35;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 20;
            $footer = 26;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 9;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":11,"name":"Tab Products View","order":3,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":4,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":5,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":6,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":7,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":8,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":9,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":10,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":11,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '28'){

            $topoffer = 1;
            $style = 4;

            $web_card_style = 39;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.31';
            $color_code = '#61ab00';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 28;
            $top_offer = 1;
            $header = 33;
            $carousel = 17;
            $brand = 21;
            $info_box = 1;
            $flash = 1;
            $banner = 67;
            $footer = 27;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 10;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 19;
            $blog = 19;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 14;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 13;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":5,"name":"Categories","order":1,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":9,"name":"Top Selling","order":2,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":14,"name":"Brand Section","order":3,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":18,"name":"Subscribe","order":4,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":1,"name":"Banner Section","order":5,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":3,"name":"Special Products Section","order":6,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":11,"name":"Tab Products View","order":8,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":9,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":7,"name":"Info Boxes","order":10,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":8,"name":"Newest Product Section","order":11,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":12,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":13,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":14,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":15,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '29'){

            $topoffer = 0;
            $style = 1;

            $web_card_style = 40;
            $subscribe_modal = 3;
            $font='open-sanserif';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 29;
            $top_offer = 1;
            $header = 34;
            $carousel = 36;
            $brand = 21;
            $info_box = 22;
            $flash = 1;
            $banner = 32;
            $footer = 28;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 10;
            $multibanner = 46;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 20;
            $customer_review = 6;
            $tab_section = 2;
            $top_sell = 15;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 13;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":7,"name":"Info Boxes","order":1,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":18,"name":"Subscribe","order":3,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":9,"name":"Top Selling","order":4,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":19,"name":"Customer Review","order":5,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":6,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":5,"name":"Categories","order":7,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":3,"name":"Special Products Section","order":9,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":8,"name":"Newest Product Section","order":12,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '30'){

            $topoffer = 1;
            $style = 3;

            $web_card_style = 40;
            $subscribe_modal = 3;
            $font='poppins';
            $web_color_style='app.theme.30';
            $color_code = '#66f';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 30;
            $top_offer = 1;
            $header = 35;
            $carousel = 37;
            $brand = 1;
            $info_box = 1;
            $flash = 1;
            $banner = 68;
            $footer = 29;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 69;
            $multibanner_one = 70;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 7;
            $tab_section = 2;
            $top_sell = 16;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 14;
            $instagram = 4;
            $whychooseus = 2;
            $product_section_order = '[{"id":23,"name":"Blog Section","order":1,"file_name":"whychooseus_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":9,"name":"Top Selling","order":3,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":19,"name":"Customer Review","order":5,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":3,"name":"Special Products Section","order":6,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":16,"name":"Banner Section three","order":7,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":6,"name":"Blog Section","order":11,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":12,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":18,"name":"Subscribe","order":13,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":14,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":8,"name":"Newest Product Section","order":15,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":21,"name":"Trend Product Section","order":16,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 


        else if($id == '31'){

            $topoffer = 0;
            $style = 1;
            
            $web_card_style = 41;
            $subscribe_modal = 3;
            $font='roboto';
            $web_color_style='app.theme.21';
            $color_code = '#c96';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 31;
            $top_offer = 1;
            $header = 36;
            $carousel = 38;
            $brand = 21;
            $info_box = 21;
            $flash = 1;
            $banner = 33;
            $footer = 30;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 71;
            $multibanner_one = 47;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 8;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 24;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 14;
            $special_pro = 4;
            $instagram = 12;
            $whychooseus = 1;
            $product_section_order = '[{"id":7,"name":"Info Boxes","order":1,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":1,"name":"Banner Section","order":2,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":3,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":19,"name":"Customer Review","order":4,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":15,"name":"Banner Section","order":5,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":6,"file_name":"trend_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":22,"name":"Instagram Section","order":7,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":14,"name":"Brand Section","order":8,"file_name":"brand_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":11,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":6,"name":"Blog Section","order":12,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":13,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":14,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":15,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":16,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":16,"name":"Banner Section three","order":17,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '32'){

            $topoffer = 0;
            $style = 1;
            
            $web_card_style = 42;
            $subscribe_modal = 3;
            $font='manrope';
            $web_color_style='app.theme.32';
            $color_code = '#fdda05';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 32;
            $top_offer = 1;
            $header = 37;
            $carousel = 24;
            $brand = 9;
            $info_box = 14;
            $flash = 1;
            $banner = 49;
            $footer = 31;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 50;
            $multibanner_one = 72;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 9;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 14;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 6;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":14,"name":"Brand Section","order":2,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":3,"name":"Special Products Section","order":3,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":15,"name":"Banner Section","order":4,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":5,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":16,"name":"Banner Section three","order":6,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":6,"name":"Blog Section","order":7,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":7,"name":"Info Boxes","order":8,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":11,"name":"Tab Products View","order":9,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":10,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":11,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":18,"name":"Subscribe","order":12,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":13,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":23,"name":"Blog Section","order":14,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":19,"name":"Customer Review","order":16,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

       


        else if($id == '33'){

            $topoffer = 0;
            $style = 1;
            
            $web_card_style = 43;
            $subscribe_modal = 3;
            $font='jost';
            $web_color_style='app.theme.33';
            $color_code = '#f05970';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 33;
            $top_offer = 1;
            $header = 38;
            $carousel = 19;
            $brand = 14;
            $info_box = 15;
            $flash = 1;
            $banner = 45;
            $footer = 32;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 6;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 47;
            $multibanner_one = 46;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 3;
            $customer_review = 4;
            $tab_section = 2;
            $top_sell = 4;
            $recent_arrival = 9;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":14,"name":"Brand Section","order":1,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":9,"name":"Top Selling","order":2,"file_name":"top","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":1,"name":"Banner Section","order":3,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":8,"name":"Newest Product Section","order":4,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":15,"name":"Banner Section","order":5,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":16,"name":"Banner Section three","order":6,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":22,"name":"Instagram Section","order":7,"file_name":"instagram","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":7,"name":"Info Boxes","order":8,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":19,"name":"Customer Review","order":9,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":6,"name":"Blog Section","order":12,"file_name":"blog_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":18,"name":"Subscribe","order":13,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":5,"name":"Categories","order":14,"file_name":"categories","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":3,"name":"Special Products Section","order":15,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":23,"name":"Blog Section","order":16,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":21,"name":"Trend Product Section","order":17,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":20,"name":"New Deal","order":18,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":19,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":23,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '34'){

            $topoffer = 0;
            $style = 1;
            
            $web_card_style = 44;
            $subscribe_modal = 3;
            $font='open-sanserif';
            $web_color_style='app.theme.34';
            $color_code = '#ffcc02';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 34;
            $top_offer = 1;
            $header = 39;
            $carousel = 18;
            $brand = 10;
            $info_box = 21;
            $flash = 1;
            $banner = 42;
            $footer = 33;
            $cart = 4;
            $news = 2;
            $detail = 8;
            $shop = 6;
            $contact = 1;
            $login = 4;
            $transitions = 6;
            $banner_two = 1;
            $category = 5;
            $multibanner = 47;
            $multibanner_one = 46;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 20;
            $blog = 7;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 3;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":7,"name":"Info Boxes","order":1,"file_name":"info_box_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":5,"name":"Categories","order":2,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":14,"name":"Brand Section","order":3,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":1,"name":"Banner Section","order":4,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":3,"name":"Special Products Section","order":5,"file_name":"special","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":6,"file_name":"newest_product","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":7,"file_name":"whychooseus_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":8,"file_name":"customer_review","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":6,"name":"Blog Section","order":9,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":11,"name":"Tab Products View","order":10,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":11,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":12,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":18,"name":"Subscribe","order":13,"file_name":"subscribe","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":15,"name":"Banner Section","order":14,"file_name":"multibanner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":21,"name":"Trend Product Section","order":15,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":16,"name":"Banner Section three","order":16,"file_name":"multibanner_section_one","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":20,"name":"New Deal","order":17,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":13,"name":"Category","order":18,"file_name":"Category_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":10,"name":"Second Ad Section","order":19,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":20,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":21,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":17,"name":"Banner Section four","order":22,"file_name":"multibanner_section_two","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 

        else if($id == '35'){

            $topoffer = 1;
            $style = 5;
            
            $web_card_style = 45;
            $subscribe_modal = 2;
            $font='centurygothic';
            $web_color_style='app.theme.9';
            $color_code = '#ff4c3b';
            $background_type='1';
            $background_color='#FFFFFF';
            $background_image='https://platinum-24bucket.s3.ap-southeast-1.amazonaws.com/Grocery/2022/11/MvGpL18512.jpg';

            $template = 35;
            $top_offer = 1;
            $header = 40;
            $carousel = 21;
            $brand = 11;
            $info_box = 21;
            $flash = 1;
            $banner = 36;
            $footer = 34;
            $cart = 3;
            $news = 3;
            $detail = 9;
            $shop = 6;
            $contact = 1;
            $login = 3;
            $transitions = 6;
            $banner_two = 1;
            $category = 3;
            $multibanner = 37;
            $multibanner_one = 37;
            $multibanner_two = 38;
            $productcategory = 2;
            $subscribe = 1;
            $blog = 2;
            $customer_review = 3;
            $tab_section = 2;
            $top_sell = 2;
            $recent_arrival = 6;
            $checkout = 2;
            $new_deal = 2;
            $trend_pro = 13;
            $special_pro = 4;
            $instagram = 4;
            $whychooseus = 1;
            $product_section_order = '[{"id":1,"name":"Banner Section","order":1,"file_name":"banner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","alt":"Banner Section"},{"id":5,"name":"Categories","order":2,"file_name":"categories","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Categories"},{"id":15,"name":"Banner Section","order":3,"file_name":"multibanner_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section"},{"id":14,"name":"Brand Section","order":4,"file_name":"brand_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/brand1.png","alt":"Brand Section"},{"id":13,"name":"Category","order":5,"file_name":"Category_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/category_section-cross.jpg","alt":"Category 2 Section"},{"id":18,"name":"Subscribe","order":6,"file_name":"subscribe","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/subscribe.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":16,"name":"Banner Section three","order":7,"file_name":"multibanner_section_one","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Three"},{"id":6,"name":"Blog Section","order":8,"file_name":"blog_section","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Blog Section"},{"id":17,"name":"Banner Section four","order":9,"file_name":"multibanner_section_two","status":1,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner_section.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/banner1-cross.jpg","alt":"Banner Section Four"},{"id":7,"name":"Info Boxes","order":10,"file_name":"info_box_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_box1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/info_boxes-cross.jpg","alt":"Info Boxes"},{"id":3,"name":"Special Products Section","order":11,"file_name":"special","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/special_product-cross.jpg","alt":"Special Products Section"},{"id":8,"name":"Newest Product Section","order":12,"file_name":"newest_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/newest_product-cross.jpg","alt":"Newest Product Section"},{"id":23,"name":"Blog Section","order":13,"file_name":"whychooseus_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/whychooseus1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/blog_section-cross.jpg","alt":"Whychooseus Section"},{"id":19,"name":"Customer Review","order":14,"file_name":"customer_review","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/customer_review1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/categories-cross.jpg","alt":"Subscribe"},{"id":11,"name":"Tab Products View","order":15,"file_name":"tab","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/tab-cross.jpg","alt":"Tab Products View"},{"id":2,"name":"Flash Sale Section","order":16,"file_name":"flash_sale_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/flash_sale_section-cross.jpg","alt":"Flash Sale Section"},{"id":9,"name":"Top Selling","order":17,"file_name":"top","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/top-cross.jpg","alt":"Top Selling"},{"id":21,"name":"Trend Product Section","order":18,"file_name":"trend_product","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/trend1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Trend Product"},{"id":20,"name":"New Deal","order":19,"file_name":"new_deal","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/new_deal1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"New Deal"},{"id":10,"name":"Second Ad Section","order":20,"file_name":"sec_ad_banner","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Second Ad Section"},{"id":4,"name":"Ad Section","order":21,"file_name":"ad_banner_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/ad_banner_section-cross.jpg","alt":"Ad Section"},{"id":12,"name":"Banner 2 Section","order":22,"file_name":"banner_two_section","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Banner 2 Section"},{"id":22,"name":"Instagram Section","order":23,"file_name":"instagram","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/instagram1.png","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"Instagram"},{"id":24,"name":"HTML Template 1","order":24,"file_name":"htmltemplate1","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate1"},{"id":25,"name":"HTML Template 2","order":25,"file_name":"htmltemplate2","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate2"},{"id":26,"name":"HTML Template 3","order":26,"file_name":"htmltemplate3","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate3"},{"id":27,"name":"HTML Template 4","order":27,"file_name":"htmltemplate4","status":0,"image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section.jpg","disabled_image":"https:\/\/platinum-24bucket.s3.ap-southeast-1.amazonaws.com\/common\/images\/prototypes\/sec_ad_section-cross.jpg","alt":"htmltemplate4"}]';

        } 










        if($id != '0'){





        DB::table('current_theme')->where('id', '=', '1')->update([
            'template' => $template,
            'top_offer' => $top_offer,
            'header' => $header,
            'carousel' => $carousel,
            'brand' => $brand,
            'info_box' => $info_box,
            'flash' => $flash,
            'banner' => $banner,
            'footer' => $footer,
            'cart' => $cart,
            'news' => $news,
            'shop' => $shop,
            'contact' => $contact,
            'login' => $login,
            'detail' => $detail,
            'transitions' => $transitions,
            'banner_two' => $banner_two,
            'category' => $category,
            'multibanner' => $multibanner,
            'multibanner_one' => $multibanner_one,
            'multibanner_two' => $multibanner_two,
            'productcategory' => $productcategory,
            'subscribe' => $subscribe,
            'blog' => $blog,
            'customer_review' => $customer_review,
            'tab_section' => $tab_section,
            'top_sell' => $top_sell,
            'recent_arrival' => $recent_arrival,
            'checkout' => $checkout,
            'new_deal' => $new_deal,
            'trend_pro' => $trend_pro,
            'special_pro' => $special_pro,
            'instagram' => $instagram,
            'whychooseus' => $whychooseus,
            'product_section_order' => $product_section_order,
        ]);

        DB::table('front_end_theme_content')->where('id', '=', '1')->update([
            'product_section_order' => $product_section_order,
        ]);

        DB::table('top_offers')->update([
            'style' => $style,
            'topoffer_status' => $topoffer,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);


        DB::table('settings')->where('name', '=', 'topoffer')->update([
            'value' => $topoffer,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('settings')->where('name', '=', 'web_color_code')->update([
            'value' => $color_code,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);




        DB::table('settings')->where('name', '=', 'web_card_style')->update(['value' => $web_card_style]); 
        DB::table('settings')->where('name', '=', 'web_color_style')->update(['value' => $web_color_style]); 
        DB::table('settings')->where('name', '=', 'font')->update(['value' => $font]); 
        DB::table('settings')->where('name', '=', 'background_type')->update(['value' => $background_type]); 
        DB::table('settings')->where('name', '=', 'background_color')->update(['value' => $background_color]); 
        DB::table('settings')->where('name', '=', 'background_image')->update(['value' => $background_image]); 
        DB::table('settings')->where('name', '=', 'subscribe_modal')->update(['value' => $subscribe_modal]);
   


        return redirect()->back()->withErrors([$message]);
    }
   
    else
    {
        $template = 0;
        DB::table('current_theme')->where('id', '=', '1')->update([
            'template' => $template,
        ]);
        return redirect()->back()->withErrors([$message]);
    }

}
   

}
