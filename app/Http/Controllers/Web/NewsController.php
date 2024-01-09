<?php

namespace App\Http\Controllers\Web;
//use Mail;
//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
//for Carbon a value
use Carbon;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Currency;
use App\Models\Web\News;

//email
use Illuminate\Support\Facades\Mail;
use Session;



class NewsController extends Controller
{

	public function __construct(
											Index $index,
											News $news,
											Languages $languages,
											Products $products,
											Currency $currency
											)
	{
		$this->index = $index;
		$this->news = $news;
		$this->languages = $languages;
		$this->products = $products;
		$this->currencies = $currency;
		$this->theme = new ThemeController();
	}

	//getNewsCategories
	public function getNewsCategories(){
		$data =	$this->news->getNewsCategories();
	}

	//news
	public function news(Request $request){

		$title = array('pageTitle' => Lang::get("website.News"));
		$final_theme = $this->theme->theme();
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		if(!empty($request->limit)){
			$limit = $request->limit;
		}else{
			$limit = 16;
		}

		if(!empty($request->type)){
			$type = $request->type;
		}else{
			$type = '';
		}

		//categories_id
		if(!empty($request->category) and $request->category!='all'){
			$category = $request->category;
			$categories = $this->news->getCategories($category);
			$categories_id = $categories[0]->categories_id;
			$categories_name = $categories[0]->categories_name;
		}else{
			$categories_id = '';
			$categories_name = '';
		}

		$data = array('page_number'=>0, 'type'=>$type, 'is_feature'=>'', 'limit'=>$limit, 'categories_id'=>$categories_id, 'load_news'=>0);
		$news =$this->news->getAllNews($data);
		$result['news'] = $news;

		if($limit > $result['news']['total_record']){
			$result['limit'] = $result['news']['total_record'];
		}else{
			$result['limit'] = $limit;
		}
		$result['categories_name'] = $categories_name;
		$result['categories_id'] = $categories_id;
		$result['news_categories'] = $this->news->getNewsCategories();
		return view("web.news", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}


	//loadMoreNews
	public function loadMoreNews(Request $request){

		if(!empty($request->page_number)){
			$page_number = $request->page_number;
		}else{
			$page_number = 0;
		}

		if(!empty($request->limit)){
			$limit = $request->limit;
		}else{
			$limit = 16;
		}

		if(!empty($request->type)){
			$type = $request->type;
		}else{
			$type = '';
		}


		//categories_id
		if(!empty($request->category_id) and $request->category_id!='all'){
			$categories_id = $request->category_id;
		}else{
			$categories_id = '';
		}

		$data = array('page_number'=>$page_number, 'type'=>$type, 'is_feature'=>'', 'limit'=>$limit, 'categories_id'=>$categories_id);
		$news =$this->news->getAllNews($data);
		$result['limit'] = $limit;
		$result['news'] = $news;

		return view("loadMoreNews")->with('result', $result);


	}

	//getAllNews



	//newsdetail
	public function newsdetail(Request $request){
		$title = array('pageTitle' => Lang::get("website.News Detail"));
		$final_theme = $this->theme->theme();
		$result = array();
		$result['commonContent'] = $this->index->commonContent();
		$news = $this->news->newsdetail($request);
		$result['news'] = $news;
		$result['categories'] = $this->products->categories();
		return view("web.news-detail", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);
	}
	


	//news
	public function newsdetailp24(Request $request){

		$title = array('pageTitle' => Lang::get("website.News"));
		$final_theme = $this->theme->theme();
		$result = array();
		$result['commonContent'] = $this->index->commonContent();

		if(!empty($request->limit)){
			$limit = $request->limit;
		}else{
			$limit = 16;
		}

		if(!empty($request->type)){
			$type = $request->type;
		}else{
			$type = '';
		}

		//categories_id
		if(!empty($request->category) and $request->category!='all'){
			$category = $request->category;
			$categories = $this->news->getCategories($category);
			$categories_id = $categories[0]->categories_id;
			$categories_name = $categories[0]->categories_name;
		}else{
			$categories_id = '';
			$categories_name = '';
		}

		$data = array('page_number'=>0, 'type'=>$type, 'is_feature'=>'', 'limit'=>$limit, 'categories_id'=>$categories_id, 'load_news'=>0);
		$news =$this->news->getAllNews($data);
		$result['news'] = $news;

		if($limit > $result['news']['total_record']){
			$result['limit'] = $result['news']['total_record'];
		}else{
			$result['limit'] = $limit;
		}
		$result['categories_name'] = $categories_name;
		$result['categories_id'] = $categories_id;
		$result['news_categories'] = $this->news->getNewsCategories();


		$newss = DB::table('news')
        ->leftjoin('news_description','news_description.news_id','=','news.news_id')
        ->leftjoin('news_to_news_categories','news_to_news_categories.news_id','=','news.news_id')
        ->leftjoin('news_categories','news_categories.categories_id','=','news_to_news_categories.categories_id')
        ->LeftJoin('image_categories', 'news.news_image', '=', 'image_categories.image_id')
        ->leftjoin('news_categories_description','news_categories_description.categories_id','=','news_categories.categories_id')
        ->where([
          ['news.news_slug','=',$request->slug],
          ['news_description.language_id','=',Session::get('language_id')],
          ['news_categories_description.language_id','=',Session::get('language_id')]
        ])
        ->select('news.*','news_description.*','image_categories.path as image', 'image_categories.path_type as image_path_type', 'news_categories_description.categories_name')
        ->groupBy('news.news_id')
        ->first();
		$result['newss'] = $newss;


		$newsid = DB::table('news')->where('news_slug',$request->slug)->first();
		$catid = DB::table('news_to_news_categories')->where('news_id',$newsid->news_id)->first();

		$result['catid'] = $catid->categories_id;
		$result['newsid'] = $newsid->news_id;

		return view("web.news-detail-p24", ['title' => $title,'final_theme' => $final_theme])->with('result', $result);

	}

}
