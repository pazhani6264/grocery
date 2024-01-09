<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;



class constantBanner extends Model
{
    //
    use Sortable;

    public function images(){
        return $this->belongsTo('App\Images');
    }

    public function image_category(){
        return $this->belongsTo('App\Image_category');
    }

    public $sortable = ['banners_id','banners_title','created_at'];

    public static function paginator($request){
        $result = array();
        $message = array();
        $result['message'] = '';
        $result['banners'] = array();
        if($request->bannerType){
                $search = '';
                

                $banner = DB::table('constant_banners')
                ->join('languages','languages.languages_id','=','constant_banners.languages_id')
                ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
                ->select('constant_banners.*','image_categories.path', 'image_categories.path_type', 'languages.name as language_name');
                
                
                if($request->bannerType == 'banner1'){
                    $banner ->where('type', '3')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '4')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '5')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner2'){
                    $banner ->where('type', '6')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '7')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '8')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '9')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner3'){
                    $banner ->where('type', '42')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '43')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '44')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '45')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner4'){
                    $banner ->where('type', '46')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '47')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '48')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '49')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner5'){
                    $banner ->where('type', '10')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '11')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '12')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '13')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '14')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner6'){
                    $banner ->where('type', '50')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '51')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '52')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '53')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '54')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner7'){
                    $banner ->where('type', '15')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '16')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '17')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '18')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner8'){
                    $banner ->where('type', '55')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '56')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '57')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '58')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner9'){
                    $banner ->where('type', '19')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '20')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner10'){
                    $banner ->where('type', '21')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '22')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '23')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '24')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner11'){
                    $banner ->where('type', '59')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '60')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '61')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '62')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner12'){
                    $banner ->where('type', '63')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '64')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '65')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '66')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner13'){
                    $banner ->where('type', '25')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '26')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '27')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '28')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '29')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner14'){
                    $banner ->where('type', '67')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '68')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '69')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '70')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '71')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner15'){
                    $banner ->where('type', '72')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '73')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '74')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '75')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '76')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner16'){
                    $banner ->where('type', '30')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '31')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '32')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner17'){
                    $banner ->where('type', '77')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '78')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '79')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner18'){
                    $banner ->where('type', '33')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '34')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '35')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '36')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '37')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '38')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner19'){
                    $banner ->where('type', '80')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '81')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '82')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '124')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '125')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '126')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner20'){
                    $banner ->where('type', '129')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '130')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '131')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '132')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner22'){
                    $banner ->where('type', '133')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '134')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '135')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner23'){
                    $banner ->where('type', '136')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '137')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner24'){
                    $banner ->where('type', '138')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '139')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '140')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '141')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '142')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner25'){
                    $banner ->where('type', '143')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '144')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '145')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner26'){
                    $banner ->where('type', '146')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '147')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '148')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '149')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner27'){
                    $banner ->where('type', '150')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '151')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '152')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '153')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner28'){
                    $banner ->where('type', '154')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '155')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '156')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner29'){
                    $banner ->where('type', '157')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '158')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '159')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '160')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '161')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner30'){
                    $banner ->where('type', '162')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '163')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '164')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '165')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner31'){
                    $banner ->where('type', '166')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '167')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '168')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner32'){
                    $banner ->where('type', '169')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '170')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '171')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '172')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '173')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner33'){
                    $banner ->where('type', '174')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '175')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '176')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '177')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner34'){
                    $banner ->where('type', '193')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '194')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner35'){
                    $banner ->where('type', '195')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '196')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '197')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '198')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner36'){
                    $banner ->where('type', '199')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '200')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '201')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '202')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '203')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '204')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner37'){
                    $banner ->where('type', '205')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '206')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '207')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner38'){
                    $banner ->where('type', '208')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '209')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '210')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'banner39'){
                    $banner ->where('type', '212')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '213')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '214')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '215')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rightsliderbanner'){
                    $banner ->where('type', '1')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '2')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }     
                
                if($request->bannerType == 'leftsliderbanner'){
                    $banner ->where('type', '127')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '128')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    


                
                if($request->bannerType == 'sliderbanner1thumbs'){
                    $banner ->where('type', '178')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    

                if($request->bannerType == 'sliderbanner2thumbs'){
                    $banner ->where('type', '180')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '181')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                
                if($request->bannerType == 'sliderbanner3thumbs'){
                    $banner ->where('type', '182')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '183')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '184')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                

                if($request->bannerType == 'sliderbanner3bottomthumbs'){
                    $banner ->where('type', '185')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '186')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '187')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  


                if($request->bannerType == 'sliderbanner3bottomthumbs1'){
                    $banner ->where('type', '188')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '189')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '190')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  

                if($request->bannerType == 'carousal19rightthumbs'){
                    $banner ->where('type', '191')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '192')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'flash1'){
                    $banner ->where('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tp1'){
                    $banner ->where('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'banner40'){
                    $banner ->where('type', '217')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '218')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '219')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner41'){
                    $banner ->where('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'sp1'){
                    $banner ->where('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner43'){
                    $banner ->where('type', '222')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner44'){
                    $banner ->where('type', '223')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '224')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner45'){
                    $banner ->where('type', '225')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '226')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner46'){
                    $banner ->where('type', '227')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '228')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '229')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner47'){
                    $banner ->where('type', '230')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '231')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner48'){
                    $banner ->where('type', '232')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '233')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '234')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner49'){
                    $banner ->where('type', '235')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '236')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '237')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner50'){
                    $banner ->where('type', '238')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '239')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner51'){
                    $banner ->where('type', '240')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '241')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '242')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner52'){
                    $banner ->where('type', '243')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '244')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo15'){
                    $banner ->where('type', '245')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo15'){
                    $banner ->where('type', '246')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo15'){
                    $banner ->where('type', '247')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topselldemo15'){
                    $banner ->where('type', '248')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner53'){
                    $banner ->where('type', '249')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner1'){
                    $banner ->where('type', '250')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner2'){
                    $banner ->where('type', '251')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner54'){
                    $banner ->where('type', '252')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '253')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '254')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '255')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent16banner'){
                    $banner ->where('type', '256')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner55'){
                    $banner ->where('type', '257')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '258')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '259')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '260')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '261')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner56'){
                    $banner ->where('type', '262')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '263')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '264')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner57'){
                    $banner ->where('type', '265')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '266')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '267')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '268')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner58'){
                    $banner ->where('type', '269')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '270')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '271')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent18banner'){
                    $banner ->where('type', '272')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '273')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo21'){
                    $banner ->where('type', '274')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner59'){
                    $banner ->where('type', '275')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '276')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner60'){
                    $banner ->where('type', '277')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '278')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '279')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo23'){
                    $banner ->where('type', '280')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo23'){
                    $banner ->where('type', '281')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner61'){
                    $banner ->where('type', '282')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '283')
                    ->where('constant_banners.languages_id', $request->languages_id) 
                    ->orwhere('type', '284')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner62'){
                    $banner ->where('type', '285')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '286')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '287')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '288')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '289')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner63'){
                    $banner ->where('type', '290')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '291')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '292')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '293')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner64'){
                    $banner ->where('type', '294')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo25'){
                    $banner ->where('type', '295')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '296')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner65'){
                    $banner ->where('type', '297')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '298')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'tabdemo22'){
                    $banner ->where('type', '299')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo26'){
                    $banner ->where('type', '300')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo26'){
                    $banner ->where('type', '301')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner66'){
                    $banner ->where('type', '302')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo27'){
                    $banner ->where('type', '303')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo27'){
                    $banner ->where('type', '304')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner67'){
                    $banner ->where('type', '305')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '306')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner68'){
                    $banner ->where('type', '307')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner69'){
                    $banner ->where('type', '308')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '309')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '310')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner70'){
                    $banner ->where('type', '311')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner71'){
                    $banner ->where('type', '312')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '313')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '314')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner72'){
                    $banner ->where('type', '315')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '316')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner73'){
                    $banner ->where('type', '317')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '318')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '319')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner74'){
                    $banner ->where('type', '320')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '321')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spoffdemo14'){
                    $banner ->where('type', '322')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo14'){
                    $banner ->where('type', '323')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo14'){
                    $banner ->where('type', '324')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo14'){
                    $banner ->where('type', '325')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo14'){
                    $banner ->where('type', '326')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo9'){
                    $banner ->where('type', '327')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo9'){
                    $banner ->where('type', '328')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                $banners = $banner->groupBy('constant_banners.banners_id')
                ->orderBy('constant_banners.banners_id','ASC')
                ->get();

            $result['message'] = $message;
            $result['banners'] = $banners;
                    
        }
        return $result;
    }

    public static function paginatortwo($request){
        $result = array();
        $message = array();
        $result['message'] = '';
        $result['banners'] = array();
        if($request->bannerType){
                $search = '';
                

                $banner = DB::table('constant_banners_two as constant_banners')
                ->join('languages','languages.languages_id','=','constant_banners.languages_id')
                ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
                ->select('constant_banners.*','image_categories.path', 'image_categories.path_type', 'languages.name as language_name');
                
                
                if($request->bannerType == 'banner1'){
                    $banner ->where('type', '3')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '4')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '5')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner2'){
                    $banner ->where('type', '6')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '7')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '8')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '9')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner3'){
                    $banner ->where('type', '42')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '43')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '44')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '45')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner4'){
                    $banner ->where('type', '46')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '47')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '48')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '49')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner5'){
                    $banner ->where('type', '10')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '11')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '12')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '13')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '14')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner6'){
                    $banner ->where('type', '50')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '51')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '52')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '53')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '54')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner7'){
                    $banner ->where('type', '15')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '16')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '17')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '18')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner8'){
                    $banner ->where('type', '55')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '56')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '57')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '58')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner9'){
                    $banner ->where('type', '19')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '20')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner10'){
                    $banner ->where('type', '21')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '22')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '23')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '24')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner11'){
                    $banner ->where('type', '59')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '60')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '61')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '62')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner12'){
                    $banner ->where('type', '63')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '64')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '65')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '66')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner13'){
                    $banner ->where('type', '25')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '26')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '27')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '28')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '29')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner14'){
                    $banner ->where('type', '67')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '68')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '69')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '70')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '71')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner15'){
                    $banner ->where('type', '72')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '73')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '74')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '75')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '76')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner16'){
                    $banner ->where('type', '30')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '31')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '32')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner17'){
                    $banner ->where('type', '77')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '78')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '79')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner18'){
                    $banner ->where('type', '33')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '34')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '35')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '36')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '37')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '38')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner19'){
                    $banner ->where('type', '80')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '81')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '82')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '124')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '125')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '126')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner20'){
                    $banner ->where('type', '129')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '130')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '131')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '132')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner22'){
                    $banner ->where('type', '133')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '134')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '135')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner23'){
                    $banner ->where('type', '136')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '137')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner24'){
                    $banner ->where('type', '138')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '139')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '140')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '141')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '142')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner25'){
                    $banner ->where('type', '143')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '144')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '145')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner26'){
                    $banner ->where('type', '146')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '147')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '148')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '149')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner27'){
                    $banner ->where('type', '150')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '151')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '152')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '153')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner28'){
                    $banner ->where('type', '154')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '155')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '156')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner29'){
                    $banner ->where('type', '157')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '158')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '159')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '160')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '161')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner30'){
                    $banner ->where('type', '162')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '163')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '164')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '165')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner31'){
                    $banner ->where('type', '166')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '167')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '168')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner32'){
                    $banner ->where('type', '169')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '170')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '171')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '172')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '173')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner33'){
                    $banner ->where('type', '174')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '175')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '176')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '177')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner34'){
                    $banner ->where('type', '193')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '194')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner35'){
                    $banner ->where('type', '195')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '196')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '197')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '198')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner36'){
                    $banner ->where('type', '199')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '200')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '201')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '202')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '203')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '204')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner37'){
                    $banner ->where('type', '205')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '206')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '207')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner38'){
                    $banner ->where('type', '208')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '209')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '210')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner39'){
                    $banner ->where('type', '212')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '213')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '214')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '215')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'rightsliderbanner'){
                    $banner ->where('type', '1')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '2')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }     
                
                if($request->bannerType == 'leftsliderbanner'){
                    $banner ->where('type', '127')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '128')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    


                
                if($request->bannerType == 'sliderbanner1thumbs'){
                    $banner ->where('type', '178')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    

                if($request->bannerType == 'sliderbanner2thumbs'){
                    $banner ->where('type', '180')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '181')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                
                if($request->bannerType == 'sliderbanner3thumbs'){
                    $banner ->where('type', '182')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '183')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '184')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                

                if($request->bannerType == 'sliderbanner3bottomthumbs'){
                    $banner ->where('type', '185')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '186')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '187')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  


                if($request->bannerType == 'sliderbanner3bottomthumbs1'){
                    $banner ->where('type', '188')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '189')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '190')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  

                if($request->bannerType == 'carousal19rightthumbs'){
                    $banner ->where('type', '191')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '192')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'flash1'){
                    $banner ->where('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tp1'){
                    $banner ->where('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'banner40'){
                    $banner ->where('type', '217')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '218')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '219')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner41'){
                    $banner ->where('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'sp1'){
                    $banner ->where('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner43'){
                    $banner ->where('type', '222')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner44'){
                    $banner ->where('type', '223')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '224')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner45'){
                    $banner ->where('type', '225')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '226')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner46'){
                    $banner ->where('type', '227')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '228')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '229')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'banner47'){
                    $banner ->where('type', '230')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '231')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner48'){
                    $banner ->where('type', '232')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '233')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '234')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner49'){
                    $banner ->where('type', '235')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '236')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '237')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner50'){
                    $banner ->where('type', '238')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '239')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner51'){
                    $banner ->where('type', '240')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '241')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '242')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner52'){
                    $banner ->where('type', '243')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '244')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo15'){
                    $banner ->where('type', '245')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo15'){
                    $banner ->where('type', '246')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo15'){
                    $banner ->where('type', '247')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topselldemo15'){
                    $banner ->where('type', '248')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner53'){
                    $banner ->where('type', '249')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner1'){
                    $banner ->where('type', '250')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner2'){
                    $banner ->where('type', '251')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner54'){
                    $banner ->where('type', '252')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '253')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '254')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '255')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent16banner'){
                    $banner ->where('type', '256')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner55'){
                    $banner ->where('type', '257')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '258')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '259')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '260')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '261')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner56'){
                    $banner ->where('type', '262')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '263')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '264')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner57'){
                    $banner ->where('type', '265')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '266')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '267')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '268')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner58'){
                    $banner ->where('type', '269')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '270')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '271')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent18banner'){
                    $banner ->where('type', '272')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '273')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo21'){
                    $banner ->where('type', '274')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner59'){
                    $banner ->where('type', '275')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '276')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner60'){
                    $banner ->where('type', '277')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '278')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '279')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'spdemo23'){
                    $banner ->where('type', '280')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo23'){
                    $banner ->where('type', '281')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner61'){
                    $banner ->where('type', '282')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '283')
                    ->where('constant_banners.languages_id', $request->languages_id) 
                    ->orwhere('type', '284')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner62'){
                    $banner ->where('type', '285')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '286')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '287')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '288')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '289')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner63'){
                    $banner ->where('type', '290')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '291')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '292')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '293')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner64'){
                    $banner ->where('type', '294')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo25'){
                    $banner ->where('type', '295')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '296')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner65'){
                    $banner ->where('type', '297')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '298')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tabdemo22'){
                    $banner ->where('type', '299')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo26'){
                    $banner ->where('type', '300')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo26'){
                    $banner ->where('type', '301')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner66'){
                    $banner ->where('type', '302')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo27'){
                    $banner ->where('type', '303')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo27'){
                    $banner ->where('type', '304')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner67'){
                    $banner ->where('type', '305')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '306')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner68'){
                    $banner ->where('type', '307')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner69'){
                    $banner ->where('type', '308')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '309')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '310')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner70'){
                    $banner ->where('type', '311')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner71'){
                    $banner ->where('type', '312')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '313')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '314')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner72'){
                    $banner ->where('type', '315')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '316')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner73'){
                    $banner ->where('type', '317')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '318')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '319')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner74'){
                    $banner ->where('type', '320')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '321')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spoffdemo14'){
                    $banner ->where('type', '322')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo14'){
                    $banner ->where('type', '323')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo14'){
                    $banner ->where('type', '324')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo14'){
                    $banner ->where('type', '325')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo14'){
                    $banner ->where('type', '326')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo9'){
                    $banner ->where('type', '327')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo9'){
                    $banner ->where('type', '328')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                $banners = $banner->groupBy('constant_banners.banners_id')
                ->orderBy('constant_banners.banners_id','ASC')
                ->get();

            $result['message'] = $message;
            $result['banners'] = $banners;
                    
        }
        return $result;
    }


    public static function paginatorthree($request){
        $result = array();
        $message = array();
        $result['message'] = '';
        $result['banners'] = array();
        if($request->bannerType){
                $search = '';
                

                $banner = DB::table('constant_banners_three as constant_banners')
                ->join('languages','languages.languages_id','=','constant_banners.languages_id')
                ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
                ->select('constant_banners.*','image_categories.path', 'image_categories.path_type', 'languages.name as language_name');
                
                
                if($request->bannerType == 'banner1'){
                    $banner ->where('type', '3')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '4')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '5')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner2'){
                    $banner ->where('type', '6')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '7')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '8')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '9')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner3'){
                    $banner ->where('type', '42')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '43')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '44')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '45')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner4'){
                    $banner ->where('type', '46')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '47')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '48')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '49')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner5'){
                    $banner ->where('type', '10')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '11')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '12')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '13')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '14')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner6'){
                    $banner ->where('type', '50')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '51')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '52')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '53')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '54')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner7'){
                    $banner ->where('type', '15')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '16')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '17')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '18')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner8'){
                    $banner ->where('type', '55')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '56')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '57')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '58')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner9'){
                    $banner ->where('type', '19')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '20')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner10'){
                    $banner ->where('type', '21')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '22')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '23')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '24')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner11'){
                    $banner ->where('type', '59')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '60')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '61')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '62')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner12'){
                    $banner ->where('type', '63')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '64')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '65')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '66')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner13'){
                    $banner ->where('type', '25')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '26')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '27')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '28')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '29')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner14'){
                    $banner ->where('type', '67')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '68')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '69')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '70')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '71')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner15'){
                    $banner ->where('type', '72')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '73')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '74')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '75')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '76')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner16'){
                    $banner ->where('type', '30')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '31')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '32')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner17'){
                    $banner ->where('type', '77')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '78')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '79')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner18'){
                    $banner ->where('type', '33')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '34')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '35')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '36')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '37')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '38')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner19'){
                    $banner ->where('type', '80')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '81')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '82')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '124')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '125')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '126')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner20'){
                    $banner ->where('type', '129')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '130')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '131')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '132')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner22'){
                    $banner ->where('type', '133')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '134')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '135')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner23'){
                    $banner ->where('type', '136')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '137')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner24'){
                    $banner ->where('type', '138')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '139')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '140')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '141')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '142')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner25'){
                    $banner ->where('type', '143')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '144')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '145')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner26'){
                    $banner ->where('type', '146')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '147')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '148')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '149')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner27'){
                    $banner ->where('type', '150')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '151')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '152')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '153')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner28'){
                    $banner ->where('type', '154')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '155')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '156')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner29'){
                    $banner ->where('type', '157')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '158')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '159')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '160')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '161')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner30'){
                    $banner ->where('type', '162')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '163')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '164')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '165')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner31'){
                    $banner ->where('type', '166')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '167')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '168')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner32'){
                    $banner ->where('type', '169')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '170')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '171')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '172')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '173')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner33'){
                    $banner ->where('type', '174')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '175')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '176')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '177')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                     if($request->bannerType == 'banner34'){
                    $banner ->where('type', '193')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '194')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner35'){
                    $banner ->where('type', '195')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '196')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '197')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '198')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner36'){
                    $banner ->where('type', '199')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '200')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '201')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '202')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '203')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '204')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner37'){
                    $banner ->where('type', '205')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '206')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '207')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner38'){
                    $banner ->where('type', '208')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '209')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '210')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner39'){
                    $banner ->where('type', '212')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '213')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '214')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '215')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'rightsliderbanner'){
                    $banner ->where('type', '1')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '2')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }     
                
                if($request->bannerType == 'leftsliderbanner'){
                    $banner ->where('type', '127')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '128')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    


                
                if($request->bannerType == 'sliderbanner1thumbs'){
                    $banner ->where('type', '178')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    

                if($request->bannerType == 'sliderbanner2thumbs'){
                    $banner ->where('type', '180')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '181')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                
                if($request->bannerType == 'sliderbanner3thumbs'){
                    $banner ->where('type', '182')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '183')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '184')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                

                if($request->bannerType == 'sliderbanner3bottomthumbs'){
                    $banner ->where('type', '185')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '186')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '187')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  


                if($request->bannerType == 'sliderbanner3bottomthumbs1'){
                    $banner ->where('type', '188')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '189')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '190')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  

                if($request->bannerType == 'carousal19rightthumbs'){
                    $banner ->where('type', '191')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '192')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'flash1'){
                    $banner ->where('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tp1'){
                    $banner ->where('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'banner40'){
                    $banner ->where('type', '217')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '218')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '219')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'banner41'){
                    $banner ->where('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'sp1'){
                    $banner ->where('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner43'){
                    $banner ->where('type', '222')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner44'){
                    $banner ->where('type', '223')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '224')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner45'){
                    $banner ->where('type', '225')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '226')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner46'){
                    $banner ->where('type', '227')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '228')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '229')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner47'){
                    $banner ->where('type', '230')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '231')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner48'){
                    $banner ->where('type', '232')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '233')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '234')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner49'){
                    $banner ->where('type', '235')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '236')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '237')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner50'){
                    $banner ->where('type', '238')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '239')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner51'){
                    $banner ->where('type', '240')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '241')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '242')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner52'){
                    $banner ->where('type', '243')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '244')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo15'){
                    $banner ->where('type', '245')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo15'){
                    $banner ->where('type', '246')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo15'){
                    $banner ->where('type', '247')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topselldemo15'){
                    $banner ->where('type', '248')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner53'){
                    $banner ->where('type', '249')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner1'){
                    $banner ->where('type', '250')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner2'){
                    $banner ->where('type', '251')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner54'){
                    $banner ->where('type', '252')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '253')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '254')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '255')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent16banner'){
                    $banner ->where('type', '256')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner55'){
                    $banner ->where('type', '257')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '258')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '259')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '260')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '261')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner56'){
                    $banner ->where('type', '262')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '263')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '264')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner57'){
                    $banner ->where('type', '265')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '266')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '267')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '268')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner58'){
                    $banner ->where('type', '269')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '270')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '271')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'recent18banner'){
                    $banner ->where('type', '272')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '273')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo21'){
                    $banner ->where('type', '274')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner59'){
                    $banner ->where('type', '275')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '276')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner60'){
                    $banner ->where('type', '277')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '278')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '279')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo23'){
                    $banner ->where('type', '280')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo23'){
                    $banner ->where('type', '281')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner61'){
                    $banner ->where('type', '282')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '283')
                    ->where('constant_banners.languages_id', $request->languages_id) 
                    ->orwhere('type', '284')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner62'){
                    $banner ->where('type', '285')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '286')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '287')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '288')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '289')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner63'){
                    $banner ->where('type', '290')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '291')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '292')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '293')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner64'){
                    $banner ->where('type', '294')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo25'){
                    $banner ->where('type', '295')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '296')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner65'){
                    $banner ->where('type', '297')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '298')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tabdemo22'){
                    $banner ->where('type', '299')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo26'){
                    $banner ->where('type', '300')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo26'){
                    $banner ->where('type', '301')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner66'){
                    $banner ->where('type', '302')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo27'){
                    $banner ->where('type', '303')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo27'){
                    $banner ->where('type', '304')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner67'){
                    $banner ->where('type', '305')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '306')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner68'){
                    $banner ->where('type', '307')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner69'){
                    $banner ->where('type', '308')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '309')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '310')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner70'){
                    $banner ->where('type', '311')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner71'){
                    $banner ->where('type', '312')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '313')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '314')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner72'){
                    $banner ->where('type', '315')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '316')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner73'){
                    $banner ->where('type', '317')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '318')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '319')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner74'){
                    $banner ->where('type', '320')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '321')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spoffdemo14'){
                    $banner ->where('type', '322')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo14'){
                    $banner ->where('type', '323')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo14'){
                    $banner ->where('type', '324')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo14'){
                    $banner ->where('type', '325')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo14'){
                    $banner ->where('type', '326')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo9'){
                    $banner ->where('type', '327')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo9'){
                    $banner ->where('type', '328')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                $banners = $banner->groupBy('constant_banners.banners_id')
                ->orderBy('constant_banners.banners_id','ASC')
                ->get();

            $result['message'] = $message;
            $result['banners'] = $banners;
                    
        }
        return $result;
    }


    public static function paginatorfour($request){
        $result = array();
        $message = array();
        $result['message'] = '';
        $result['banners'] = array();
        if($request->bannerType){
                $search = '';
                

                $banner = DB::table('constant_banners_four as constant_banners')
                ->join('languages','languages.languages_id','=','constant_banners.languages_id')
                ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
                ->select('constant_banners.*','image_categories.path', 'image_categories.path_type', 'languages.name as language_name');
                
                
                if($request->bannerType == 'banner1'){
                    $banner ->where('type', '3')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '4')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '5')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner2'){
                    $banner ->where('type', '6')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '7')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '8')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '9')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner3'){
                    $banner ->where('type', '42')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '43')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '44')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '45')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner4'){
                    $banner ->where('type', '46')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '47')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '48')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '49')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner5'){
                    $banner ->where('type', '10')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '11')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '12')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '13')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '14')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner6'){
                    $banner ->where('type', '50')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '51')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '52')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '53')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '54')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner7'){
                    $banner ->where('type', '15')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '16')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '17')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '18')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner8'){
                    $banner ->where('type', '55')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '56')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '57')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '58')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner9'){
                    $banner ->where('type', '19')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '20')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner10'){
                    $banner ->where('type', '21')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '22')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '23')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '24')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner11'){
                    $banner ->where('type', '59')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '60')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '61')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '62')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner12'){
                    $banner ->where('type', '63')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '64')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '65')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '66')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner13'){
                    $banner ->where('type', '25')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '26')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '27')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '28')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '29')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner14'){
                    $banner ->where('type', '67')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '68')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '69')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '70')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '71')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner15'){
                    $banner ->where('type', '72')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '73')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '74')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '75')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '76')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner16'){
                    $banner ->where('type', '30')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '31')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '32')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner17'){
                    $banner ->where('type', '77')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '78')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '79')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner18'){
                    $banner ->where('type', '33')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '34')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '35')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '36')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '37')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '38')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner19'){
                    $banner ->where('type', '80')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '81')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '82')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '124')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '125')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '126')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner20'){
                    $banner ->where('type', '129')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '130')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '131')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '132')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner22'){
                    $banner ->where('type', '133')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '134')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '135')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner23'){
                    $banner ->where('type', '136')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '137')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner24'){
                    $banner ->where('type', '138')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '139')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '140')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '141')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '142')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner25'){
                    $banner ->where('type', '143')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '144')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '145')
                    ->where('constant_banners.languages_id', $request->languages_id);
                    
                }

                if($request->bannerType == 'banner26'){
                    $banner ->where('type', '146')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '147')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '148')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '149')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner27'){
                    $banner ->where('type', '150')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '151')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '152')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '153')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner28'){
                    $banner ->where('type', '154')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '155')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '156')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner29'){
                    $banner ->where('type', '157')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '158')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '159')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '160')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '161')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner30'){
                    $banner ->where('type', '162')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '163')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '164')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '165')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner31'){
                    $banner ->where('type', '166')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '167')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '168')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner32'){
                    $banner ->where('type', '169')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '170')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '171')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '172')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '173')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner33'){
                    $banner ->where('type', '174')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '175')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '176')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '177')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner34'){
                    $banner ->where('type', '193')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '194')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner35'){
                    $banner ->where('type', '195')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '196')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '197')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '198')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner36'){
                    $banner ->where('type', '199')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '200')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '201')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '202')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '203')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '204')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner37'){
                    $banner ->where('type', '205')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '206')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '207')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner38'){
                    $banner ->where('type', '208')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '209')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '210')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner39'){
                    $banner ->where('type', '212')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '213')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '214')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '215')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'rightsliderbanner'){
                    $banner ->where('type', '1')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '2')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }     
                
                if($request->bannerType == 'leftsliderbanner'){
                    $banner ->where('type', '127')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '128')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    


                
                if($request->bannerType == 'sliderbanner1thumbs'){
                    $banner ->where('type', '178')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }    

                if($request->bannerType == 'sliderbanner2thumbs'){
                    $banner ->where('type', '180')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '181')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                
                if($request->bannerType == 'sliderbanner3thumbs'){
                    $banner ->where('type', '182')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '183')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '184')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  
                

                if($request->bannerType == 'sliderbanner3bottomthumbs'){
                    $banner ->where('type', '185')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '186')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '187')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  


                if($request->bannerType == 'sliderbanner3bottomthumbs1'){
                    $banner ->where('type', '188')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '189')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '190')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }  

                if($request->bannerType == 'carousal19rightthumbs'){
                    $banner ->where('type', '191')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '192')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'flash1'){
                    $banner ->where('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '211')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tp1'){
                    $banner ->where('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '216')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                

                if($request->bannerType == 'banner40'){
                    $banner ->where('type', '217')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '218')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '219')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner41'){
                    $banner ->where('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '220')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'sp1'){
                    $banner ->where('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '221')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'banner43'){
                    $banner ->where('type', '222')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner44'){
                    $banner ->where('type', '223')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '224')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner45'){
                    $banner ->where('type', '225')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '226')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                if($request->bannerType == 'banner46'){
                    $banner ->where('type', '227')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '228')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '229')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner47'){
                    $banner ->where('type', '230')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '231')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner48'){
                    $banner ->where('type', '232')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '233')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '234')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'banner49'){
                    $banner ->where('type', '235')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '236')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '237')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner50'){
                    $banner ->where('type', '238')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '239')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner51'){
                    $banner ->where('type', '240')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '241')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '242')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner52'){
                    $banner ->where('type', '243')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '244')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'tpdemo15'){
                    $banner ->where('type', '245')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo15'){
                    $banner ->where('type', '246')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo15'){
                    $banner ->where('type', '247')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topselldemo15'){
                    $banner ->where('type', '248')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner53'){
                    $banner ->where('type', '249')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'topsell7_banner1'){
                    $banner ->where('type', '250')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topsell7_banner2'){
                    $banner ->where('type', '251')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner54'){
                    $banner ->where('type', '252')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '253')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '254')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '255')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'recent16banner'){
                    $banner ->where('type', '256')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'banner55'){
                    $banner ->where('type', '257')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '258')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '259')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '260')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '261')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner56'){
                    $banner ->where('type', '262')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '263')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '264')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner57'){
                    $banner ->where('type', '265')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '266')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '267')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '268')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner58'){
                    $banner ->where('type', '269')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '270')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '271')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'recent18banner'){
                    $banner ->where('type', '272')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '273')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo21'){
                    $banner ->where('type', '274')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner59'){
                    $banner ->where('type', '275')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '276')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner60'){
                    $banner ->where('type', '277')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '278')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '279')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }


                if($request->bannerType == 'spdemo23'){
                    $banner ->where('type', '280')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo23'){
                    $banner ->where('type', '281')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner61'){
                    $banner ->where('type', '282')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '283')
                    ->where('constant_banners.languages_id', $request->languages_id) 
                    ->orwhere('type', '284')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner62'){
                    $banner ->where('type', '285')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '286')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '287')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '288')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '289')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner63'){
                    $banner ->where('type', '290')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '291')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '292')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '293')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner64'){
                    $banner ->where('type', '294')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo25'){
                    $banner ->where('type', '295')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '296')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner65'){
                    $banner ->where('type', '297')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '298')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tabdemo22'){
                    $banner ->where('type', '299')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo26'){
                    $banner ->where('type', '300')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo26'){
                    $banner ->where('type', '301')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner66'){
                    $banner ->where('type', '302')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo27'){
                    $banner ->where('type', '303')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo27'){
                    $banner ->where('type', '304')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner67'){
                    $banner ->where('type', '305')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '306')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner68'){
                    $banner ->where('type', '307')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner69'){
                    $banner ->where('type', '308')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '309')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '310')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner70'){
                    $banner ->where('type', '311')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner71'){
                    $banner ->where('type', '312')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '313')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '314')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner72'){
                    $banner ->where('type', '315')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '316')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }
                
                if($request->bannerType == 'banner73'){
                    $banner ->where('type', '317')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '318')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '319')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'banner74'){
                    $banner ->where('type', '320')
                    ->where('constant_banners.languages_id', $request->languages_id)
                    ->orwhere('type', '321')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spoffdemo14'){
                    $banner ->where('type', '322')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'nademo14'){
                    $banner ->where('type', '323')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'topdemo14'){
                    $banner ->where('type', '324')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo14'){
                    $banner ->where('type', '325')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'tpdemo14'){
                    $banner ->where('type', '326')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'spdemo9'){
                    $banner ->where('type', '327')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                if($request->bannerType == 'rademo9'){
                    $banner ->where('type', '328')
                    ->where('constant_banners.languages_id', $request->languages_id);
                }

                
                $banners = $banner->groupBy('constant_banners.banners_id')
                ->orderBy('constant_banners.banners_id','ASC')
                ->get();

            $result['message'] = $message;
            $result['banners'] = $banners;
                    
        }
        return $result;
    }


    public static function existbanner($request){
        $exist = DB::table('constant_banners')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->get();


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function insert($request){

        if($request->image_id){
            $uploadImage = $request->image_id;
        }else{
            $uploadImage = '';
        }
        DB::table('constant_banners')->insert([
                'banners_title'  		 =>   $request->type,
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'languages_id'			 =>	  $request->languages_id
                ]);
    }


    public static function edit($request){

        $banners = DB::table('constant_banners')
            ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
            ->where('banners_id', $request->id)
            ->select('constant_banners.*','image_categories.path','image_categories.path_type')
            ->groupBy('constant_banners.banners_id')
            ->get();

        return $banners;

    }

    public static function edittwo($request){

        $banners = DB::table('constant_banners_two as constant_banners')
            ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
            ->where('banners_id', $request->id)
            ->select('constant_banners.*','image_categories.path','image_categories.path_type')
            ->groupBy('constant_banners.banners_id')
            ->get();

        return $banners;

    }

    public static function editthree($request){

        $banners = DB::table('constant_banners_three as constant_banners')
            ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
            ->where('banners_id', $request->id)
            ->select('constant_banners.*','image_categories.path','image_categories.path_type')
            ->groupBy('constant_banners.banners_id')
            ->get();

        return $banners;

    }

    public static function editfour($request){

        $banners = DB::table('constant_banners_four as constant_banners')
            ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
            ->where('banners_id', $request->id)
            ->select('constant_banners.*','image_categories.path','image_categories.path_type')
            ->groupBy('constant_banners.banners_id')
            ->get();

        return $banners;

    }


    public static function existbannerforupdate($request){
        $exist = DB::table('constant_banners')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->where('banners_id','!=',$request->id)->get();

          


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function existbannerforupdatetwo($request){
        $exist = DB::table('constant_banners_two')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->where('banners_id','!=',$request->id)->get();

          


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function existbannerforupdatethree($request){
        $exist = DB::table('constant_banners_three')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->where('banners_id','!=',$request->id)->get();

          


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function existbannerforupdatefour($request){
        $exist = DB::table('constant_banners_four')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->where('banners_id','!=',$request->id)->get();

          


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function updatebanner($request){
        
        $type = $request->type;
        $title='';
        $description='';
        $description2='';
        $description3='';
        $description4='';
        $description5='';
        $name='';
        
        if (isset($request->title)) {
            $title = $request->title;
        }
        if (isset($request->description)) {
            $description = $request->description;
        }
        if (isset($request->description2)) {
            $description2 = $request->description2;
        }
        if (isset($request->description3)) {
            $description3 = $request->description3;
        }
        if (isset($request->description4)) {
            $description4 = $request->description4;
        }
        if (isset($request->description5)) {
            $description5 = $request->description5;
        }
        if (isset($request->name)) {
            $name = $request->name;
        }

		if($type=='category'){
			$banners_url = $request->categories_id;
		}else if($type=='product'){
			$banners_url = $request->products_id;
		}else{
			$banners_url = '';
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            DB::table('constant_banners')->where('banners_id', $request->id)->update([
                
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}else{
            DB::table('constant_banners')->where('banners_id', $request->id)->update([
              
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}
    }

   

    public static function updatebannertwo($request){

        $type = $request->type;
        $title='';
        $description='';
        $description2='';
        $description3='';
        $description4='';
        $description5='';
        $name='';
        
        if (isset($request->title)) {
            $title = $request->title;
        }
        if (isset($request->description)) {
            $description = $request->description;
        }
        if (isset($request->description2)) {
            $description2 = $request->description2;
        }
        if (isset($request->description3)) {
            $description3 = $request->description3;
        }
        if (isset($request->description4)) {
            $description4 = $request->description4;
        }
        if (isset($request->description5)) {
            $description5 = $request->description5;
        }
        if (isset($request->name)) {
            $name = $request->name;
        }

		if($type=='category'){
			$banners_url = $request->categories_id;
		}else if($type=='product'){
			$banners_url = $request->products_id;
		}else{
			$banners_url = '';
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            DB::table('constant_banners_two')->where('banners_id', $request->id)->update([
                
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}else{
            DB::table('constant_banners_two')->where('banners_id', $request->id)->update([
               
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}
    }

    

    public static function updatebannerthree($request){

        $type = $request->type;
        $title='';
        $description='';
        $description2='';
        $description3='';
        $description4='';
        $description5='';
        $name='';
        
        if (isset($request->title)) {
            $title = $request->title;
        }
        if (isset($request->description)) {
            $description = $request->description;
        }
        if (isset($request->description2)) {
            $description2 = $request->description2;
        }
        if (isset($request->description3)) {
            $description3 = $request->description3;
        }
        if (isset($request->description4)) {
            $description4 = $request->description4;
        }
        if (isset($request->description5)) {
            $description5 = $request->description5;
        }
        if (isset($request->name)) {
            $name = $request->name;
        }

		if($type=='category'){
			$banners_url = $request->categories_id;
		}else if($type=='product'){
			$banners_url = $request->products_id;
		}else{
			$banners_url = '';
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            DB::table('constant_banners_three')->where('banners_id', $request->id)->update([
              
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}else{
            DB::table('constant_banners_three')->where('banners_id', $request->id)->update([
              
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}
    }


    public static function updatebannerfour($request){

        $type = $request->type;
        $title='';
        $description='';
        $description2='';
        $description3='';
        $description4='';
        $description5='';
        $name='';
        
        if (isset($request->title)) {
            $title = $request->title;
        }
        if (isset($request->description)) {
            $description = $request->description;
        }
        if (isset($request->description2)) {
            $description2 = $request->description2;
        }
        if (isset($request->description3)) {
            $description3 = $request->description3;
        }
        if (isset($request->description4)) {
            $description4 = $request->description4;
        }
        if (isset($request->description5)) {
            $description5 = $request->description5;
        }
        if (isset($request->name)) {
            $name = $request->name;
        }

		if($type=='category'){
			$banners_url = $request->categories_id;
		}else if($type=='product'){
			$banners_url = $request->products_id;
		}else{
			$banners_url = '';
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            DB::table('constant_banners_four')->where('banners_id', $request->id)->update([
              
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}else{
            DB::table('constant_banners_four')->where('banners_id', $request->id)->update([
              
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'type'					 =>	  $request->type,
                'title'					 =>	  $title,
                'description'		     =>	  $description,
                'description2'		     =>	  $description2,
                'description3'		     =>	  $description3,
                'description4'		     =>	  $description4,
                'description5'		     =>	  $description5,
                'name'					 =>	  $name,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}
    }

    public static function deletebanners($request){
        DB::table('constant_banners')->where('banners_id', $request->banners_id)->delete();
    }

}
