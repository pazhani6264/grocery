<?php
namespace App\Http\Controllers\App;

use Validator;
use Mail;
use DateTime;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon;
use App\Models\AppModels\Media;

class MediaController extends Controller
{
	 public function viewimage(Request $request)
	{
		$mediaResponse = Media::getimages($request);
		print $mediaResponse;
	}

	public function addGallery(Request $request)
	{
		$mediaResponse = Media::addimages($request);
		print $mediaResponse;
	}
}
?>