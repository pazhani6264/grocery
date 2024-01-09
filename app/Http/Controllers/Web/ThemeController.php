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
use Illuminate\Http\Request;


class ThemeController extends Controller
{

    public function theme()
    {
        $index = new Index();
        $data = $index->finalTheme();

        

        $header_id = $data->header;
        $carousel_id = $data->carousel;
        $brand_id = $data->brand;
        $info_boxes_id = $data->info_box;
        $instagrams_id = $data->instagram;
        $special_pros_id = $data->special_pro;
        $trend_pros_id = $data->trend_pro;
        $new_deals_id = $data->new_deal;
        $tab_sections_id = $data->tab_section;
        $top_sells_id = $data->top_sell;
        $recent_arrivals_id = $data->recent_arrival;
        $categories_id = $data->category;
        $productcategories_id = $data->productcategory;
        $flash_id = $data->flash;
        $blog_news = $data->news;
        $subscribe_id = $data->subscribe;
        $blog_id = $data->blog;
        $whychooseus_id = $data->whychooseus;
        $customer_review_id = $data->customer_review;
        $banner_id = $data->banner;
        $multibanner_id = $data->multibanner;
        $multibanner_one_id = $data->multibanner_one;
        $multibanner_two_id = $data->multibanner_two;
        $footer_id = $data->footer;
        $cart = $data->cart;
        
        $detail = $data->detail;
        $shop = $data->shop;
        $contact = $data->contact;
        $login = $data->login;
        $transitions = $data->transitions;
        $product_section_order = $data->product_section_order;

        
        $json = json_decode($product_section_order, true);
        /* print_r($json);die(); */
        $banner = '';
        $brand = '';
        $tab_sections = '';
        $new_deals = '';
        $flashes = '';
        $top_sells = '';
        $special_pros = '';
        $recent_arrivals = '';
        $categories = '';
        $whychooseuss = '';
        $trend_pros = '';
        $multibanner_one = '';
        $multibanner = '';
        $productcategories = '';
        $instagrams = '';
        $subscribes = '';
        $customer_reviews = '';
        $blogs = '';
        $multibanner_two = '';
        $info_boxes = '';


        foreach ($json as $key => $var) {
          
            if ($var['id'] == 1) {
                if ($var['status'] == 1) {
                    $banner = $this->setBanner($banner_id);
                }
            }
            if ($var['id'] == 2) {
                if ($var['status'] == 1) {
                    $flashes = $this->setFlash($flash_id);
                }
            }
            if ($var['id'] == 3) {
                if ($var['status'] == 1) {
                    $special_pros = $this->setSpecialProducts($special_pros_id);
                }
            }
            if ($var['id'] == 5) {
                if ($var['status'] == 1) {
                    $categories = $this->setCategories($categories_id);
                }
            }
            if ($var['id'] == 6) {
                if ($var['status'] == 1) {
                    $blogs = $this->setBlog($blog_id);
                }
            }
            if ($var['id'] == 7) {
                if ($var['status'] == 1) {
                    $info_boxes = $this->setInfoBoxes($info_boxes_id);
                }
            }
            if ($var['id'] == 8) {
                if ($var['status'] == 1) {
                    $recent_arrivals = $this->setRecentArrival($recent_arrivals_id);
                }
            }
            if ($var['id'] == 9) {
                if ($var['status'] == 1) {
                    $top_sells = $this->setTopSelling($top_sells_id);
                }
            }
            if ($var['id'] == 11) {
                if ($var['status'] == 1) {
                    $tab_sections = $this->setTabSections($tab_sections_id);
                }
            }
            if ($var['id'] == 13) {
                if ($var['status'] == 1) {
                    $productcategories = $this->setProductCategories($productcategories_id);
                }
            }
            if ($var['id'] == 14) {
                if ($var['status'] == 1) {
                    $brand = $this->setBrand($brand_id);
                }
            }
            if ($var['id'] == 15) {
                if ($var['status'] == 1) {
                    $multibanner = $this->setMultibanner($multibanner_id);
                }
            }
            if ($var['id'] == 16) {
                if ($var['status'] == 1) {
                    $multibanner_one = $this->setMultibanner_one($multibanner_one_id);
                }
            }
            if ($var['id'] == 17) {
                if ($var['status'] == 1) {
                    $multibanner_two = $this->setMultibanner_two($multibanner_two_id);
                }
            }
            if ($var['id'] == 18) {
                if ($var['status'] == 1) {
                    $subscribes = $this->setSubscribe($subscribe_id);
                }
            }
            if ($var['id'] == 19) {
                if ($var['status'] == 1) {
                    $customer_reviews = $this->setCustomerReview($customer_review_id);
                }
            }
            if ($var['id'] == 20) {
                if ($var['status'] == 1) {
                    $new_deals = $this->setNewDeals($new_deals_id);
                }
            }
            if ($var['id'] == 21) {
                if ($var['status'] == 1) {
                    $trend_pros = $this->setTrendPro($trend_pros_id);
                }
            }
            if ($var['id'] == 22) {
                if ($var['status'] == 1) {
                    $instagrams = $this->setInstagrams($instagrams_id);
                }
            }
            if ($var['id'] == 23) {
                if ($var['status'] == 1) {
                    $whychooseuss = $this->setWhychooseus($whychooseus_id);
                }
            }
        }
       
        $top_offer = $this->setTopOffer();
        $header = $this->setHeader($header_id);
        $mobileheader = $this->mobileHeader($header_id);
        $carousel = $this->setCarousal($carousel_id);
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
            'instagram' => $instagrams,
            'special_pro' => $special_pros,
            'trend_pro' => $trend_pros,
            'new_deal' => $new_deals,
            'tab_section' => $tab_sections,
            'top_sell' => $top_sells,
            'recent_arrival' => $recent_arrivals,
            'category' => $categories,
            'productcategory' => $productcategories,
            'flash' => $flashes,
            'subscribe' => $subscribes,
            'blog' => $blogs,
            'whychooseus' => $whychooseuss,
            'customer_review' => $customer_reviews,
            'blog_news' => $blog_news,
            'banner' => $banner,
            'multibanner' => $multibanner,
            'multibanner_one' => $multibanner_one,
            'multibanner_two' => $multibanner_two,
            'footer' => $footer,
            'mobile_footer' => $mobilefooter,
            'cart' => $cart,
            
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

        switch ($header_id) {
            case "1":
                $header = (string) View::make('web.headers.headerOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
              break;
            case "2":
                $header = (string) View::make('web.headers.headerTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "3":
                $header = (string) View::make('web.headers.headerThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "4":
                $header = (string) View::make('web.headers.headerFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "5":
                $header = (string) View::make('web.headers.headerFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "6":
                $header = (string) View::make('web.headers.headerSix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "7":
                $header = (string) View::make('web.headers.headerSeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "8":
                $header = (string) View::make('web.headers.headerEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "9":
                $header = (string) View::make('web.headers.headerNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "10":
                $header = (string) View::make('web.headers.headerTen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "11":
                $header = (string) View::make('web.headers.headerEleven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "12":
                $header = (string) View::make('web.headers.headerTwele', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "13":
                $header = (string) View::make('web.headers.headerThirteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "14":
                $header = (string) View::make('web.headers.headerFourteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "15":
                $header = (string) View::make('web.headers.headerFifteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "16":
                $header = (string) View::make('web.headers.headerSixteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "17":
                $header = (string) View::make('web.headers.headerSeventeen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "18":
                $header = (string) View::make('web.headers.headerEighteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "19":
                $header = (string) View::make('web.headers.headerNinteen', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "20":
                $header = (string) View::make('web.headers.headerTwenty', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "21":
                $header = (string) View::make('web.headers.headerTwentyOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "22":
                $header = (string) View::make('web.headers.headerTwentyTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "23":
                $header = (string) View::make('web.headers.headerTwentyThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "24":
                $header = (string) View::make('web.headers.headerTwentyFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "25":
                $header = (string) View::make('web.headers.headerTwentyFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "26":
                $header = (string) View::make('web.headers.headerTwentySix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "27":
                $header = (string) View::make('web.headers.headerTwentySeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "28":
                $header = (string) View::make('web.headers.headerTwentyEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "29":
                $header = (string) View::make('web.headers.headerTwentyNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "30":
                $header = (string) View::make('web.headers.headerThirty', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "31":
                $header = (string) View::make('web.headers.headerThirtyOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "32":
                $header = (string) View::make('web.headers.headerThirtyTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;

            case "33":
                $header = (string) View::make('web.headers.headerThirtyThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "34":
                $header = (string) View::make('web.headers.headerThirtyFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "35":
                $header = (string) View::make('web.headers.headerThirtyFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "36":
                $header = (string) View::make('web.headers.headerThirtySix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "37":
                $header = (string) View::make('web.headers.headerThirtySeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "38":
                $header = (string) View::make('web.headers.headerThirtyEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "39":
                $header = (string) View::make('web.headers.headerThirtyNine', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "40":
                $header = (string) View::make('web.headers.headerforty', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "41":
                $header = (string) View::make('web.headers.headerFourtyOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "42":
                $header = (string) View::make('web.headers.headerFourtyTwo', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "43":
                $header = (string) View::make('web.headers.headerFourtyThree', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "44":
                $header = (string) View::make('web.headers.headerFourtyFour', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "45":
                $header = (string) View::make('web.headers.headerFourtyFive', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "46":
                $header = (string) View::make('web.headers.headerFourtySix', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "47":
                $header = (string) View::make('web.headers.headerFourtySeven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "48":
                $header = (string) View::make('web.headers.headerFourtyEight', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;

            default:
            $header = (string) View::make('web.headers.headerEleven', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
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
        switch ($header_id) {
            case "1":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
              break;
            case "2":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "3":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "4":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "5":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "6":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "7":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "8":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "9":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "10":
                $header = (string) View::make('web.headers.mobile', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "11":
                $header = (string) View::make('web.headers.mobile11', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "12":
                $header = (string) View::make('web.headers.mobile12', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "13":
                $header = (string) View::make('web.headers.mobile13', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "14":
                $header = (string) View::make('web.headers.mobile14', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "15":
                $header = (string) View::make('web.headers.mobile15', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "16":
                $header = (string) View::make('web.headers.mobile16', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "17":
                $header = (string) View::make('web.headers.mobile17', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "18":
                $header = (string) View::make('web.headers.mobile18', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "19":
                $header = (string) View::make('web.headers.mobile19', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "20":
                $header = (string) View::make('web.headers.mobile20', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "21":
                $header = (string) View::make('web.headers.mobile21', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "22":
                $header = (string) View::make('web.headers.mobile22', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "23":
                $header = (string) View::make('web.headers.mobile23', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "24":
                $header = (string) View::make('web.headers.mobile24', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "25":
                $header = (string) View::make('web.headers.mobile25', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "26":
                $header = (string) View::make('web.headers.mobile26', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "27":
                $header = (string) View::make('web.headers.mobile27', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "28":
                $header = (string) View::make('web.headers.mobile28', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "29":
                $header = (string) View::make('web.headers.mobile29', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "30":
                $header = (string) View::make('web.headers.mobile30', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "31":
                $header = (string) View::make('web.headers.mobile31', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "32":
                $header = (string) View::make('web.headers.mobile32', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;

            case "33":
                $header = (string) View::make('web.headers.mobile33', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "34":
                $header = (string) View::make('web.headers.mobile34', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "35":
                $header = (string) View::make('web.headers.mobile35', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "36":
                $header = (string) View::make('web.headers.mobile36', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "37":
                $header = (string) View::make('web.headers.mobile37', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "38":
                $header = (string) View::make('web.headers.mobile38', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "39":
                $header = (string) View::make('web.headers.mobile39', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "40":
                $header = (string) View::make('web.headers.mobile40', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "41":
                $header = (string) View::make('web.headers.mobile41', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "42":
                $header = (string) View::make('web.headers.mobile42', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "43":
                $header = (string) View::make('web.headers.mobile43', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "44":
                $header = (string) View::make('web.headers.mobile44', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "45":
                $header = (string) View::make('web.headers.mobile45', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "46":
                $header = (string) View::make('web.headers.mobile46', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "47":
                $header = (string) View::make('web.headers.mobile47', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
            case "48":
                $header = (string) View::make('web.headers.mobile48', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
            break;
          

            default:
            $header = (string) View::make('web.headers.mobile11', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
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
        if ($carousel_id != 6 && $carousel_id != 7 && $carousel_id != 8 && $carousel_id != 9 && $carousel_id != 10 && $carousel_id != 11 && $carousel_id != 12 && $carousel_id != 13 && $carousel_id != 14 && $carousel_id != 15 && $carousel_id != 17  && $carousel_id != 19 && $carousel_id != 20 && $carousel_id != 21 && $carousel_id != 22 && $carousel_id != 23 && $carousel_id != 24  && $carousel_id != 25 && $carousel_id != 26  && $carousel_id != 27  && $carousel_id != 28 && $carousel_id != 30 && $carousel_id != 31 && $carousel_id != 32 && $carousel_id != 33 && $carousel_id != 34 && $carousel_id != 35 && $carousel_id != 36 && $carousel_id != 37 && $carousel_id != 38) {
            if ($carousel_id == 24) {
                $carousels_id = 19;
            }
            else
            {
                $carousels_id = $carousel_id;
            }
        $slides = $index->slidesByCarousel1($currentDate, $carousels_id);
        }
        else
        {
            if ($carousel_id == 24) {
                $carousels_id = 19;
            }
            else
            {
                $carousels_id = $carousel_id;
            }

           
            $slides = $index->slidesByCarousel($currentDate, $carousels_id); 
        }
        $cates = $products->productCategories1();
        $cates_car = $products->productCategories_car();
        $result['cat'] = $cates_car;

        $cates_old = $products->productCategories_old();
        $result['cat_old'] = $cates_old;

        $result['slides'] = $slides;

        switch ($carousel_id) {
            case "1":
                $carousel = (string) View::make('web.carousels.boot-carousel-content-full-screen', ['result' => $result])->render();
              break;
            case "2":
                $carousel = (string) View::make('web.carousels.boot-carousel-content-full-width', ['result' => $result])->render();
            break;
            case "3":
                $carousel = (string) View::make('web.carousels.boot-carousel-content-with-left-banner', ['result' => $result])->render();
            break;
            case "4":
                $carousel = (string) View::make('web.carousels.boot-carousel-content-with-navigation', ['result' => $result])->render();
            break;
            case "5":
                $carousel = (string) View::make('web.carousels.boot-carousel-content-with-right-banner', ['result' => $result])->render();
            break;
            case "6":
                $carousel = (string) View::make('web.carousels.carousal6', ['result' => $result])->render();
            break;
            case "7":
                $carousel = (string) View::make('web.carousels.carousal7', ['result' => $result])->render();
            break;
            case "8":
                $carousel = (string) View::make('web.carousels.carousal8', ['result' => $result])->render();
            break;
            case "9":
                $carousel = (string) View::make('web.carousels.carousal9', ['result' => $result])->render();
            break;
            case "10":
                $carousel = (string) View::make('web.carousels.carousal10', ['result' => $result])->render();
            break;
            case "11":
                $carousel = (string) View::make('web.carousels.carousal11', ['result' => $result])->render();
            break;
            case "12":
                $carousel = (string) View::make('web.carousels.carousal12', ['result' => $result])->render();
            break;
            case "13":
                $carousel = (string) View::make('web.carousels.carousal13', ['result' => $result])->render();
            break;
            case "14":
                $carousel = (string) View::make('web.carousels.carousal14', ['result' => $result])->render();
            break;
            case "15":
                $carousel = (string) View::make('web.carousels.carousal15', ['result' => $result])->render();
            break;
            case "16":
                $carousel = (string) View::make('web.carousels.carousal16', ['result' => $result])->render();
            break;
            case "17":
                $carousel = (string) View::make('web.carousels.carousal17', ['result' => $result])->render();
            break;
            case "18":
                $carousel = (string) View::make('web.carousels.carousal18', ['result' => $result])->render();
            break;
            case "19":
                $carousel = (string) View::make('web.carousels.carousal19', ['result' => $result])->render();
            break;
            case "20":
                $carousel = (string) View::make('web.carousels.carousal20', ['result' => $result])->render();
            break;
            case "21":
                $carousel = (string) View::make('web.carousels.carousal21', ['result' => $result])->render();
            break;
            case "22":
                $carousel = (string) View::make('web.carousels.carousal22', ['result' => $result])->render();
            break;
            case "23":
                $carousel = (string) View::make('web.carousels.carousal23', ['result' => $result])->render();
            break;
            case "24":
                $carousel = (string) View::make('web.carousels.carousal24', ['result' => $result])->render();
            break;
            case "25":
                $carousel = (string) View::make('web.carousels.carousal25', ['result' => $result])->render();
            break;
            case "26":
                $carousel = (string) View::make('web.carousels.carousal26', ['result' => $result])->render();
            break;
            case "27":
                $carousel = (string) View::make('web.carousels.carousal27', ['result' => $result])->render();
            break;
            case "28":
                $carousel = (string) View::make('web.carousels.carousal28', ['result' => $result])->render();
            break;
            case "29":
                $carousel = (string) View::make('web.carousels.carousal29', ['result' => $result])->render();
            break;
            case "30":
                $carousel = (string) View::make('web.carousels.carousal30', ['result' => $result])->render();
            break;
            case "31":
                $carousel = (string) View::make('web.carousels.carousal31', ['result' => $result])->render();
            break;
            case "32":
                $carousel = (string) View::make('web.carousels.carousal32', ['result' => $result])->render();
            break;
            case "33":
                $carousel = (string) View::make('web.carousels.carousal33', ['result' => $result])->render();
            break;
            case "35":
                $carousel = (string) View::make('web.carousels.carousal35', ['result' => $result])->render();
            break;
            case "36":
                $carousel = (string) View::make('web.carousels.carousal36', ['result' => $result])->render();
            break;
            case "37":
                $carousel = (string) View::make('web.carousels.carousal37', ['result' => $result])->render();
            break;
            case "38":
                $carousel = (string) View::make('web.carousels.carousal38', ['result' => $result])->render();
            break;
            case "39":
                $carousel = (string) View::make('web.carousels.carousal39', ['result' => $result])->render();
            break;

            default:
            $carousel = (string) View::make('web.carousels.carousal6', ['result' => $result])->render();
        }
        return $carousel;
    }




    private function setBrand($brand_id)
    {
       $result = $brand_id;

       switch ($brand_id) {
        case "1":
            $brand = (string) View::make('web.brand.brand1', ['result' => $result])->render();
          break;
        case "2":
            $brand = (string) View::make('web.brand.brand2', ['result' => $result])->render();
        break;
        case "3":
            $brand = (string) View::make('web.brand.brand3', ['result' => $result])->render();
        break;
        case "4":
            $brand = (string) View::make('web.brand.brand4', ['result' => $result])->render();
        break;
        case "5":
            $brand = (string) View::make('web.brand.brand5', ['result' => $result])->render();
        break;
        case "6":
            $brand = (string) View::make('web.brand.brand6', ['result' => $result])->render();
        break;
        case "7":
            $brand = (string) View::make('web.brand.brand7', ['result' => $result])->render();
        break;
        case "8":
            $brand = (string) View::make('web.brand.brand8', ['result' => $result])->render();
        break;
        case "9":
            $brand = (string) View::make('web.brand.brand9', ['result' => $result])->render();
        break;
        case "10":
            $brand = (string) View::make('web.brand.brand10', ['result' => $result])->render();
        break;
        case "11":
            $brand = (string) View::make('web.brand.brand11', ['result' => $result])->render();
        break;
        case "12":
            $brand = (string) View::make('web.brand.brand12', ['result' => $result])->render();
        break;
        case "13":
            $brand = (string) View::make('web.brand.brand13', ['result' => $result])->render();
        break;
        case "14":
            $brand = (string) View::make('web.brand.brand14', ['result' => $result])->render();
        break;
        case "15":
            $brand = (string) View::make('web.brand.brand15', ['result' => $result])->render();
        break;
        case "16":
            $brand = (string) View::make('web.brand.brand16', ['result' => $result])->render();
        break;
        case "17":
            $brand = (string) View::make('web.brand.brand17', ['result' => $result])->render();
        break;
        case "18":
            $brand = (string) View::make('web.brand.brand18', ['result' => $result])->render();
        break;
        case "19":
            $brand = (string) View::make('web.brand.brand19', ['result' => $result])->render();
        break;
        case "20":
            $brand = (string) View::make('web.brand.brand20', ['result' => $result])->render();
        break;
        case "21":
            $brand = (string) View::make('web.brand.brand21', ['result' => $result])->render();
        break;

        default:
        $brand = (string) View::make('web.brand.brand1', ['result' => $result])->render();
    }
       
        return $brand;
    }
    

    private function setBanner($banner_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->getbannersquery(1);

        switch ($banner_id) {
            case "1":
                $banner = (string) View::make('web.banners.banner1', ['result' => $result])->render();
              break;
            case "2":
                $banner = (string) View::make('web.banners.banner2', ['result' => $result])->render();
            break;
            case "3":
                $banner = (string) View::make('web.banners.banner3', ['result' => $result])->render();
            break;
            case "4":
                $banner = (string) View::make('web.banners.banner4', ['result' => $result])->render();
            break;
            case "5":
                $banner = (string) View::make('web.banners.banner5', ['result' => $result])->render();
            break;
            case "6":
                $banner = (string) View::make('web.banners.banner6', ['result' => $result])->render();
            break;
            case "7":
                $banner = (string) View::make('web.banners.banner7', ['result' => $result])->render();
            break;
            case "8":
                $banner = (string) View::make('web.banners.banner8', ['result' => $result])->render();
            break;
            case "9":
                $banner = (string) View::make('web.banners.banner9', ['result' => $result])->render();
            break;
            case "10":
                $banner = (string) View::make('web.banners.banner10', ['result' => $result])->render();
            break;
            case "11":
                $banner = (string) View::make('web.banners.banner11', ['result' => $result])->render();
            break;
            case "12":
                $banner = (string) View::make('web.banners.banner12', ['result' => $result])->render();
            break;
            case "13":
                $banner = (string) View::make('web.banners.banner13', ['result' => $result])->render();
            break;
            case "14":
                $banner = (string) View::make('web.banners.banner14', ['result' => $result])->render();
            break;
            case "15":
                $banner = (string) View::make('web.banners.banner15', ['result' => $result])->render();
            break;
            case "16":
                $banner = (string) View::make('web.banners.banner16', ['result' => $result])->render();
            break;
            case "17":
                $banner = (string) View::make('web.banners.banner17', ['result' => $result])->render();
            break;
            case "18":
                $banner = (string) View::make('web.banners.banner18', ['result' => $result])->render();
            break;
            case "19":
                $banner = (string) View::make('web.banners.banner19', ['result' => $result])->render();
            break;
            case "20":
                $banner = (string) View::make('web.banners.banner20', ['result' => $result])->render();
            break;
            case "21":
                $banner = (string) View::make('web.banners.banner21', ['result' => $result])->render();
            break;
            case "22":
                $banner = (string) View::make('web.banners.banner22', ['result' => $result])->render();
            break;
            case "23":
                $banner = (string) View::make('web.banners.banner23', ['result' => $result])->render();
            break;
            case "24":
                $banner = (string) View::make('web.banners.banner24', ['result' => $result])->render();
            break;
            case "25":
                $banner = (string) View::make('web.banners.banner25', ['result' => $result])->render();
            break;
            case "26":
                $banner = (string) View::make('web.banners.banner26', ['result' => $result])->render();
            break;
            case "27":
                $banner = (string) View::make('web.banners.banner27', ['result' => $result])->render();
            break;
            case "28":
                $banner = (string) View::make('web.banners.banner28', ['result' => $result])->render();
            break;
            case "29":
                $banner = (string) View::make('web.banners.banner29', ['result' => $result])->render();
            case "30":
                $banner = (string) View::make('web.banners.banner30', ['result' => $result])->render();
            break;
            case "31":
                $banner = (string) View::make('web.banners.banner31', ['result' => $result])->render();
            break;
            case "32":
                $banner = (string) View::make('web.banners.banner32', ['result' => $result])->render();
            break;

            case "33":
                $banner = (string) View::make('web.banners.banner33', ['result' => $result])->render();
            break;
            case "34":
                $banner = (string) View::make('web.banners.banner34', ['result' => $result])->render();
            break;
            case "35":
                $banner = (string) View::make('web.banners.banner35', ['result' => $result])->render();
            break;
            case "36":
                $banner = (string) View::make('web.banners.banner36', ['result' => $result])->render();
            break;
            case "37":
                $banner = (string) View::make('web.banners.banner37', ['result' => $result])->render();
            break;
            case "38":
                $banner = (string) View::make('web.banners.banner38', ['result' => $result])->render();
            break;
            case "39":
                $banner = (string) View::make('web.banners.banner39', ['result' => $result])->render();
            break;
            case "40":
                $banner = (string) View::make('web.banners.banner40', ['result' => $result])->render();
            break;
            case "41":
                $banner = (string) View::make('web.banners.banner41', ['result' => $result])->render();
            break;
            case "42":
                $banner = (string) View::make('web.banners.banner42', ['result' => $result])->render();
            break;
            case "43":
                $banner = (string) View::make('web.banners.banner43', ['result' => $result])->render();
            break;
            case "44":
                $banner = (string) View::make('web.banners.banner44', ['result' => $result])->render();
            break;
            case "45":
                $banner = (string) View::make('web.banners.banner45', ['result' => $result])->render();
            break;
            case "46":
                $banner = (string) View::make('web.banners.banner46', ['result' => $result])->render();
            break;
            case "47":
                $banner = (string) View::make('web.banners.banner47', ['result' => $result])->render();
            break;
            case "48":
                $banner = (string) View::make('web.banners.banner48', ['result' => $result])->render();
            break;
            case "49":
                $banner = (string) View::make('web.banners.banner49', ['result' => $result])->render();
            break;
            case "50":
                $banner = (string) View::make('web.banners.banner50', ['result' => $result])->render();
            break;
            case "51":
                $banner = (string) View::make('web.banners.banner51', ['result' => $result])->render();
            break;
            case "52":
                $banner = (string) View::make('web.banners.banner52', ['result' => $result])->render();
            break;
            case "53":
                $banner = (string) View::make('web.banners.banner53', ['result' => $result])->render();
            break;
            case "54":
                $banner = (string) View::make('web.banners.banner54', ['result' => $result])->render();
            break;
            case "55":
                $banner = (string) View::make('web.banners.banner55', ['result' => $result])->render();
            break;
            case "56":
                $banner = (string) View::make('web.banners.banner56', ['result' => $result])->render();
            break;
            case "57":
                $banner = (string) View::make('web.banners.banner57', ['result' => $result])->render();
            break;
            case "58":
                $banner = (string) View::make('web.banners.banner58', ['result' => $result])->render();
            break;
            case "59":
                $banner = (string) View::make('web.banners.banner59', ['result' => $result])->render();
            break;
            case "60":
                $banner = (string) View::make('web.banners.banner60', ['result' => $result])->render();
            break;
            case "61":
                $banner = (string) View::make('web.banners.banner61', ['result' => $result])->render();
            break;
            case "62":
                $banner = (string) View::make('web.banners.banner62', ['result' => $result])->render();
            break;
            case "63":
                $banner = (string) View::make('web.banners.banner63', ['result' => $result])->render();
            break;
            case "64":
                $banner = (string) View::make('web.banners.banner64', ['result' => $result])->render();
            break;
            case "65":
                $banner = (string) View::make('web.banners.banner65', ['result' => $result])->render();
            break;
            case "66":
                $banner = (string) View::make('web.banners.banner66', ['result' => $result])->render();
            break;
            case "67":
                $banner = (string) View::make('web.banners.banner67', ['result' => $result])->render();
            break;
            case "68":
                $banner = (string) View::make('web.banners.banner68', ['result' => $result])->render();
            break;
            case "69":
                $banner = (string) View::make('web.banners.banner69', ['result' => $result])->render();
            break;
            case "70":
                $banner = (string) View::make('web.banners.banner70', ['result' => $result])->render();
            break;
            case "71":
                $banner = (string) View::make('web.banners.banner71', ['result' => $result])->render();
            break;
            case "72":
                $banner = (string) View::make('web.banners.banner72', ['result' => $result])->render();
            break;
            case "73":
                $banner = (string) View::make('web.banners.banner73', ['result' => $result])->render();
            break;
          

            default:
            $banner = (string) View::make('web.banners.banner1', ['result' => $result])->render();
        }


        return $banner;
    }

    private function setMultibanner($banner_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->getbannersquery(2);

        switch ($banner_id) {
            case "1":
                $banner = (string) View::make('web.multibanners.banner1', ['result' => $result])->render();
              break;
            case "2":
                $banner = (string) View::make('web.multibanners.banner2', ['result' => $result])->render();
            break;
            case "3":
                $banner = (string) View::make('web.multibanners.banner3', ['result' => $result])->render();
            break;
            case "4":
                $banner = (string) View::make('web.multibanners.banner4', ['result' => $result])->render();
            break;
            case "5":
                $banner = (string) View::make('web.multibanners.banner5', ['result' => $result])->render();
            break;
            case "6":
                $banner = (string) View::make('web.multibanners.banner6', ['result' => $result])->render();
            break;
            case "7":
                $banner = (string) View::make('web.multibanners.banner7', ['result' => $result])->render();
            break;
            case "8":
                $banner = (string) View::make('web.multibanners.banner8', ['result' => $result])->render();
            break;
            case "9":
                $banner = (string) View::make('web.multibanners.banner9', ['result' => $result])->render();
            break;
            case "10":
                $banner = (string) View::make('web.multibanners.banner10', ['result' => $result])->render();
            break;
            case "11":
                $banner = (string) View::make('web.multibanners.banner11', ['result' => $result])->render();
            break;
            case "12":
                $banner = (string) View::make('web.multibanners.banner12', ['result' => $result])->render();
            break;
            case "13":
                $banner = (string) View::make('web.multibanners.banner13', ['result' => $result])->render();
            break;
            case "14":
                $banner = (string) View::make('web.multibanners.banner14', ['result' => $result])->render();
            break;
            case "15":
                $banner = (string) View::make('web.multibanners.banner15', ['result' => $result])->render();
            break;
            case "16":
                $banner = (string) View::make('web.multibanners.banner16', ['result' => $result])->render();
            break;
            case "17":
                $banner = (string) View::make('web.multibanners.banner17', ['result' => $result])->render();
            break;
            case "18":
                $banner = (string) View::make('web.multibanners.banner18', ['result' => $result])->render();
            break;
            case "19":
                $banner = (string) View::make('web.multibanners.banner19', ['result' => $result])->render();
            break;
            case "20":
                $banner = (string) View::make('web.multibanners.banner20', ['result' => $result])->render();
            break;
            case "21":
                $banner = (string) View::make('web.multibanners.banner21', ['result' => $result])->render();
            break;
            case "22":
                $banner = (string) View::make('web.multibanners.banner22', ['result' => $result])->render();
            break;
            case "23":
                $banner = (string) View::make('web.multibanners.banner23', ['result' => $result])->render();
            break;
            case "24":
                $banner = (string) View::make('web.multibanners.banner24', ['result' => $result])->render();
            break;
            case "25":
                $banner = (string) View::make('web.multibanners.banner25', ['result' => $result])->render();
            break;
            case "26":
                $banner = (string) View::make('web.multibanners.banner26', ['result' => $result])->render();
            break;
            case "27":
                $banner = (string) View::make('web.multibanners.banner27', ['result' => $result])->render();
            break;
            case "28":
                $banner = (string) View::make('web.multibanners.banner28', ['result' => $result])->render();
            break;
            case "29":
                $banner = (string) View::make('web.multibanners.banner29', ['result' => $result])->render();
            case "30":
                $banner = (string) View::make('web.multibanners.banner30', ['result' => $result])->render();
            break;
            case "31":
                $banner = (string) View::make('web.multibanners.banner31', ['result' => $result])->render();
            break;
            case "32":
                $banner = (string) View::make('web.multibanners.banner32', ['result' => $result])->render();
            break;

            case "33":
                $banner = (string) View::make('web.multibanners.banner33', ['result' => $result])->render();
            break;
            case "34":
                $banner = (string) View::make('web.multibanners.banner34', ['result' => $result])->render();
            break;
            case "35":
                $banner = (string) View::make('web.multibanners.banner35', ['result' => $result])->render();
            break;
            case "36":
                $banner = (string) View::make('web.multibanners.banner36', ['result' => $result])->render();
            break;
            case "37":
                $banner = (string) View::make('web.multibanners.banner37', ['result' => $result])->render();
            break;
            case "38":
                $banner = (string) View::make('web.multibanners.banner38', ['result' => $result])->render();
            break;
            case "39":
                $banner = (string) View::make('web.multibanners.banner39', ['result' => $result])->render();
            break;
            case "40":
                $banner = (string) View::make('web.multibanners.banner40', ['result' => $result])->render();
            break;
            case "41":
                $banner = (string) View::make('web.multibanners.banner41', ['result' => $result])->render();
            break;
            case "42":
                $banner = (string) View::make('web.multibanners.banner42', ['result' => $result])->render();
            break;
            case "43":
                $banner = (string) View::make('web.multibanners.banner43', ['result' => $result])->render();
            break;
            case "44":
                $banner = (string) View::make('web.multibanners.banner44', ['result' => $result])->render();
            break;
            case "45":
                $banner = (string) View::make('web.multibanners.banner45', ['result' => $result])->render();
            break;
            case "46":
                $banner = (string) View::make('web.multibanners.banner46', ['result' => $result])->render();
            break;
            case "47":
                $banner = (string) View::make('web.multibanners.banner47', ['result' => $result])->render();
            break;
            case "48":
                $banner = (string) View::make('web.multibanners.banner48', ['result' => $result])->render();
            break;
            case "49":
                $banner = (string) View::make('web.multibanners.banner49', ['result' => $result])->render();
            break;
            case "50":
                $banner = (string) View::make('web.multibanners.banner50', ['result' => $result])->render();
            break;
            case "51":
                $banner = (string) View::make('web.multibanners.banner51', ['result' => $result])->render();
            break;
            case "52":
                $banner = (string) View::make('web.multibanners.banner52', ['result' => $result])->render();
            break;
            case "53":
                $banner = (string) View::make('web.multibanners.banner53', ['result' => $result])->render();
            break;
            case "54":
                $banner = (string) View::make('web.multibanners.banner54', ['result' => $result])->render();
            break;
            case "55":
                $banner = (string) View::make('web.multibanners.banner55', ['result' => $result])->render();
            break;
            case "56":
                $banner = (string) View::make('web.multibanners.banner56', ['result' => $result])->render();
            break;
            case "57":
                $banner = (string) View::make('web.multibanners.banner57', ['result' => $result])->render();
            break;
            case "58":
                $banner = (string) View::make('web.multibanners.banner58', ['result' => $result])->render();
            break;
            case "59":
                $banner = (string) View::make('web.multibanners.banner59', ['result' => $result])->render();
            break;
            case "60":
                $banner = (string) View::make('web.multibanners.banner60', ['result' => $result])->render();
            break;
            case "61":
                $banner = (string) View::make('web.multibanners.banner61', ['result' => $result])->render();
            break;
            case "62":
                $banner = (string) View::make('web.multibanners.banner62', ['result' => $result])->render();
            break;
            case "63":
                $banner = (string) View::make('web.multibanners.banner63', ['result' => $result])->render();
            break;
            case "64":
                $banner = (string) View::make('web.multibanners.banner64', ['result' => $result])->render();
            break;
            case "65":
                $banner = (string) View::make('web.multibanners.banner65', ['result' => $result])->render();
            break;
            case "66":
                $banner = (string) View::make('web.multibanners.banner66', ['result' => $result])->render();
            break;
            case "67":
                $banner = (string) View::make('web.multibanners.banner67', ['result' => $result])->render();
            break;
            case "68":
                $banner = (string) View::make('web.multibanners.banner68', ['result' => $result])->render();
            break;
            case "69":
                $banner = (string) View::make('web.multibanners.banner69', ['result' => $result])->render();
            break;
            case "70":
                $banner = (string) View::make('web.multibanners.banner70', ['result' => $result])->render();
            break;
            case "71":
                $banner = (string) View::make('web.multibanners.banner71', ['result' => $result])->render();
            break;
            case "72":
                $banner = (string) View::make('web.multibanners.banner72', ['result' => $result])->render();
            break;
            case "73":
                $banner = (string) View::make('web.multibanners.banner73', ['result' => $result])->render();
            break;


            default:
            $banner = (string) View::make('web.multibanners.banner1', ['result' => $result])->render();
        }

        return $banner;
    }


    private function setMultibanner_one($banner_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->getbannersquery(3);

        switch ($banner_id) {
            case "1":
                $banner = (string) View::make('web.multibannersone.banner1', ['result' => $result])->render();
              break;
            case "2":
                $banner = (string) View::make('web.multibannersone.banner2', ['result' => $result])->render();
            break;
            case "3":
                $banner = (string) View::make('web.multibannersone.banner3', ['result' => $result])->render();
            break;
            case "4":
                $banner = (string) View::make('web.multibannersone.banner4', ['result' => $result])->render();
            break;
            case "5":
                $banner = (string) View::make('web.multibannersone.banner5', ['result' => $result])->render();
            break;
            case "6":
                $banner = (string) View::make('web.multibannersone.banner6', ['result' => $result])->render();
            break;
            case "7":
                $banner = (string) View::make('web.multibannersone.banner7', ['result' => $result])->render();
            break;
            case "8":
                $banner = (string) View::make('web.multibannersone.banner8', ['result' => $result])->render();
            break;
            case "9":
                $banner = (string) View::make('web.multibannersone.banner9', ['result' => $result])->render();
            break;
            case "10":
                $banner = (string) View::make('web.multibannersone.banner10', ['result' => $result])->render();
            break;
            case "11":
                $banner = (string) View::make('web.multibannersone.banner11', ['result' => $result])->render();
            break;
            case "12":
                $banner = (string) View::make('web.multibannersone.banner12', ['result' => $result])->render();
            break;
            case "13":
                $banner = (string) View::make('web.multibannersone.banner13', ['result' => $result])->render();
            break;
            case "14":
                $banner = (string) View::make('web.multibannersone.banner14', ['result' => $result])->render();
            break;
            case "15":
                $banner = (string) View::make('web.multibannersone.banner15', ['result' => $result])->render();
            break;
            case "16":
                $banner = (string) View::make('web.multibannersone.banner16', ['result' => $result])->render();
            break;
            case "17":
                $banner = (string) View::make('web.multibannersone.banner17', ['result' => $result])->render();
            break;
            case "18":
                $banner = (string) View::make('web.multibannersone.banner18', ['result' => $result])->render();
            break;
            case "19":
                $banner = (string) View::make('web.multibannersone.banner19', ['result' => $result])->render();
            break;
            case "20":
                $banner = (string) View::make('web.multibannersone.banner20', ['result' => $result])->render();
            break;
            case "21":
                $banner = (string) View::make('web.multibannersone.banner21', ['result' => $result])->render();
            break;
            case "22":
                $banner = (string) View::make('web.multibannersone.banner22', ['result' => $result])->render();
            break;
            case "23":
                $banner = (string) View::make('web.multibannersone.banner23', ['result' => $result])->render();
            break;
            case "24":
                $banner = (string) View::make('web.multibannersone.banner24', ['result' => $result])->render();
            break;
            case "25":
                $banner = (string) View::make('web.multibannersone.banner25', ['result' => $result])->render();
            break;
            case "26":
                $banner = (string) View::make('web.multibannersone.banner26', ['result' => $result])->render();
            break;
            case "27":
                $banner = (string) View::make('web.multibannersone.banner27', ['result' => $result])->render();
            break;
            case "28":
                $banner = (string) View::make('web.multibannersone.banner28', ['result' => $result])->render();
            break;
            case "29":
                $banner = (string) View::make('web.multibannersone.banner29', ['result' => $result])->render();
            case "30":
                $banner = (string) View::make('web.multibannersone.banner30', ['result' => $result])->render();
            break;
            case "31":
                $banner = (string) View::make('web.multibannersone.banner31', ['result' => $result])->render();
            break;
            case "32":
                $banner = (string) View::make('web.multibannersone.banner32', ['result' => $result])->render();
            break;

            case "33":
                $banner = (string) View::make('web.multibannersone.banner33', ['result' => $result])->render();
            break;
            case "34":
                $banner = (string) View::make('web.multibannersone.banner34', ['result' => $result])->render();
            break;
            case "35":
                $banner = (string) View::make('web.multibannersone.banner35', ['result' => $result])->render();
            break;
            case "36":
                $banner = (string) View::make('web.multibannersone.banner36', ['result' => $result])->render();
            break;
            case "37":
                $banner = (string) View::make('web.multibannersone.banner37', ['result' => $result])->render();
            break;
            case "38":
                $banner = (string) View::make('web.multibannersone.banner38', ['result' => $result])->render();
            break;
            case "39":
                $banner = (string) View::make('web.multibannersone.banner39', ['result' => $result])->render();
            break;
            case "40":
                $banner = (string) View::make('web.multibannersone.banner40', ['result' => $result])->render();
            break;
            case "41":
                $banner = (string) View::make('web.multibannersone.banner41', ['result' => $result])->render();
            break;
            case "42":
                $banner = (string) View::make('web.multibannersone.banner42', ['result' => $result])->render();
            break;
            case "43":
                $banner = (string) View::make('web.multibannersone.banner43', ['result' => $result])->render();
            break;
            case "44":
                $banner = (string) View::make('web.multibannersone.banner44', ['result' => $result])->render();
            break;
            case "45":
                $banner = (string) View::make('web.multibannersone.banner45', ['result' => $result])->render();
            break;
            case "46":
                $banner = (string) View::make('web.multibannersone.banner46', ['result' => $result])->render();
            break;
            case "47":
                $banner = (string) View::make('web.multibannersone.banner47', ['result' => $result])->render();
            break;
            case "48":
                $banner = (string) View::make('web.multibannersone.banner48', ['result' => $result])->render();
            break;
            case "49":
                $banner = (string) View::make('web.multibannersone.banner49', ['result' => $result])->render();
            break;
            case "50":
                $banner = (string) View::make('web.multibannersone.banner50', ['result' => $result])->render();
            break;
            case "51":
                $banner = (string) View::make('web.multibannersone.banner51', ['result' => $result])->render();
            break;
            case "52":
                $banner = (string) View::make('web.multibannersone.banner52', ['result' => $result])->render();
            break;
            case "53":
                $banner = (string) View::make('web.multibannersone.banner53', ['result' => $result])->render();
            break;
            case "54":
                $banner = (string) View::make('web.multibannersone.banner54', ['result' => $result])->render();
            break;
            case "55":
                $banner = (string) View::make('web.multibannersone.banner55', ['result' => $result])->render();
            break;
            case "56":
                $banner = (string) View::make('web.multibannersone.banner56', ['result' => $result])->render();
            break;
            case "57":
                $banner = (string) View::make('web.multibannersone.banner57', ['result' => $result])->render();
            break;
            case "58":
                $banner = (string) View::make('web.multibannersone.banner58', ['result' => $result])->render();
            break;
            case "59":
                $banner = (string) View::make('web.multibannersone.banner59', ['result' => $result])->render();
            break;
            case "60":
                $banner = (string) View::make('web.multibannersone.banner60', ['result' => $result])->render();
            break;
            case "61":
                $banner = (string) View::make('web.multibannersone.banner61', ['result' => $result])->render();
            break;
            case "62":
                $banner = (string) View::make('web.multibannersone.banner62', ['result' => $result])->render();
            break;
            case "63":
                $banner = (string) View::make('web.multibannersone.banner63', ['result' => $result])->render();
            break;
            case "64":
                $banner = (string) View::make('web.multibannersone.banner64', ['result' => $result])->render();
            break;
            case "65":
                $banner = (string) View::make('web.multibannersone.banner65', ['result' => $result])->render();
            break;
            case "66":
                $banner = (string) View::make('web.multibannersone.banner66', ['result' => $result])->render();
            break;
            case "67":
                $banner = (string) View::make('web.multibannersone.banner67', ['result' => $result])->render();
            break;
            case "68":
                $banner = (string) View::make('web.multibannersone.banner68', ['result' => $result])->render();
            break;
            case "69":
                $banner = (string) View::make('web.multibannersone.banner69', ['result' => $result])->render();
            break;
            case "70":
                $banner = (string) View::make('web.multibannersone.banner70', ['result' => $result])->render();
            break;
            case "71":
                $banner = (string) View::make('web.multibannersone.banner71', ['result' => $result])->render();
            break;
            case "72":
                $banner = (string) View::make('web.multibannersone.banner72', ['result' => $result])->render();
            break;
            case "73":
                $banner = (string) View::make('web.multibannersone.banner73', ['result' => $result])->render();
            break;



            default:
            $banner = (string) View::make('web.multibannersone.banner1', ['result' => $result])->render();
        }

       
        return $banner;
    }


    private function setMultibanner_two($banner_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->getbannersquery(4);

        switch ($banner_id) {
            case "1":
                $banner = (string) View::make('web.multibannerstwo.banner1', ['result' => $result])->render();
              break;
            case "2":
                $banner = (string) View::make('web.multibannerstwo.banner2', ['result' => $result])->render();
            break;
            case "3":
                $banner = (string) View::make('web.multibannerstwo.banner3', ['result' => $result])->render();
            break;
            case "4":
                $banner = (string) View::make('web.multibannerstwo.banner4', ['result' => $result])->render();
            break;
            case "5":
                $banner = (string) View::make('web.multibannerstwo.banner5', ['result' => $result])->render();
            break;
            case "6":
                $banner = (string) View::make('web.multibannerstwo.banner6', ['result' => $result])->render();
            break;
            case "7":
                $banner = (string) View::make('web.multibannerstwo.banner7', ['result' => $result])->render();
            break;
            case "8":
                $banner = (string) View::make('web.multibannerstwo.banner8', ['result' => $result])->render();
            break;
            case "9":
                $banner = (string) View::make('web.multibannerstwo.banner9', ['result' => $result])->render();
            break;
            case "10":
                $banner = (string) View::make('web.multibannerstwo.banner10', ['result' => $result])->render();
            break;
            case "11":
                $banner = (string) View::make('web.multibannerstwo.banner11', ['result' => $result])->render();
            break;
            case "12":
                $banner = (string) View::make('web.multibannerstwo.banner12', ['result' => $result])->render();
            break;
            case "13":
                $banner = (string) View::make('web.multibannerstwo.banner13', ['result' => $result])->render();
            break;
            case "14":
                $banner = (string) View::make('web.multibannerstwo.banner14', ['result' => $result])->render();
            break;
            case "15":
                $banner = (string) View::make('web.multibannerstwo.banner15', ['result' => $result])->render();
            break;
            case "16":
                $banner = (string) View::make('web.multibannerstwo.banner16', ['result' => $result])->render();
            break;
            case "17":
                $banner = (string) View::make('web.multibannerstwo.banner17', ['result' => $result])->render();
            break;
            case "18":
                $banner = (string) View::make('web.multibannerstwo.banner18', ['result' => $result])->render();
            break;
            case "19":
                $banner = (string) View::make('web.multibannerstwo.banner19', ['result' => $result])->render();
            break;
            case "20":
                $banner = (string) View::make('web.multibannerstwo.banner20', ['result' => $result])->render();
            break;
            case "21":
                $banner = (string) View::make('web.multibannerstwo.banner21', ['result' => $result])->render();
            break;
            case "22":
                $banner = (string) View::make('web.multibannerstwo.banner22', ['result' => $result])->render();
            break;
            case "23":
                $banner = (string) View::make('web.multibannerstwo.banner23', ['result' => $result])->render();
            break;
            case "24":
                $banner = (string) View::make('web.multibannerstwo.banner24', ['result' => $result])->render();
            break;
            case "25":
                $banner = (string) View::make('web.multibannerstwo.banner25', ['result' => $result])->render();
            break;
            case "26":
                $banner = (string) View::make('web.multibannerstwo.banner26', ['result' => $result])->render();
            break;
            case "27":
                $banner = (string) View::make('web.multibannerstwo.banner27', ['result' => $result])->render();
            break;
            case "28":
                $banner = (string) View::make('web.multibannerstwo.banner28', ['result' => $result])->render();
            break;
            case "29":
                $banner = (string) View::make('web.multibannerstwo.banner29', ['result' => $result])->render();
            case "30":
                $banner = (string) View::make('web.multibannerstwo.banner30', ['result' => $result])->render();
            break;
            case "31":
                $banner = (string) View::make('web.multibannerstwo.banner31', ['result' => $result])->render();
            break;
            case "32":
                $banner = (string) View::make('web.multibannerstwo.banner32', ['result' => $result])->render();
            break;

            case "33":
                $banner = (string) View::make('web.multibannerstwo.banner33', ['result' => $result])->render();
            break;
            case "34":
                $banner = (string) View::make('web.multibannerstwo.banner34', ['result' => $result])->render();
            break;
            case "35":
                $banner = (string) View::make('web.multibannerstwo.banner35', ['result' => $result])->render();
            break;
            case "36":
                $banner = (string) View::make('web.multibannerstwo.banner36', ['result' => $result])->render();
            break;
            case "37":
                $banner = (string) View::make('web.multibannerstwo.banner37', ['result' => $result])->render();
            break;
            case "38":
                $banner = (string) View::make('web.multibannerstwo.banner38', ['result' => $result])->render();
            break;
            case "39":
                $banner = (string) View::make('web.multibannerstwo.banner39', ['result' => $result])->render();
            break;
            case "40":
                $banner = (string) View::make('web.multibannerstwo.banner40', ['result' => $result])->render();
            break;
            case "41":
                $banner = (string) View::make('web.multibannerstwo.banner41', ['result' => $result])->render();
            break;
            case "42":
                $banner = (string) View::make('web.multibannerstwo.banner42', ['result' => $result])->render();
            break;
            case "43":
                $banner = (string) View::make('web.multibannerstwo.banner43', ['result' => $result])->render();
            break;
            case "44":
                $banner = (string) View::make('web.multibannerstwo.banner44', ['result' => $result])->render();
            break;
            case "45":
                $banner = (string) View::make('web.multibannerstwo.banner45', ['result' => $result])->render();
            break;
            case "46":
                $banner = (string) View::make('web.multibannerstwo.banner46', ['result' => $result])->render();
            break;
            case "47":
                $banner = (string) View::make('web.multibannerstwo.banner47', ['result' => $result])->render();
            break;
            case "48":
                $banner = (string) View::make('web.multibannerstwo.banner48', ['result' => $result])->render();
            break;
            case "49":
                $banner = (string) View::make('web.multibannerstwo.banner49', ['result' => $result])->render();
            break;
            case "50":
                $banner = (string) View::make('web.multibannerstwo.banner50', ['result' => $result])->render();
            break;
            case "51":
                $banner = (string) View::make('web.multibannerstwo.banner51', ['result' => $result])->render();
            break;
            case "52":
                $banner = (string) View::make('web.multibannerstwo.banner52', ['result' => $result])->render();
            break;
            case "53":
                $banner = (string) View::make('web.multibannerstwo.banner53', ['result' => $result])->render();
            break;
            case "54":
                $banner = (string) View::make('web.multibannerstwo.banner54', ['result' => $result])->render();
            break;
            case "55":
                $banner = (string) View::make('web.multibannerstwo.banner55', ['result' => $result])->render();
            break;
            case "56":
                $banner = (string) View::make('web.multibannerstwo.banner56', ['result' => $result])->render();
            break;
            case "57":
                $banner = (string) View::make('web.multibannerstwo.banner57', ['result' => $result])->render();
            break;
            case "58":
                $banner = (string) View::make('web.multibannerstwo.banner58', ['result' => $result])->render();
            break;
            case "59":
                $banner = (string) View::make('web.multibannerstwo.banner59', ['result' => $result])->render();
            break;
            case "60":
                $banner = (string) View::make('web.multibannerstwo.banner60', ['result' => $result])->render();
            break;
            case "61":
                $banner = (string) View::make('web.multibannerstwo.banner61', ['result' => $result])->render();
            break;
            case "62":
                $banner = (string) View::make('web.multibannerstwo.banner62', ['result' => $result])->render();
            break;
            case "63":
                $banner = (string) View::make('web.multibannerstwo.banner63', ['result' => $result])->render();
            break;
            case "64":
                $banner = (string) View::make('web.multibannerstwo.banner64', ['result' => $result])->render();
            break;
            case "65":
                $banner = (string) View::make('web.multibannerstwo.banner65', ['result' => $result])->render();
            break;
            case "66":
                $banner = (string) View::make('web.multibannerstwo.banner66', ['result' => $result])->render();
            break;
            case "67":
                $banner = (string) View::make('web.multibannerstwo.banner67', ['result' => $result])->render();
            break;
            case "68":
                $banner = (string) View::make('web.multibannerstwo.banner68', ['result' => $result])->render();
            break;
            case "69":
                $banner = (string) View::make('web.multibannerstwo.banner69', ['result' => $result])->render();
            break;
            case "70":
                $banner = (string) View::make('web.multibannerstwo.banner70', ['result' => $result])->render();
            break;
            case "71":
                $banner = (string) View::make('web.multibannerstwo.banner71', ['result' => $result])->render();
            break;
            case "72":
                $banner = (string) View::make('web.multibannerstwo.banner72', ['result' => $result])->render();
            break;
            case "73":
                $banner = (string) View::make('web.multibannerstwo.banner73', ['result' => $result])->render();
            break;



            default:
            $banner = (string) View::make('web.multibannerstwo.banner1', ['result' => $result])->render();
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

        if (Auth::guard('customer')->check()) {
            $count = $index->compareCount();
        } else {
            $count = "";
        }

        switch ($footer_id) {
            case "1":
                $footer = (string) View::make('web.footers.footer1', ['count' => $count,'result' => $result])->render();
              break;
            case "2":
                $footer = (string) View::make('web.footers.footer2', ['count' => $count,'result' => $result])->render();
            break;
            case "3":
                $footer = (string) View::make('web.footers.footer3', ['count' => $count,'result' => $result])->render();
            break;
            case "4":
                $footer = (string) View::make('web.footers.footer4', ['count' => $count,'result' => $result])->render();
            break;
            case "5":
                $footer = (string) View::make('web.footers.footer5', ['count' => $count,'result' => $result])->render();
            break;
            case "6":
                $footer = (string) View::make('web.footers.footer6', ['count' => $count,'result' => $result])->render();
            break;
            case "7":
                $footer = (string) View::make('web.footers.footer7', ['count' => $count,'result' => $result])->render();
            break;
            case "8":
                $footer = (string) View::make('web.footers.footer8', ['count' => $count,'result' => $result])->render();
            break;
            case "9":
                $footer = (string) View::make('web.footers.footer9', ['count' => $count,'result' => $result])->render();
            break;
            case "10":
                $footer = (string) View::make('web.footers.footer10', ['count' => $count,'result' => $result])->render();
            break;
            case "11":
                $footer = (string) View::make('web.footers.footer11', ['count' => $count,'result' => $result])->render();
            break;
            case "12":
                $footer = (string) View::make('web.footers.footer12', ['count' => $count,'result' => $result])->render();
            break;
            case "13":
                $footer = (string) View::make('web.footers.footer13', ['count' => $count,'result' => $result])->render();
            break;
            case "14":
                $footer = (string) View::make('web.footers.footer14', ['count' => $count,'result' => $result])->render();
            break;
            case "15":
                $footer = (string) View::make('web.footers.footer15', ['count' => $count,'result' => $result])->render();
            break;
            case "16":
                $footer = (string) View::make('web.footers.footer16', ['count' => $count,'result' => $result])->render();
            break;
            case "17":
                $footer = (string) View::make('web.footers.footer17', ['count' => $count,'result' => $result])->render();
            break;
            case "18":
                $footer = (string) View::make('web.footers.footer18', ['count' => $count,'result' => $result])->render();
            break;
            case "19":
                $footer = (string) View::make('web.footers.footer19', ['count' => $count,'result' => $result])->render();
            break;
            case "20":
                $footer = (string) View::make('web.footers.footer20', ['count' => $count,'result' => $result])->render();
            break;
            case "21":
                $footer = (string) View::make('web.footers.footer21', ['count' => $count,'result' => $result])->render();
            break;
            case "22":
                $footer = (string) View::make('web.footers.footer22', ['count' => $count,'result' => $result])->render();
            break;
            case "23":
                $footer = (string) View::make('web.footers.footer23', ['count' => $count,'result' => $result])->render();
            break;
            case "24":
                $footer = (string) View::make('web.footers.footer24', ['count' => $count,'result' => $result])->render();
            break;
            case "25":
                $footer = (string) View::make('web.footers.footer25', ['count' => $count,'result' => $result])->render();
            break;
            case "26":
                $footer = (string) View::make('web.footers.footer26', ['count' => $count,'result' => $result])->render();
            break;
            case "27":
                $footer = (string) View::make('web.footers.footer27', ['count' => $count,'result' => $result])->render();
            break;
            case "28":
                $footer = (string) View::make('web.footers.footer28', ['count' => $count,'result' => $result])->render();
            break;
            case "29":
                $footer = (string) View::make('web.footers.footer29', ['count' => $count,'result' => $result])->render();
            break;
            case "30":
                $footer = (string) View::make('web.footers.footer30', ['count' => $count,'result' => $result])->render();
            break;
            case "31":
                $footer = (string) View::make('web.footers.footer31', ['count' => $count,'result' => $result])->render();
            break;
            case "32":
                $footer = (string) View::make('web.footers.footer32', ['count' => $count,'result' => $result])->render();
            break;

            case "33":
                $footer = (string) View::make('web.footers.footer33', ['count' => $count,'result' => $result])->render();
            break;
            case "34":
                $footer = (string) View::make('web.footers.footer34', ['count' => $count,'result' => $result])->render();
            break;
            case "35":
                $footer = (string) View::make('web.footers.footer35', ['count' => $count,'result' => $result])->render();
            break;
            case "36":
                $footer = (string) View::make('web.footers.footer36', ['count' => $count,'result' => $result])->render();
            break;
            case "37":
                $footer = (string) View::make('web.footers.footer37', ['count' => $count,'result' => $result])->render();
            break;
            case "38":
                $footer = (string) View::make('web.footers.footer38', ['count' => $count,'result' => $result])->render();
            break;

            default:
            $footer = (string) View::make('web.footers.footer1', ['count' => $count,'result' => $result])->render();
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

         if (Auth::guard('customer')->check()) {
            $count = $index->compareCount();
        } else {
            $count = "";
        }

         switch ($footer_id) {
            case "1":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
              break;
            case "2":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "3":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "4":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "5":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "6":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "7":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "8":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "9":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "10":
                $footer = (string) View::make('web.footers.mobile', ['count' => $count,'result' => $result])->render();
            break;
            case "11":
                $footer = (string) View::make('web.footers.mobile11', ['count' => $count,'result' => $result])->render();
            break;
            case "12":
                $footer = (string) View::make('web.footers.mobile12', ['count' => $count,'result' => $result])->render();
            break;
            case "13":
                $footer = (string) View::make('web.footers.mobile13', ['count' => $count,'result' => $result])->render();
            break;
            case "14":
                $footer = (string) View::make('web.footers.mobile14', ['count' => $count,'result' => $result])->render();
            break;
            case "15":
                $footer = (string) View::make('web.footers.mobile15', ['count' => $count,'result' => $result])->render();
            break;
            case "16":
                $footer = (string) View::make('web.footers.mobile16', ['count' => $count,'result' => $result])->render();
            break;
            case "17":
                $footer = (string) View::make('web.footers.mobile17', ['count' => $count,'result' => $result])->render();
            break;
            case "18":
                $footer = (string) View::make('web.footers.mobile18', ['count' => $count,'result' => $result])->render();
            break;
            case "19":
                $footer = (string) View::make('web.footers.mobile19', ['count' => $count,'result' => $result])->render();
            break;
            case "20":
                $footer = (string) View::make('web.footers.mobile20', ['count' => $count,'result' => $result])->render();
            break;
            case "21":
                $footer = (string) View::make('web.footers.mobile21', ['count' => $count,'result' => $result])->render();
            break;
            case "22":
                $footer = (string) View::make('web.footers.mobile22', ['count' => $count,'result' => $result])->render();
            break;
            case "23":
                $footer = (string) View::make('web.footers.mobile23', ['count' => $count,'result' => $result])->render();
            break;
            case "24":
                $footer = (string) View::make('web.footers.mobile24', ['count' => $count,'result' => $result])->render();
            break;
            case "25":
                $footer = (string) View::make('web.footers.mobile25', ['count' => $count,'result' => $result])->render();
            break;
            case "26":
                $footer = (string) View::make('web.footers.mobile26', ['count' => $count,'result' => $result])->render();
            break;
            case "27":
                $footer = (string) View::make('web.footers.mobile27', ['count' => $count,'result' => $result])->render();
            break;
            case "28":
                $footer = (string) View::make('web.footers.mobile28', ['count' => $count,'result' => $result])->render();
            break;
            case "29":
                $footer = (string) View::make('web.footers.mobile29', ['count' => $count,'result' => $result])->render();
            break;
            case "30":
                $footer = (string) View::make('web.footers.mobile30', ['count' => $count,'result' => $result])->render();
            break;
            case "31":
                $footer = (string) View::make('web.footers.mobile31', ['count' => $count,'result' => $result])->render();
            break;
            case "32":
                $footer = (string) View::make('web.footers.mobile32', ['count' => $count,'result' => $result])->render();
            break;

            case "33":
                $footer = (string) View::make('web.footers.mobile33', ['count' => $count,'result' => $result])->render();
            break;
            case "34":
                $footer = (string) View::make('web.footers.mobile34', ['count' => $count,'result' => $result])->render();
            break;
            case "35":
                $footer = (string) View::make('web.footers.mobile35', ['count' => $count,'result' => $result])->render();
            break;
            case "36":
                $footer = (string) View::make('web.footers.mobile36', ['count' => $count,'result' => $result])->render();
            break;
            case "37":
                $footer = (string) View::make('web.footers.mobile37', ['count' => $count,'result' => $result])->render();
            break;
            case "38":
                $footer = (string) View::make('web.footers.mobile38', ['count' => $count,'result' => $result])->render();
            break;

            default:
            $footer = (string) View::make('web.footers.mobile1', ['count' => $count,'result' => $result])->render();
        }

        return $footer;
    }


    private function setInfoBoxes($info_boxes_id)
    {

        switch ($info_boxes_id) {
            case "1":
                $info_boxes = (string) View::make('web.info_box.info_box1')->render();
              break;
            case "2":
                $info_boxes = (string) View::make('web.info_box.info_box2')->render();
            break;
            case "3":
                $info_boxes = (string) View::make('web.info_box.info_box3')->render();
            break;
            case "4":
                $info_boxes = (string) View::make('web.info_box.info_box4')->render();
            break;
            case "5":
                $info_boxes = (string) View::make('web.info_box.info_box5')->render();
            break;
            case "6":
                $info_boxes = (string) View::make('web.info_box.info_box6')->render();
            break;
            case "7":
                $info_boxes = (string) View::make('web.info_box.info_box7')->render();
            break;
            case "8":
                $info_boxes = (string) View::make('web.info_box.info_box8')->render();
            break;
            case "9":
                $info_boxes = (string) View::make('web.info_box.info_box9')->render();
            break;
            case "10":
                $info_boxes = (string) View::make('web.info_box.info_box10')->render();
            break;
            case "11":
                $info_boxes = (string) View::make('web.info_box.info_box11')->render();
            break;
            case "12":
                $info_boxes = (string) View::make('web.info_box.info_box12')->render();
            break;
            case "13":
                $info_boxes = (string) View::make('web.info_box.info_box13')->render();
            break;
            case "14":
                $info_boxes = (string) View::make('web.info_box.info_box14')->render();
            break;
            case "15":
                $info_boxes = (string) View::make('web.info_box.info_box15')->render();
            break;
            case "16":
                $info_boxes = (string) View::make('web.info_box.info_box16')->render();
            break;
            case "17":
                $info_boxes = (string) View::make('web.info_box.info_box17')->render();
            break;
            case "18":
                $info_boxes = (string) View::make('web.info_box.info_box18')->render();
            break;
            case "19":
                $info_boxes = (string) View::make('web.info_box.info_box19')->render();
            break;
            case "20":
                $info_boxes = (string) View::make('web.info_box.info_box20')->render();
            break;
            case "21":
                $info_boxes = (string) View::make('web.info_box.info_box21')->render();
            break;
            case "22":
                $info_boxes = (string) View::make('web.info_box.info_box22')->render();
            break;
    

            default:
            $info_boxes = (string) View::make('web.info_box.info_box1')->render();
        }
       
        return $info_boxes;
    }

    private function setSpecialProducts($special_pros_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($special_pros_id) {
            case "1":
                $special_pros = (string) View::make('web.special_product.special1', ['result' => $result])->render();
              break;
            case "2":
                $special_pros = (string) View::make('web.special_product.special2', ['result' => $result])->render();
            break;
            case "3":
                $special_pros = (string) View::make('web.special_product.special3', ['result' => $result])->render();
            break;
            case "4":
                $special_pros = (string) View::make('web.special_product.special4', ['result' => $result])->render();
            break;
            case "5":
                $special_pros = (string) View::make('web.special_product.special5', ['result' => $result])->render();
            break;
            case "6":
                $special_pros = (string) View::make('web.special_product.special6', ['result' => $result])->render();
            break;
            case "7":
                $special_pros = (string) View::make('web.special_product.special7', ['result' => $result])->render();
            break;
            case "8":
                $special_pros = (string) View::make('web.special_product.special8', ['result' => $result])->render();
            break;
            case "9":
                $special_pros = (string) View::make('web.special_product.special9', ['result' => $result])->render();
            break;
            case "10":
                $special_pros = (string) View::make('web.special_product.special10', ['result' => $result])->render();
            break;
            case "11":
                $special_pros = (string) View::make('web.special_product.special11', ['result' => $result])->render();
            break;
            case "12":
                $special_pros = (string) View::make('web.special_product.special12', ['result' => $result])->render();
            break;
            case "13":
                $special_pros = (string) View::make('web.special_product.special13', ['result' => $result])->render();
            break;
            case "14":
                $special_pros = (string) View::make('web.special_product.special14', ['result' => $result])->render();
            break;
            case "15":
                $special_pros = (string) View::make('web.special_product.special15', ['result' => $result])->render();
            break;

            default:
            $special_pros = (string) View::make('web.special_product.special1', ['result' => $result])->render();
        }

        return $special_pros;
    }

    private function setNewDeals($new_deals_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($new_deals_id) {
            case "1":
                $new_deals = (string) View::make('web.new_deal.deal1', ['result' => $result])->render();
              break;
            case "2":
                $new_deals = (string) View::make('web.new_deal.deal2', ['result' => $result])->render();
            break;
            case "3":
                $new_deals = (string) View::make('web.new_deal.deal3', ['result' => $result])->render();
            break;
            case "4":
                $new_deals = (string) View::make('web.new_deal.deal4', ['result' => $result])->render();
            break;
            case "5":
                $new_deals = (string) View::make('web.new_deal.deal5', ['result' => $result])->render();
            break;
        

            default:
            $new_deals = (string) View::make('web.new_deal.deal1', ['result' => $result])->render();
        }
        return $new_deals;
    }

    private function setTrendPro($trend_pros_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($trend_pros_id) {
            case "1":
                $trend_pros = (string) View::make('web.trend_product.trend1', ['result' => $result])->render();
              break;
            case "2":
                $trend_pros = (string) View::make('web.trend_product.trend2', ['result' => $result])->render();
            break;
            case "3":
                $trend_pros = (string) View::make('web.trend_product.trend3', ['result' => $result])->render();
            break;
            case "4":
                $trend_pros = (string) View::make('web.trend_product.trend4', ['result' => $result])->render();
            break;
            case "5":
                $trend_pros = (string) View::make('web.trend_product.trend5', ['result' => $result])->render();
            break;
            case "6":
                $trend_pros = (string) View::make('web.trend_product.trend6', ['result' => $result])->render();
            break;
            case "7":
                $trend_pros = (string) View::make('web.trend_product.trend7', ['result' => $result])->render();
            break;
            case "8":
                $trend_pros = (string) View::make('web.trend_product.trend8', ['result' => $result])->render();
            break;
            case "9":
                $trend_pros = (string) View::make('web.trend_product.trend9', ['result' => $result])->render();
            break;
            case "10":
                $trend_pros = (string) View::make('web.trend_product.trend10', ['result' => $result])->render();
            break;
            case "11":
                $trend_pros = (string) View::make('web.trend_product.trend11', ['result' => $result])->render();
            break;
            case "12":
                $trend_pros = (string) View::make('web.trend_product.trend12', ['result' => $result])->render();
            break;
            case "13":
                $trend_pros = (string) View::make('web.trend_product.trend13', ['result' => $result])->render();
            break;
            case "14":
                $trend_pros = (string) View::make('web.trend_product.trend15', ['result' => $result])->render();
            break;
            case "15":
                $trend_pros = (string) View::make('web.trend_product.trend16', ['result' => $result])->render();
            break;

            default:
            $trend_pros = (string) View::make('web.trend_product.trend1', ['result' => $result])->render();
        }

        return $trend_pros;
    }


    private function setTabSections($tab_sections_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($tab_sections_id) {
            case "1":
                $tab_sections = (string) View::make('web.tab_section.tab1', ['result' => $result])->render();
              break;
            case "2":
                $tab_sections = (string) View::make('web.tab_section.tab2', ['result' => $result])->render();
            break;
            case "3":
                $tab_sections = (string) View::make('web.tab_section.tab3', ['result' => $result])->render();
            break;
            case "4":
                $tab_sections = (string) View::make('web.tab_section.tab4', ['result' => $result])->render();
            break;
            case "5":
                $tab_sections = (string) View::make('web.tab_section.tab5', ['result' => $result])->render();
            break;
            case "6":
                $tab_sections = (string) View::make('web.tab_section.tab6', ['result' => $result])->render();
            break;
            case "7":
                $tab_sections = (string) View::make('web.tab_section.tab7', ['result' => $result])->render();
            break;
            case "8":
                $tab_sections = (string) View::make('web.tab_section.tab8', ['result' => $result])->render();
            break;

            default:
            $tab_sections = (string) View::make('web.tab_section.tab1', ['result' => $result])->render();
        }

        return $tab_sections;
    }

    private function setTopSelling($top_sells_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($top_sells_id) {
            case "1":
                $top_sells = (string) View::make('web.top_sell.top1', ['result' => $result])->render();
              break;
            case "2":
                $top_sells = (string) View::make('web.top_sell.top2', ['result' => $result])->render();
            break;
            case "3":
                $top_sells = (string) View::make('web.top_sell.top3', ['result' => $result])->render();
            break;
            case "4":
                $top_sells = (string) View::make('web.top_sell.top4', ['result' => $result])->render();
            break;
            case "5":
                $top_sells = (string) View::make('web.top_sell.top5', ['result' => $result])->render();
            break;
            case "6":
                $top_sells = (string) View::make('web.top_sell.top6', ['result' => $result])->render();
            break;
            case "7":
                $top_sells = (string) View::make('web.top_sell.top7', ['result' => $result])->render();
            break;
            case "8":
                $top_sells = (string) View::make('web.top_sell.top8', ['result' => $result])->render();
            break;
            case "9":
                $top_sells = (string) View::make('web.top_sell.top9', ['result' => $result])->render();
            break;
            case "10":
                $top_sells = (string) View::make('web.top_sell.top10', ['result' => $result])->render();
            break;
            case "11":
                $top_sells = (string) View::make('web.top_sell.top11', ['result' => $result])->render();
            break;
            case "12":
                $top_sells = (string) View::make('web.top_sell.top12', ['result' => $result])->render();
            break;
            case "14":
                $top_sells = (string) View::make('web.top_sell.top14', ['result' => $result])->render();
            break;
            case "15":
                $top_sells = (string) View::make('web.top_sell.top15', ['result' => $result])->render();
            break;
            case "16":
                $top_sells = (string) View::make('web.top_sell.top16', ['result' => $result])->render();
            break;
            case "17":
                $top_sells = (string) View::make('web.top_sell.top17', ['result' => $result])->render();
            break;

            default:
            $top_sells = (string) View::make('web.top_sell.top1', ['result' => $result])->render();
        }


       
        return $top_sells;
    }

    private function setRecentArrival($recent_arrivals_id,$ids='')
    {
        $index = new Index();
        $products = new Products();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();



        $title = array('pageTitle' => Lang::get('website.Shop'));
        $result1 = array();

        $result1['commonContent'] = $index->commonContent();
      
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 8;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result1['category_name'] = $category_name;
        $result1['category_slug'] = $category_slug;
        $result1['sub_category_name'] = $sub_category_name;
        $result1['categories_status'] = $categories_status;


        $category_section = array();
        if(!empty($result1['commonContent']['settings']['home_category']))
        {
            $categories_array = explode(',',$result1['commonContent']['settings']['home_category']);
            $index = 0;
            foreach($categories_array as $item){
                
                //get category section detail
                $category = $products->getCategorybyId($item);
                if($category){
                    $category_section[$index] = $category;
                   
                        $data = array('page_number' => '0', 'categories_id'=>$category->categories_id, 'type' => '', 'limit' => 8, 'min_price' => '', 'max_price' => '');
                    
                    $single_product = $products->products($data);
                    $category_section[$index]->products = $single_product;
                    $index++;
                }
            }
            
        }
        $result1['category_section'] = $category_section;
    


        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode(',',$options);
            $filters['option_value'] = implode(',',$option_values);

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result1['filter_attribute']['options'] = $options;
            $result1['filter_attribute']['option_values'] = $option_values;
        }

        $brand = '';

        if(isset($request->brand)){
            $brand = $request->brand;
        }
        $data1111 = array('check' => 1,'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'brand' => $brand);

            

        $products1 = $products->products_check($data1111);  
        // print_r($products);die();      
        $result1['products'] = $products1;
       

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $products->filters($data);
        $result1['filters'] = $filters;

        $cart = '';
        $result['cartArray'] = $products->cartIdArray($cart);

        if ($limit > $result1['products']['total_record']) {
            $result1['limit'] = $result1['products']['total_record'];
        } else {
            $result1['limit'] = $limit;
        }

       

        //liked products
        $result1['liked_products'] = $products->likedProducts();
        $result1['categories'] = $products->categories();

        $result1['min_price'] = $min_price;
        $result1['max_price'] = $max_price;


        switch ($recent_arrivals_id) {
            case "1":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival1', ['result' => $result])->render();
              break;
            case "2":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival2', ['result' => $result])->render();
            break;
            case "3":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival3', ['result' => $result])->render();
            break;
            case "4":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival4', ['result' => $result])->render();
            break;
            case "5":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival5', ['result' => $result])->render();
            break;
            case "6":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival6', ['result' => $result])->render();
            break;
            case "7":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival7', ['result' => $result])->render();
              break;
            case "8":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival8', ['result' => $result])->render();
            break;
            case "9":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival9', ['result' => $result])->render();
            break;
            case "10":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival10', ['result' => $result])->render();
            break;
            case "11":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival11', ['result' => $result])->render();
            break;
            case "12":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival12', ['result' => $result ,'result1' => $result1])->render();
            break;
            case "13":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival13', ['result' => $result])->render();
              break;
            case "14":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival14', ['result' => $result])->render();
            break;
            case "15":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival15', ['result' => $result])->render();
            break;
            case "16":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival16', ['result' => $result])->render();
            break;
            case "17":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival17', ['result' => $result])->render();
            break;
            case "18":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival18', ['result' => $result])->render();
            break;
            case "19":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival19', ['result' => $result])->render();
            break;
            case "20":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival20', ['result' => $result])->render();
            break;
            case "21":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival21', ['result' => $result])->render();
            break;
            case "22":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival22', ['result' => $result])->render();
            break;
            case "23":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival23', ['result' => $result])->render();
            break;
            case "24":
                $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival25', ['result' => $result])->render();
            break;

            default:
            $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival1', ['result' => $result])->render();
        }

        return $recent_arrivals;
    }


    private function setCategories($categories_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($categories_id) {
            case "1":
                $categories = (string) View::make('web.category.category1', ['result' => $result])->render();
              break;
            case "2":
                $categories = (string) View::make('web.category.category2', ['result' => $result])->render();
            break;
            case "3":
                $categories = (string) View::make('web.category.category3', ['result' => $result])->render();
            break;
            case "4":
                $categories = (string) View::make('web.category.category4', ['result' => $result])->render();
            break;
            case "5":
                $categories = (string) View::make('web.category.category5', ['result' => $result])->render();
            break;
            case "6":
                $categories = (string) View::make('web.category.category6', ['result' => $result])->render();
            break;
            case "7":
                $categories = (string) View::make('web.category.category7', ['result' => $result])->render();
            break;
            case "8":
            $categories = (string) View::make('web.category.category8', ['result' => $result])->render();
            break;
            case "9":
                $categories = (string) View::make('web.category.category9', ['result' => $result])->render();
            break;
            case "10":
                $categories = (string) View::make('web.category.category10', ['result' => $result])->render();
            break;
           
            default:
            $categories = (string) View::make('web.category.category1', ['result' => $result])->render();
        }

        return $categories;
    }

    private function setProductCategories($productcategories_id)
    {
        $index = new Index();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();

        switch ($productcategories_id) {
            case "1":
                $productcategories = (string) View::make('web.productcategory.productcategory1', ['result' => $result])->render();
            case "2":
                $productcategories = (string) View::make('web.productcategory.productcategory2', ['result' => $result])->render();
            break;
            case "3":
                $productcategories = (string) View::make('web.productcategory.productcategory3', ['result' => $result])->render();
            break;
           
           
            default:
            $productcategories = (string) View::make('web.productcategory.productcategory1', ['result' => $result])->render();
        }

        return $productcategories;
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

        switch ($flash_id) {
            case "1":
                $flash = (string) View::make('web.flash.flash1', ['result' => $result])->render();
              break;
            case "2":
                $flash = (string) View::make('web.flash.flash2', ['result' => $result])->render();
            break;
            case "3":
                $flash = (string) View::make('web.flash.flash3', ['result' => $result])->render();
            break;
            case "4":
                $flash = (string) View::make('web.flash.flash4', ['result' => $result])->render();
            break;
            case "5":
                $flash = (string) View::make('web.flash.flash5', ['result' => $result])->render();
            break;
           
            default:
            $flash = (string) View::make('web.flash.flash5', ['result' => $result])->render();
        }

        return $flash;
    }

    private function setSubscribe($subscribe_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        switch ($subscribe_id) {
            case "1":
                $subscribe = (string) View::make('web.subscribe.subscribe1', ['result' => $result])->render();
              break;
            case "2":
                $subscribe = (string) View::make('web.subscribe.subscribe2', ['result' => $result])->render();
            break;
            case "3":
                $subscribe = (string) View::make('web.subscribe.subscribe3', ['result' => $result])->render();
            break;
            case "4":
                $subscribe = (string) View::make('web.subscribe.subscribe4', ['result' => $result])->render();
            break;
            case "5":
                $subscribe = (string) View::make('web.subscribe.subscribe5', ['result' => $result])->render();
            break;
            case "6":
                $subscribe = (string) View::make('web.subscribe.subscribe6', ['result' => $result])->render();
            break;
            case "7":
                $subscribe = (string) View::make('web.subscribe.subscribe7', ['result' => $result])->render();
            break;
            case "8":
                $subscribe = (string) View::make('web.subscribe.subscribe8', ['result' => $result])->render();
            break;
            case "9":
                $subscribe = (string) View::make('web.subscribe.subscribe9', ['result' => $result])->render();
            break;
            case "10":
                $subscribe = (string) View::make('web.subscribe.subscribe10', ['result' => $result])->render();
            break;
            case "11":
                $subscribe = (string) View::make('web.subscribe.subscribe11', ['result' => $result])->render();
            break;
            case "12":
                $subscribe = (string) View::make('web.subscribe.subscribe12', ['result' => $result])->render();
            break;
            case "13":
                $subscribe = (string) View::make('web.subscribe.subscribe13', ['result' => $result])->render();
            break;
            case "14":
                $subscribe = (string) View::make('web.subscribe.subscribe14', ['result' => $result])->render();
            break;
            case "15":
                $subscribe = (string) View::make('web.subscribe.subscribe15', ['result' => $result])->render();
            break;
            case "16":
                $subscribe = (string) View::make('web.subscribe.subscribe16', ['result' => $result])->render();
            break;
            case "17":
                $subscribe = (string) View::make('web.subscribe.subscribe17', ['result' => $result])->render();
            break;
            case "18":
                $subscribe = (string) View::make('web.subscribe.subscribe18', ['result' => $result])->render();
            break;
            case "19":
                $subscribe = (string) View::make('web.subscribe.subscribe19', ['result' => $result])->render();
            break;
            case "20":
                $subscribe = (string) View::make('web.subscribe.subscribe20', ['result' => $result])->render();
            break;
            case "21":
                $subscribe = (string) View::make('web.subscribe.subscribe21', ['result' => $result])->render();
            break;

            default:
            $subscribe = (string) View::make('web.subscribe.subscribe1', ['result' => $result])->render();
        }

        return $subscribe;
        
    }

    private function setBlog($blog_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        switch ($blog_id) {
            case "1":
                $blog = (string) View::make('web.blog.blog1', ['result' => $result])->render();
              break;
            case "2":
                $blog = (string) View::make('web.blog.blog2', ['result' => $result])->render();
            break;
            case "3":
                $blog = (string) View::make('web.blog.blog3', ['result' => $result])->render();
            break;
            case "4":
                $blog = (string) View::make('web.blog.blog4', ['result' => $result])->render();
            break;
            case "5":
                $blog = (string) View::make('web.blog.blog5', ['result' => $result])->render();
            break;
            case "6":
                $blog = (string) View::make('web.blog.blog6', ['result' => $result])->render();
            break;
            case "7":
                $blog = (string) View::make('web.blog.blog7', ['result' => $result])->render();
            break;
            case "8":
                $blog = (string) View::make('web.blog.blog8', ['result' => $result])->render();
            break;
            case "9":
                $blog = (string) View::make('web.blog.blog9', ['result' => $result])->render();
            break;
            case "10":
                $blog = (string) View::make('web.blog.blog10', ['result' => $result])->render();
            break;
            case "11":
                $blog = (string) View::make('web.blog.blog11', ['result' => $result])->render();
            break;
            case "12":
                $blog = (string) View::make('web.blog.blog12', ['result' => $result])->render();
            break;
            case "13":
                $blog = (string) View::make('web.blog.blog13', ['result' => $result])->render();
            break;
            case "14":
                $blog = (string) View::make('web.blog.blog14', ['result' => $result])->render();
            break;
            case "15":
                $blog = (string) View::make('web.blog.blog15', ['result' => $result])->render();
            break;
            case "16":
                $blog = (string) View::make('web.blog.blog16', ['result' => $result])->render();
            break;
            case "17":
                $blog = (string) View::make('web.blog.blog17', ['result' => $result])->render();
            break;
            case "18":
                $blog = (string) View::make('web.blog.blog18', ['result' => $result])->render();
            break;
            case "19":
                $blog = (string) View::make('web.blog.blog19', ['result' => $result])->render();
            break;
            case "20":
                $blog = (string) View::make('web.blog.blog20', ['result' => $result])->render();
            break;
           
            default:
            $blog = (string) View::make('web.blog.blog1', ['result' => $result])->render();
        }

       
        return $blog;
        
    }


    private function setWhychooseus($whychooseus_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        switch ($whychooseus_id) {
              case "1":
                $whychooseus = (string) View::make('web.whychooseus.whychooseus1', ['result' => $result])->render();
              break;
              case "2":
                $whychooseus = (string) View::make('web.whychooseus.whychooseus2', ['result' => $result])->render();
              break;
            
            default:
            $whychooseus = (string) View::make('web.whychooseus.whychooseus1', ['result' => $result])->render();
        }

        return $whychooseus;
        
    }


    private function setCustomerReview($customer_review_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        switch ($customer_review_id) {
            case "1":
                $customer_review = (string) View::make('web.customer_review.customer_review1', ['result' => $result])->render();
              break;
            case "2":
                $customer_review = (string) View::make('web.customer_review.customer_review2', ['result' => $result])->render();
            break;
            case "3":
                $customer_review = (string) View::make('web.customer_review.customer_review3', ['result' => $result])->render();
            break;
            case "4":
                $customer_review = (string) View::make('web.customer_review.customer_review4', ['result' => $result])->render();
            break;
            case "5":
                $customer_review = (string) View::make('web.customer_review.customer_review5', ['result' => $result])->render();
            break;
            case "6":
                $customer_review = (string) View::make('web.customer_review.customer_review6', ['result' => $result])->render();
            break;
            case "7":
                $customer_review = (string) View::make('web.customer_review.customer_review7', ['result' => $result])->render();
            break;
            case "8":
                $customer_review = (string) View::make('web.customer_review.customer_review8', ['result' => $result])->render();
            break;
           
            default:
            $customer_review = (string) View::make('web.customer_review.customer_review1', ['result' => $result])->render();
        }


        return $customer_review;
        
    }


    private function setInstagrams($instagram_id)
    {
        $index = new Index();
        $products = new Products();

        $result['commonContent'] = $index->commonContent();

        switch ($instagram_id) {
            case "1":
                $instagram = (string) View::make('web.instagram.instagram1', ['result' => $result])->render();
              break;
            case "2":
                $instagram = (string) View::make('web.instagram.instagram2', ['result' => $result])->render();
            break;
            case "3":
                $instagram = (string) View::make('web.instagram.instagram3', ['result' => $result])->render();
            break;
            case "4":
                $instagram = (string) View::make('web.instagram.instagram4', ['result' => $result])->render();
            break;
            case "5":
                $instagram = (string) View::make('web.instagram.instagram5', ['result' => $result])->render();
            break;
            case "6":
                $instagram = (string) View::make('web.instagram.instagram6', ['result' => $result])->render();
            break;
            case "7":
                $instagram = (string) View::make('web.instagram.instagram7', ['result' => $result])->render();
            break;
            case "8":
                $instagram = (string) View::make('web.instagram.instagram8', ['result' => $result])->render();
            break;
            case "9":
                $instagram = (string) View::make('web.instagram.instagram9', ['result' => $result])->render();
            break;
            case "10":
                $instagram = (string) View::make('web.instagram.instagram10', ['result' => $result])->render();
            break;
            case "11":
                $instagram = (string) View::make('web.instagram.instagram11', ['result' => $result])->render();
            break;
            case "12":
                $instagram = (string) View::make('web.instagram.instagram12', ['result' => $result])->render();
            break;
           
            default:
            $instagram = (string) View::make('web.instagram.instagram1', ['result' => $result])->render();
        }

        return $instagram;
        
    }


    public function filter24(Request $request)
    {
        $index = new Index();
        $products = new Products();
        $result['commonContent'] = $index->commonContent();
        $result['shoppinginfo'] = $index->shoppinginfo();



        $title = array('pageTitle' => Lang::get('website.Shop'));
        $result1 = array();

        $result1['commonContent'] = $index->commonContent();
      
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 8;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode(";", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result1['category_name'] = $category_name;
        $result1['category_slug'] = $category_slug;
        $result1['sub_category_name'] = $sub_category_name;
        $result1['categories_status'] = $categories_status;


        $category_section = array();
        if(!empty($result1['commonContent']['settings']['home_category']))
        {
            $categories_array = explode(',',$result1['commonContent']['settings']['home_category']);
            $index = 0;
            foreach($categories_array as $item){
                
                //get category section detail
                $category = $products->getCategorybyId($item);
                if($category){
                    $category_section[$index] = $category;
                   
                        $data = array('page_number' => '0', 'categories_id'=>$category->categories_id, 'type' => '', 'limit' => 8, 'min_price' => '', 'max_price' => '');
                    
                    $single_product = $products->products($data);
                    $category_section[$index]->products = $single_product;
                    $index++;
                }
            }
            
        }
        $result1['category_section'] = $category_section;
    


        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode(',',$options);
            $filters['option_value'] = implode(',',$option_values);

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result1['filter_attribute']['options'] = $options;
            $result1['filter_attribute']['option_values'] = $option_values;
        }

        $brand = '';

        if(isset($request->brand)){
            $brand = $request->brand;
        }
        $data1111 = array('check' => 1,'page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price,'brand' => $brand);

            

        $products1 = $products->products_check($data1111);  
        // print_r($products);die();      
        $result1['products'] = $products1;
       

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $products->filters($data);
        $result1['filters'] = $filters;

        $cart = '';
        $result['cartArray'] = $products->cartIdArray($cart);

        if ($limit > $result1['products']['total_record']) {
            $result1['limit'] = $result1['products']['total_record'];
        } else {
            $result1['limit'] = $limit;
        }

       

        //liked products
        $result1['liked_products'] = $products->likedProducts();
        $result1['categories'] = $products->categories();

        $result1['min_price'] = $min_price;
        $result1['max_price'] = $max_price;


        $recent_arrivals = (string) View::make('web.recent_arrival.recent_arrival12', ['result' => $result ,'result1' => $result1])->render();            

        return $recent_arrivals;
    }

}
