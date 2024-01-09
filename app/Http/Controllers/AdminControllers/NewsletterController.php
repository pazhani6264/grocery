<?php
 namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\News;
use App\Models\Core\NewsCategory;
use App\Models\Core\Newsletter;
use App\Models\Core\Collection;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Lang;
class NewsletterController extends Controller
{
	public function __construct(Newsletter $newsletter,Images $images, Setting $setting)
    {
    	$this->Newsletter = $newsletter;
        $this->images = $images;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myalertsetting = new AlertController($setting);
        $this->Setting = $setting;

    }

    public function view(Request $request)
    {
    	$title = array('pageTitle' => Lang::get("labels.newsletter"));
    	$newsletter = $this->Newsletter->paginator();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.newsletter.view_newsletter", $title)->with('result', $result)->with('newsletter',$newsletter);
    }
	public function details($id)
    {
		
         $newsletter = $this->Newsletter->detail($id);
         return view("admin.newsletter.detail_newsletter")->with('data', $newsletter);
    }
	public function filter(Request $request)
    {
      $title = array('pageTitle' => Lang::get("labels.newsletter"));
      $newsletter = $this->Newsletter->filter($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.newsletter.view_newsletter", $title)->with(['newsletter'=> $newsletter, 'name'=> $request->FilterBy, 'param'=> $request->parameter])->with('result', $result);
    }
    public function add(Request $request)
    {
    	$allimage = $this->images->getimages();
    	$title = array('pageTitle' => Lang::get("labels.newsletter"));
    	$language_id = '1';
    	$result = array();
    	$result['languages'] = $this->myVarsetting->getLanguages();
    	$result['commonContent'] = $this->Setting->commonContent();
    	return view("admin.newsletter.add_newsletter", $title)->with('result', $result)->with('allimage', $allimage);
    }

    public function insert(Request $request)
    {
    	$date_added	= date('y-m-d h:i:s');
    	$result = array();
        $settings = $this->Setting->commonContent();

        $domain = $settings['setting']['mail_chimp_list_id'];
        $api_key = $settings['setting']['mail_chimp_api'];
		$app_name =$settings['setting']['app_name'];
		$order_email =$settings['setting']['order_email'];
		
    	//get function from other controller
        $languages = $this->myVarsetting->getLanguages(); 
        $newsletter_id = $this->Newsletter->insert($date_added);

        
        	$newsletterName= 'title';
        	$newsletterDescriptions= 'description';

        	$title = $request->$newsletterName;
        	$descriptions = $request->$newsletterDescriptions;
        	$languages_data_id = '1';
        		$subcatoger_des = $this->Newsletter->insertearndescription($title,$newsletter_id,$languages_data_id, $descriptions,$domain,$api_key,$app_name,$order_email);
        
        $message = Lang::get("labels.newsletter_insert");
        return redirect()->back()->withErrors([$message]);
    }

	public function delete(Request $request){
		$deletenewsletter = $this->Newsletter->deleterecord($request);
		$message = Lang::get("labels.NewsletterDeleteMessage");
		return redirect()->back()->withErrors([$message]);
	  }

  
}
?>