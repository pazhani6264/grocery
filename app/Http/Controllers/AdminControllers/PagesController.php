<?php

namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Core\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lang;
use Illuminate\Support\Facades\File;
use App\Models\Core\Setting;
use ZipArchive;
class PagesController extends Controller
{
    public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
        $this->varseting = new SiteSettingController($setting);
    }

    public function pages(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Pages"));
        $result = Pages::pages(); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.index", $title)->with('result', $result);

    }

    public function addpage(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $result = Pages::addpage(); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.add", $title)->with('result', $result);

    }

    public function addwebpagebuild(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $result = Pages::addwebpage($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.addwebpage", $title)->with('result', $result);
    }

    public function addwebpagebuilder(Request $request)
    {
        $page_id = $request->id;
        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $result = Pages::addpage(); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.addpagebuilder", $title)->with('result', $result)->with('page_id', $page_id);
    }
    

    public function addcontentpagebuilder(Request $request)
    {
        $result = Pages::updatecontent($request); 
        return redirect('admin/pages');
    }
   

    //addNewPagebuilder
    public function addnewpagebuilder(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $slug = str_replace(' ','-' ,trim($request->slug));
        $slug = str_replace('_','-' ,$slug);
        $checkSlug = DB::table('pages')->where('slug',$slug)->where('type',2)->first();
        if($checkSlug != '')
        {
            return redirect()->back()->with('warnerror', "Given slug Name already exists");
        }
        else
        {

        $page_id = Pages::addnewwebpagebuilder($request);
        $message = Lang::get("labels.PageAddedMessage");
        return redirect('admin/addwebpagebuilder/' . $page_id);
        }
      
    }

    //addNewPage
    public function addnewpage(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $slug = str_replace(' ','-' ,trim($request->slug));
        $slug = str_replace('_','-' ,$slug);
        $checkSlug = DB::table('pages')->where('slug',$slug)->where('type',1)->first();
        if($checkSlug != '')
        {
            return redirect()->back()->with('warnerror', "Given slug Name already exists");
        }
        else
        {
        Pages::addnewpage($request);
        $message = Lang::get("labels.PageAddedMessage");
        return redirect()->back()->withErrors([$message]);
        }
       

    }

    //editnew
    public function editpage(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditPage"));
        $result = Pages::editpage($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.edit", $title)->with('result', $result);

    }

    //updatePage
    public function updatepage(Request $request)
    {

        Pages::updatepage($request);
        $message = Lang::get("labels.PageUpdateMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //pageStatus
    public function pageStatus(Request $request)
    {
        Pages::pageStatus($request);
        return redirect()->back()->withErrors([Lang::get("labels.PageStatusMessage")]);
    }


    //pageStatus
    public function pagebuilderStatus(Request $request)
    {

        Pages::updatepageStatus($request);
        return redirect()->back()->withErrors('Pagebuilder status updated succesfully');

    }

    //zip pages

    public function zippageadd(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Pages"));
        $result = Pages::webpages($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.zippages.add", $title)->with('result', $result);

    }

    //zippageStatus
    public function zippageStatus(Request $request)
    {
        if(!empty($request->id)){
            if($request->active=='no'){
              $status = '0';
            }elseif($request->active=='yes'){
              $status = '1';
            }
            DB::table('zippages')->where('id', '=', $request->id)->update([
              'status'		 =>	  $status
              ]);
            }
        return redirect()->back()->withErrors([Lang::get("labels.PageStatusMessage")]);
    }


    public function deletezippages(Request $request)
    {
        $zippage = DB::table('zippages')->where('id', $request->id)->first();
        $newname = preg_replace('/\s+/', '_', $zippage->name);
        $path = public_path().'/' .  $newname;

        File::deleteDirectory($path);
            DB::table('zippages')->where('id', $request->id)->delete();
            return redirect()->back()->withErrors(['Pages has been deleted successfully!']);
    }

    //add zipage
    public function insertzippage(Request $request)
    {
 
        $name = $request->name;
        $newname = preg_replace('/\s+/', '_', $name);

        $checkName = DB::table('zippages')->where('name',$name)->where('status',1)->first();
        if($checkName != '')
        {
            return 'already';
        }
        else
        {
            $zipfile = $request->file('zippage');
           
            $extension = $zipfile->getClientOriginalExtension();
            if($extension == 'zip')
            {
                //$path = public_path().'/' . $name;
                $filename =  $newname . $extension;
                $directory = $newname;
                // make file path
                $destinationPath = public_path().'/' . $newname;
                $domain = request()->getHost();
                $ziplink = substr(strstr($destinationPath, '/var/www/vhosts/platinum24.net/'.$domain.'/'), strlen('/var/www/vhosts/platinum24.net/'.$domain.'/'));
                
                $zipName = $newname.'.'.$extension;

                $path = public_path().'/' . $newname;
                File::makeDirectory($path, $mode = 0777, true, true);
                // move zip file in path
                $zipfile->move($destinationPath,$zipName);


                // Define Dir Folder
                $public_dir=public_path();
                // Zip File Name
                $zipFileName = $zipfile->getClientOriginalName();
                // Create ZipArchive Obj
                $zip = new ZipArchive;
                if ($zip->open($path.'/' . $zipName, ZipArchive::CREATE) === TRUE) {
                    // Add File in ZipArchive
                    $zip->extractTo($newname);
                    $zip->close();
                    //unlink($path.'/' . $zipFileName); 

                    $linkname = $newname;

                    $date_added = date('Y-m-d h:i:s');

                    DB::table('zippages')->insert([
                        'name'  	     =>   $name,
                        'link'			 =>   $linkname,
                        'zip_download'	 =>   $ziplink.'/'.$zipName,
                        'created_at'     =>   $date_added,
                        'updated_at'     =>   $date_added
                    ]);
                    return 'success';
               
                } 
                else {
                        return 'failed';
                    } 

            }
            else
            {
                return 'notallowed';
            }
          
          
        }
    
    }



    public function zippageedit(Request $request,$id)
    {
        $title = array('pageTitle' => Lang::get("labels.Pages"));
        $result = Pages::webpages($request); 
        $zip = DB::table('zippages')->where('id','=',$id)->first();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.zippages.edit", $title)->with('result', $result)->with('zip', $zip);

    }

    
    public function editzippage(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $newname = preg_replace('/\s+/', '_', $name);

        $checkName = DB::table('zippages')->where('name',$name)->where('id','!=',$id)->where('status',1)->first();
        if($checkName != '')
        {
            return 'already';
        }
        else
        {
            $zipfile = $request->file('zippage');
           
            $extension = $zipfile->getClientOriginalExtension();
            if($extension == 'zip')
            {
                //$path = public_path().'/' . $name;
                $filename =  $newname . $extension;
                
                // make file path
                $destinationPath = public_path().'/' . $newname;
                $ziplink = substr(strstr($destinationPath, '/var/www/vhosts/platinum24.net/'.$domain.'/'), strlen('/var/www/vhosts/platinum24.net/'.$domain.'/'));

                $zip = DB::table('zippages')->where('id','=',$id)->first();
                $directory = public_path().'/' . $zip->link;
                File::deleteDirectory($directory);

                $zipName = $newname.'.'.$extension;

                $path = public_path().'/' . $newname;
                File::makeDirectory($path, $mode = 0777, true, true);
                // move zip file in path
                $zipfile->move($destinationPath,$zipName);


                // Define Dir Folder
                $public_dir=public_path();
                // Zip File Name
                $zipFileName = $zipfile->getClientOriginalName();
                // Create ZipArchive Obj
                $zip = new ZipArchive;
                if ($zip->open($path.'/' . $zipName, ZipArchive::CREATE) === TRUE) {
                    // Add File in ZipArchive
                    $zip->extractTo($newname);
                    $zip->close();
                    //unlink($path.'/' . $zipFileName); 

                    $linkname = $newname;

                    $date_added = date('Y-m-d h:i:s');

                    DB::table('zippages')->where('id','=',$id)->update([
                        'name'  	     =>   $name,
                        'link'			 =>   $linkname,
                        'zip_download'	 =>   $ziplink.'/'.$zipName,
                        'created_at'     =>   $date_added,
                        'updated_at'     =>   $date_added
                    ]);
                    return 'success';
               
                } 
                else {
                        return 'failed';
                    } 

            }
            else
            {
                return 'notallowed';
            }
          
          
        }
    
    }


    //listing web pages
    public function webpages(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Pages"));
        $result = Pages::webpages($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.webpages.index", $title)->with('result', $result);

    }

    public function addwebpage(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddPage"));
        $result = Pages::addwebpage($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.webpages.add", $title)->with('result', $result);

    }

    //addNewPage
    public function addnewwebpage(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPage"));

        $slug = str_replace(' ','-' ,trim($request->slug));
        $slug = str_replace('_','-' ,$slug);
        $checkSlug = DB::table('pages')->where('slug',$slug)->where('type',2)->first();
        if($checkSlug != '')
        {
            return redirect()->back()->with('warnerror', "Given slug Name already exists");
        }
        else
        {
        Pages::addnewwebpage($request);
        $message = Lang::get("labels.PageAddedMessage");
        return redirect()->back()->withErrors([$message]);
        }
      
    }

    public function checkSlug($currentSlug){
        $checkSlug = DB::table('pages')->where('slug',$currentSlug)->get();
        return $checkSlug;
      }
      

    //editnew
    public function editwebpage(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditPage"));
        $result = Pages::editwebpage($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.webpages.edit", $title)->with('result', $result);
    }

    //updatePage
    public function updatewebpage(Request $request)
    {
        Pages::updatewebpage($request);
        $message = Lang::get("labels.PageUpdateMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //pageStatus
    public function pageWebStatus(Request $request)
    {
        Pages::pageWebStatus($request);
        return redirect()->back()->withErrors([Lang::get("labels.PageStatusMessage")]);
    }

    //editnew
    public function editwebpagebuilder(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditPage"));
        $result = Pages::editwebpage($request); 
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pages.editwebpage", $title)->with('result', $result);
    }

     //editwebpagebuilder
     public function editnewwebpagebuilder(Request $request)
     {
         $title = array('pageTitle' => Lang::get("labels.AddPage"));
         $page_id = Pages::editnewwebpagebuilder($request);
         $message = Lang::get("labels.PageAddedMessage");
         return redirect('admin/editpagebuildcontent/' . $request->id);
       
     }

     public function editpagebuildcontent(Request $request)
     {
         $page_id = $request->id;
         $title = array('pageTitle' => Lang::get("labels.AddPage"));
         $result = Pages::addpage(); 
         $result['commonContent'] = $this->Setting->commonContent();
         return view("admin.pages.editwebpagebuilder", $title)->with('result', $result)->with('page_id', $page_id);
     }

       //deletePages
    public function deletepages(Request $request)
    {
        Pages::destroyrecord($request);
        return redirect()->back()->withErrors(['Pages has been deleted successfully!']);
    }

}
