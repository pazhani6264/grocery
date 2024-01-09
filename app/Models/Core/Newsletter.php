<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Newsletter extends Model
{
	public function paginator()
	{
		$newsletter = DB::table('newsletter')
	 	->leftJoin('newsletter_description','newsletter_description.newsletter_id', '=', 'newsletter.id')
	 	 ->LeftJoin('newsletter_description as parent_description', function ($join) {
                $join->on('parent_description.newsletter_id', '=', 'newsletter.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	  ->select('newsletter.id as id', 'newsletter.count as count',
              'newsletter.created_at as date_added',
             'newsletter_description.title as name','newsletter_description.description as description',
            'newsletter_description.language_id')
         
           ->where('newsletter_description.language_id', '1')
           ->groupby('newsletter.id')
           ->paginate(10);
           return ($newsletter);
	}

    
    public function detail($id)
    {
        $newsletter =  DB::table('newsletter_email_detail')->where('newsletter_id', $id)->get();
        return $newsletter;
    }


	public function insert($date_added){
        $newsletter = DB::table('newsletter')->insertGetId([
            'created_at' =>	  $date_added
        ]);
        return $newsletter;
    }

    public function insertearndescription($title,$newsletter_id,$languages_data_id, $descriptions,$domain,$api_key,$app_name,$order_email)
    {
        $date_added	= date('Y-m-d H:i:s');
    	$newsletter_id = DB::table('newsletter_description')->insertGetId([
            'newsletter_id'   =>   $newsletter_id,
            'language_id'      =>   $languages_data_id,
            'title'       => $title,
            'description' => $descriptions
        ]);

        if($newsletter_id) {
        $emailcheck = DB::table('newsletter_subscribe')->where('status', 1)->get();
        $i=0;
         
        foreach($emailcheck as $email_sub){
            $i++;
          
            $subject = $title;
            $MailData            = array();
            $api_key             = $api_key;
            $domain              = $domain;
            $MailData['from']    = $app_name. "<".$order_email.">";
            $MailData['to']      = $email_sub->email;
            $MailData['subject'] = $title;
            $MailData['html'] =  $descriptions;
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
            //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
            curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
            $resultss = curl_exec($ch);
            curl_close($ch);  
            //echo $resultss;
            //return $result;

        DB::table('newsletter_email_detail')->insertGetId([
                'newsletter_id'   =>   $newsletter_id,
                'email'      =>   $email_sub->email,
                'created_at'       => $date_added
                
            ]);
            DB::table('newsletter')->where('id', '=', $newsletter_id)
      ->update([
          'count' => $i
      ]);

        }
        
        }


    }


     public function filter($data){
     	$name = $data['FilterBy'];
      	$param = $data['parameter'];

      	switch ( $name ) {
      	   case 'Name':
      	   $newsletter = DB::table('newsletter')
	 	->leftJoin('newsletter_description','newsletter_description.newsletter_id', '=', 'newsletter.id')
	 	
	 	 ->LeftJoin('newsletter_description as parent_description', function ($join) {
                $join->on('parent_description.newsletter_id', '=', 'newsletter.id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })

	 	   ->select('newsletter.id as id',
              'newsletter.created_at as date_added',
             'newsletter_description.title as name','newsletter_description.description as description',
            'newsletter_description.language_id')
         
           ->where('newsletter_description.language_id', '1')
           ->where('newsletter_description.title', 'LIKE', '%' . $param . '%')
           ->groupby('newsletter.id')
           ->paginate(10);
           break;
          default:
          $newsletter = DB::table('newsletter')
          ->leftJoin('newsletter_description','newsletter_description.newsletter_id', '=', 'newsletter.id')
          
           ->LeftJoin('newsletter_description as parent_description', function ($join) {
                 $join->on('parent_description.newsletter_id', '=', 'newsletter.id')
                     ->where(function ($query) {
                         $query->where('parent_description.language_id', '=', 1)->limit(1);
                     });
             })
 
             ->select('newsletter.id as id',
               'newsletter.created_at as date_added',
              'newsletter_description.title as name','newsletter_description.description as description',
             'newsletter_description.language_id')
          
            ->where('newsletter_description.language_id', '1')
            ->groupby('newsletter.id')
            ->paginate(10);
           return ($newsletter);
          break;
      	}
      	return ($newsletter);
     }

     public function get_newsletter()
     {
        $newsletter = DB::table('newsletter')
        ->leftJoin('newsletter_description','newsletter_description.newsletter_id', '=', 'newsletter.id')
        
         ->LeftJoin('newsletter_description as parent_description', function ($join) {
               $join->on('parent_description.newsletter_id', '=', 'newsletter.id')
                   ->where(function ($query) {
                       $query->where('parent_description.language_id', '=', 1)->limit(1);
                   });
           })

           ->select('newsletter.id as id',
             'newsletter.created_at as date_added',
            'newsletter_description.title as name','newsletter_description.description as description',
           'newsletter_description.language_id')
        
          ->where('newsletter_description.language_id', '1')
          ->groupby('newsletter.id')
          ->get();
           return ($newsletter);
     }


     public function deleterecord($request){
        $newsletter_id = $request->id;

        DB::table('newsletter')->where('id', $newsletter_id)->delete();
        DB::table('newsletter_description')->where('newsletter_id', $newsletter_id)->delete();
        
        return "success";
    }

    
}
?>