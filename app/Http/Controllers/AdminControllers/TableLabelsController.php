<?php
namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use DB;
//for password encryption or hash protected
use Illuminate\Http\Request;

//for authenitcate login data
use Lang;
use Mail;
use App\Models\Core\Setting;

//for requesting a value

class TableLabelsController extends Controller
{
	public function __construct(Setting $setting)
    {
        $this->Setting = $setting;
    }

    //listingAppLabels
    public function listingTableLabels(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.ListingLabels"));

        $language_id = '1';

        $result = array();
        $message = array();

        $labels = DB::table('table_labels')
            ->leftJoin('table_label_value', 'table_label_value.label_id', '=', 'table_labels.label_id')
            ->where('language_id', '=', $language_id)
            ->paginate(20);

        $result['message'] = $message;
        $result['labels'] = $labels;  
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.qr.labels.listingAppleLabels", $title)->with('result', $result);

    }

    //addAppLabel
    public function manageTableLabel(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ManageLabel"));

        $result = array();
        $message = array();

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['languages'] = $myVar->getLanguages();

        $alllabels = DB::table('table_labels')->get();
        $totalRecord = count($alllabels);

        $rem = $totalRecord / 50;

        $arr = explode('.', trim($rem));

        if (is_float($rem)) {
            $numberVal = $arr[0];
            $numberVal += 1;
        } else {
            $numberVal = $arr[0];
        }

        $i = 1;
        $start = 0;
        $end = 49;
        $data = array();
        while ($i <= $numberVal) {
            $labels = DB::table('table_labels')->skip($start)->take(50)->orderby('label_id', 'ASC')->get();

            $myVal = array();
            $index = 0;
            foreach ($labels as $labels_data) {
                array_push($myVal, $labels_data);

                $values = DB::table('table_label_value')
                    ->Join('languages', 'languages.languages_id', '=', 'table_label_value.language_id')
                    ->select('languages.name', 'table_label_value.*')
                    ->where('label_id', '=', $labels_data->label_id)
                    ->orderBy('table_label_value.language_id', 'ASC')
                    ->get();

                $myVal[$index++]->values = $values;
            }
            $start += 50;
            $data[$i] = $myVal;
            $i++;
        }

        $result['labels'] = $data;  
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.qr.labels.manageAppLabel", $title)->with('result', $result);

    }

    //addAppKey
    public function addtablekey(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.AddKeyLabel"));

        $result = array();
        $message = array();  
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.qr.labels.addappkey", $title)->with('result', $result);

    }

    //addNewAppLabel
    public function addNewTableLabel(Request $request)
    {

        $label_name = $request->label_name;

        $checkExist = DB::table('table_labels')->where('label_name', '=', $label_name)->get();

        //get function from other controller
        $myVar = new SiteSettingController();
        $languages = $myVar->getLanguages();

        if (count($checkExist) > 0) {

            $message = Lang::get("labels.Labelkeyalreadyexist");
            return redirect()->back()->withErrors([$message]);

        } else {

            DB::table('table_labels')->insert([
                'label_name' => $request->label_name,
            ]);

            return redirect()->back()->with('message', Lang::get("labels.LabelkeyAddedMessage"));

        }

    }

    //editTaxClass
    public function editTableLabel(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditLabel"));

        $result = array();
        $message = array();

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['languages'] = $myVar->getLanguages();

        $labels = DB::table('table_labels')->get();
        $result['labels'] = $labels;

        $labels_value = DB::table('table_labels')
            ->leftJoin('table_label_value', 'table_label_value.label_id', '=', 'table_labels.label_id')
            ->where('table_labels.label_id', '=', $request->id)
            ->orderBy('table_label_value.label_id', 'ASC')
            ->get();

        $result['labels_value'] = $labels_value;  
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.settings.qr.labels.editAppLabel", $title)->with('result', $result);
    }

    //updateAppLabel
    public function updateTableLabel(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditLabel"));
        $last_modified = date('y-m-d h:i:s');

        $result = array();

        //get function from other controller
        $myVar = new SiteSettingController();
        $languages = $myVar->getLanguages();

        $labels = DB::table('table_labels')->get();

        foreach ($labels as $labels_data) {

            $label = 'label_id_' . $labels_data->label_id;
            $label_id = $request->$label;

            foreach ($languages as $languages_data) {

                $label_id = $request->$label;
                $label_value = 'label_value_' . $languages_data->languages_id . '_' . $label_id;

                $checkexist = DB::table('table_label_value')->where('label_id', '=', $label_id)->where('language_id', '=', $languages_data->languages_id)->get();

                if (count($checkexist) > 0) {
                    DB::table('table_label_value')
                        ->where('label_id', $label_id)
                        ->where('language_id', $languages_data->languages_id)
                        ->update([
                            'label_value' => $request->$label_value,
                        ]);
                } else {
                    DB::table('table_label_value')->insert([
                        'label_value' => $request->$label_value,
                        'label_id' => $label_id,
                        'language_id' => $languages_data->languages_id,
                    ]);
                }
            }

        }

        return redirect()->back()->with('message', Lang::get("labels.LabelkeyUpdatedMessage"));
    }

}
