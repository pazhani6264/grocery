<?php
declare(strict_types=1);
namespace App\Http\Controllers\Web;

use App\Models\Web\Index;
use App\Models\Web\Ticket;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Session;
use Carbon\Carbon;

use Instagram\Api;
use Instagram\Exception\InstagramException;
use Psr\Cache\CacheException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

use GuzzleHttp\Client;


class InstagramController extends Controller
{
	public function __construct(
        Index $index
    ) {
        $this->index = $index;
    }
	public function instagram_feed(Request $request)
	{

        $client = new Client();
        $response = $client->request('GET', 'https://graph.instagram.com/me/media', [
            'query' => [
                'fields' => 'id,media_type,media_url,thumbnail_url,permalink',
                'access_token' => 'IGQVJVVWRhVGJ6VW81eFV3NFU4RTJmX2JMeVpLZAjZAQVC10YVY2YVNoQmg0SW03QmxsYWNwTl9qekhqdHQxQjZAxa3JGV1pLZAl9JQ29ldnNPU0ZAUbjJQUFlzTmdrNDRobWRhRXJNLWNDdUZA6WEsyS0NrNgZDZD',
                'limit' => 6,
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        $mediaData = $body['data'];

        
        $content='';

        $content .='<div class="row">';
        foreach ($mediaData as $media){
            $content .='<a href="'.$media['permalink'].'" target="_blank">';
            $content .='<img style="width:100px;height:100px;padding:10px" src="'.$media['media_url'].'" alt="Instagram Image">';
            $content .='</a>';
        }
        $content .='</div>';

        echo $content;

    //     require '../vendor/autoload.php';

    //     $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');

    //     try {
    //         $api = new Api($cachePool);
    //         //$api->login('sakthiajitha21@gmail.com', 'Ajitha@sakthi21');
    //         $api->login('ppl_cal_me_pubg_lvr', 'karthi');

    //         $profile = $api->getProfile($request->user_id);


    //         $folder_path = 'images/instafeed';
    
    //     // List of name of files inside
    //     // specified folder
    //     $files = glob($folder_path.'/*'); 
        
    //     // Deleting all the files in the list
    //     foreach($files as $file) {
    //         if(is_file($file)) 
    //             // Delete the given file
    //             unlink($file); 
    //     }
    //     DB::table('instagram')->truncate();

    //     $count = count($profile->getMedias());
    //     $newArray = array_slice($profile->getMedias(), 0, 8, true);
    //     foreach ($newArray as $media) {

    //         $url = $media->getThumbnailSrc();
    //         $img_name = $media->getShortcode().'.png';
    //         $img = 'images/instafeed/'.$img_name; 
    //         file_put_contents($img, file_get_contents($url));

    //         DB::table('instagram')->insert([
    //             'shortcode' => $media->getShortcode(),
    //             'user_id' => $media->getId(),
    //             'caption' => $media->getCaption(),
    //             'post_link' => $media->getLink(),
    //             'thumbnail' => $media->getThumbnailSrc(),
    //             'likes' => $media->getLikes(),
    //             'date' => $media->getDate()->format('Y-m-d h:i:s'),
    //         ]);

    //     }


    //     $content ='';
    //     $settings = $this->index->commonContent();
    //     $website_link = $settings['settings']['external_website_link'];
        

    //     $content .='<div class="row">';  
    //     $instafeed = DB::table('instagram')->limit(8)->get();
       
    //     if ($instafeed->isNotEmpty()) {
            
    //      foreach($instafeed as $insta)
    //      {
    //        $shortcode = $insta->shortcode;
    //        $img = $website_link.'images/instafeed/'. $shortcode . '.png';
    //        $post = "https://www.instagram.com/p/". $shortcode;
    //        $direct = "https://www.instagram.com/". $request->user_id;
       
    //         $content .='<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="padding:5px;">';$content .='<a href="'.$post.'" target="_blank" class="box box--image">';
    //         $content .='<div class="insta-img-outer">';
    //         $content .='<img style="width:100%;height:100%" src="'.$img .'" alt="'.$shortcode.'">';
    //         $content .='</div>';
    //         $content .='</a>';
    //         $content .='</div>';
        
    //    } 
    //    if ($count > 8) { 
    //     $content .='
    //       <div class="col-xl-12 text-center" style="padding:5px;">
    //       <a href="'.$direct.'" target="_blank" class="box box--image">
    //        <button class="btn btn-secondary" >Load More</button>
    //     </a>
    //     </div>'; 
          

    //     } }
    //     $content .='</div>';  

    //     echo $content;


            //print_r($profile);die();

            //$this->printMedias($profile->getMedias());

           /*  do {
                $profile = $api->getMoreMedias($profile);
                printMedias($profile->getMedias());

                // Or with profile id
                //$profile = $api->getMoreMediasWithProfileId(3504244670);
                //printMedias($profile->getMedias());

                // avoid 429 Rate limit from Instagram
                sleep(1);
            } while ($profile->hasMoreMedias()); */

        // } catch (InstagramException $e) {
        //     print_r($e->getMessage());
        // } catch (CacheException $e) {
        //     print_r($e->getMessage());
        // }
                
	}

   /*  function printMedias(array $medias)
    {
        $count = count($medias);
        $newArray = array_slice($medias, 0, 8, true);
        foreach ($newArray as $media) {
            echo 'ID        : ' . $media->getId() . "\n";
            echo 'Caption   : ' . $media->getCaption() . "\n";
            echo 'Link      : ' . $media->getLink() . "\n";
            echo 'thumbnail : ' . $media->getThumbnailSrc() . "\n";
            echo 'Likes     : ' . $media->getLikes() . "\n";
            echo 'Date      : ' . $media->getDate()->format('Y-m-d h:i:s') . "\n\n";
        }

        $content ='';
       
         foreach($newArray as $insta)
         {
           $direct = "https://www.instagram.com/sakthikutti";
       
            $content .='<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="padding:5px;">';$content .='<a href="'.$media->getLink().'" target="_blank" class="box box--image">';
            $content .='<div class="insta-img-outer">';
            $content .='<img style="width:100%;height:100%" src="'.$media->getThumbnailSrc().'" alt="'.$media->getId().'">';
            $content .='</div>';
            $content .='</a>';
            $content .='</div>';
        
       } 
       if ($count > 8) { 
        $content .='
          <div class="col-xl-12 text-center" style="padding:5px;">
          <a href="'.$direct.'" target="_blank" class="box box--image">
           <button class="btn btn-secondary" >Load More</button>
        </a>
        </div>'; 
          

        } 
        $content .='</div>';  

        echo $content;
    }
 */
	
}
?>