<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Helpers\BaseService;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Module;
use App\Setting;
use App\SystemMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Constant;

class CompanyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index() {
        $title = __("Company List");

        return view('admin.Company.index', ['title' => $title]);
    }

    public function search (Request $request) {
        $value = $request['search']['value'];

        $start = (int)$request->get('start');
        $length = (int)$request->get('length');
        $fieldOrder = isset($request["columns"][$request["order"][0]["column"]]["name"]) ? $request["columns"][$request["order"][0]["column"]]["name"] : null;
        $orderType = isset($request["order"][0]["dir"]) ? $request["order"][0]["dir"] : null;

        $list = Company::orderBy($fieldOrder, $orderType)
            ->select(
                "companies.*"
            )
        ;

        if ($value) {
            $list = $list
                ->where('companies.code', 'like', "%$value%")
                ->orWhere('companies.name', 'like', "%$value%");
        }

        $recordsTotal = $list->count();
        if ($length) {
            $list = $list->skip($start)->take($length);
        }
        $list = $list->get();
        $results = $list->toArray();

        return json_encode([
            'data'              => $results,
            'recordsTotal'      => $recordsTotal ?? count($results),
            'recordsFiltered'   => $recordsTotal ?? count($results)
        ], JSON_NUMERIC_CHECK);
    }

    public function profile($page = null) {

        $page = $page ? $page : "general";

        $title = trans("Company profile");

        $company = Company::find(Constant::MASTER_COMPANY_ID)->toArray();

        $listModules = [];
        $setting = [];

        switch ($page){
            case 'modules':
                $listModules = Module::where('status', Constant::STATUS_ACTIVE)
                    ->get();
                break;
            case 'sns':
            case 'mailer':
                $setting = Setting::where('company_id', Constant::MASTER_COMPANY_ID)
                    ->first();
                if(!$setting){
                    $setting = new Setting();
                    $setting->company_id = Constant::MASTER_COMPANY_ID;
                    $setting->save();
                }
                break;
        }

        return view('Admin.Company.profile', [
            'company_id'    => Constant::MASTER_COMPANY_ID,
            'company'       => $company,
            'listModules'   => $listModules,
            'setting'       => $setting,
            'page'          => $page,
            'title'         => $title
        ]);
    }

    public function saveData(Request $request) {

        $data = $request->all();

        $id             = Constant::MASTER_COMPANY_ID;
        $subject        = isset($data['subject']) ? $data['subject'] : null;
        $phone_number   = isset($data['phone_number']) ? $data['phone_number'] : null;
        $email          = isset($data['email']) ? $data['email'] : null;
        $address        = isset($data['address']) ? $data['address'] : null;

        $status     = isset($data['status']) && $data['status'] == "on" ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $isContinue = isset($data['continue']) && $data['continue'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;

        $logo           = isset($data['logo']) ? $data['logo'] : [];
        $logoName       = $logo ? $logo->getClientOriginalName() : '';

        if(!empty($logoName)){
            $data['logo'] = $logoName;
        }

        unset($data['continue']);
        $data['status'] = $status;

        $object = new Company();
        $object = BaseService::renderObject($object, $data);

        if(!$object->save()) {
            return json_encode([
                'success'       => false,
                'message'       => __(SystemMessage::MESSAGE_SAVE_UNSUCCESSFULLY)
            ]);
        }

        $id = $object->id;
        if(
            !empty($logoName) &&
            isset($logo) &&
            $logo->getSize() > 0
        ){
            $path = public_path().'/uploads/'.$id.'/logo/';
            $logo->move($path, $logoName);
        }

        return json_encode([
            'success'       => true,
            'is_continue'   => $isContinue,
            'message'       => __(SystemMessage::MESSAGE_SAVE_SUCCESSFULLY)
        ]);

    }

    public function saveGeneral(Request $request) {

        $authUser = Auth::user();
        $authUserId = $authUser->id;

        $data       = $request->all();
        $id         = Constant::MASTER_COMPANY_ID;
        $name       = $data['name'] ?? null;
        $logo       = $data['logo'] ?? [];
        $photo      = $data['photo'] ?? [];
        $favicon    = $data['favicon'] ?? [];
        $birthday   = isset($data['birthday']) && $data['birthday'] ? BaseService::formatDate($data['birthday'], Constant::YMD) : '';
        $status     = isset($data['status']) && $data['status'] == "on" ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;


        if(empty($name)){
            return json_encode([
                'success'       => false,
                'message'       => __("Data required can not be null")
            ]);
        }

        $object = Company::find($id);

        if(!$object){
            return json_encode([
                'success'       => false,
                'message'       => __("Can not detect company information")
            ]);
        }

        $fileName = "";
        if($logo){
            $fileName   = "L_".time().".".$logo->getClientOriginalExtension();;
            $data['logo']  = $fileName;
        }

        $faviconName = "";
        if($favicon){
            $faviconName   = "F_".time().".".$favicon->getClientOriginalExtension();;
            $data['favicon']  = $faviconName;
        }

        $photoName = "";
        if($photo){
            $photoName   = "P_".time().".".$photo->getClientOriginalExtension();;
            $data['photo']  = $photoName;
        }

        unset($data['continue']);

        $data['id']         = $id;
        $data['status']     = $status;
        $data['birthday']     = $birthday;

        $object = BaseService::renderObject($object, $data);

        if(!$object->save()) {
            return json_encode([
                'success'       => false,
                'message'       => __("Save data failed")
            ]);
        }

        if($logo){
            $path = public_path()."/uploads/".$id.'/Logo/';
            $logo->move($path, $fileName);
        }

        if($favicon){
            $favPath = public_path()."/uploads/".$id.'/Favicon/';
            $favicon->move($favPath, $faviconName);
        }

        if($photoName){
            $photoPath = public_path()."/uploads/".$id."/Photo/";
            $photo->move($photoPath, $photoName);
        }
        return json_encode([
            'success'       => true,
            'id'            => $id,
            'message'       => __("Save data successfully")
        ]);


    }

    public function deletePicture($type) {

        $company = Company::all()->take(1)->toArray();
        $id         = $company[0]['id'];

        $favicon    = isset($company[0]['favicon']) ? $company[0]['favicon'] : '';
        $logo       = isset($company[0]['logo']) ? $company[0]['logo'] : '';
        $banner     = isset($company[0]['banner']) ? $company[0]['banner'] : '';
        $filePath   = "";

        switch($type){
            case 'logo':
                $filePath = public_path()."/uploads/company/logo/".$logo;
                break;
            case 'favicon':
                $filePath = public_path()."/uploads/company/favicon/".$favicon;
                break;
            case 'banner':
                $filePath = public_path()."/uploads/company/banner/".$banner;
                break;
        }

        if(empty($filePath)){
            return json_encode([
                "success"  => false,
            ]);
        }

        File::delete($filePath);
        $companyInfo = Company::find($id);
        $companyInfo[$type] = '';
        if($companyInfo->save()) {
            return json_encode([
                "success" => true
            ]);
        }

    }

    public function dashboard()
    {
        $title = trans("Dashboard");

        return view('Admin.Company.dashboard', compact('title'));
    }


    public function updateMailerSetting(Request $request) {


        $data = $request->all();

        $company_id = isset($data['company_id']) ? $data['company_id'] : -1;
        $host_mail = isset($data['host_mail']) ? $data['host_mail'] : null;
        $port_mail = isset($data['port_mail']) ? $data['port_mail'] : null;
        $username_mail = isset($data['username_mail']) ? $data['username_mail'] : null;
        $password_mail = isset($data['password_mail']) ? $data['password_mail'] : null;
        $transport_mail = isset($data['transport_mail']) ? $data['transport_mail'] : null;
        $encryption_mail    = isset($data['encryption_mail']) ? $data['encryption_mail'] : '';
        $driver_mail        = isset($data['driver_mail']) ? $data['driver_mail'] : '';
        $from_name_mail     = isset($data['from_name']) ? $data['from_name'] : '';
        $from_address_mail  = isset($data['from_address_mail']) ? $data['from_address_mail'] : '';
        if(
            empty($company_id) ||
            empty($host_mail) ||
            empty($port_mail) ||
            empty($username_mail) ||
            empty($password_mail)
        ){
            return json_encode([
                "success"  => false,
                "message"  => __(SystemMessage::MESSAGE_DATA_REQUIRED_IS_NULL)
            ]);
        }

        $object = Setting::where('company_id', $company_id)->first();

        if(!$object){
            $object = new Setting();
        }

        $object = BaseService::renderObject($object, $data);

        if($object->save()) {
            $smsSuccess = trans('Save change successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }

    }

    public function updateSNSSetting(Request $request) {


        $data = $request->all();

        $id = isset($data['id']) ? $data['id'] : -1;

        $object = Setting::where('id', $id)->first();

        if(!$object){
            return json_encode([
                "success"           => false,
                "message"             => __("Setting not found")
            ]);
        }

        $object = BaseService::renderObject($object, $data);

        if($object->save()) {
            $smsSuccess = trans('Save change successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }
        return json_encode([
            "success"           => false,
            "message"             => __("Save data failed")
        ]);
    }

    public function updateSocial(Request $request) {


        $data = $request->all();

        $id = isset($data['id']) ? $data['id'] : -1;

        $object = Company::where('id', $id)->first();

        if(!$object){
            return json_encode([
                "success"           => false,
                "message"             => __("Company not found")
            ]);
        }

        $object = BaseService::renderObject($object, $data);

        if($object->save()) {
            $smsSuccess = trans('Save change successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }
        return json_encode([
            "success"           => false,
            "message"             => __("Save data failed")
        ]);
    }

    public function sendTestMail(Request $request)
    {

        $data = $request->all();
        $email = isset($data['email']) ? trim($data['email']) : '';

        if (empty($email)) {
            return json_encode([
                "success" => false,
                "message" => __("Email not empty"),
            ]);
        }

        $data_email = [
            'to_email' => $email,
            'template' => "Elements.EmailTemplates.test_mail",
        ];
        BaseService::sendEmail($data_email);

        return json_encode([
            "success" => true,
            "message" => __("Mail was sent successfully"),
        ]);
    }

    public function returnPolicy() {
        $title = __("Return Policy");

        return view('Admin.Company.return_policy', ['title' => $title]);
    }

    public function privacyPolicy() {
        $title = __("Privacy Policy");

        return view('Admin.Company.privacy_policy', ['title' => $title]);
    }

    public function terms() {
        $title = __("Terms of Services");

        return view('Admin.Company.terms', ['title' => $title]);
    }

    public function savePrivacyPolicy(Request $request) {


        $data = $request->all();

        $privacy_policy = $data['privacy_policy'] ?? "";

        $id = BaseService::getCompanyId();
        $object = Company::where('id', $id)->first();

        if(!$object){
            return json_encode([
                "success"           => false,
                "message"             => __("Company not found")
            ]);
        }

        $object->privacy_policy = $privacy_policy;

        if($object->save()) {
            $smsSuccess = trans('Save data successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }
        return json_encode([
            "success"           => false,
            "message"             => __("Save data failed")
        ]);
    }

    public function saveReturnPolicy(Request $request) {

        $data = $request->all();

        $return_policy = $data['return_policy'] ?? "";

        $id = BaseService::getCompanyId();
        $object = Company::where('id', $id)->first();

        if(!$object){
            return json_encode([
                "success"           => false,
                "message"             => __("Company not found")
            ]);
        }

        $object->return_policy = $return_policy;

        if($object->save()) {
            $smsSuccess = trans('Save data successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }
        return json_encode([
            "success"           => false,
            "message"             => __("Save data failed")
        ]);
    }

    public function saveTerms(Request $request) {


        $data = $request->all();

        $terms_of_services = $data['terms_of_services'] ?? "";

        $id = BaseService::getCompanyId();

        $object = Company::where('id', $id)->first();

        if(!$object){
            return json_encode([
                "success"           => false,
                "message"             => __("Company not found")
            ]);
        }

        $object->terms_of_services = $terms_of_services;

        if($object->save()) {
            $smsSuccess = trans('Save data successfully');
            return json_encode([
                "success"           => true,
                "message"             => $smsSuccess
            ]);
        }
        return json_encode([
            "success"           => false,
            "message"             => __("Save data failed")
        ]);
    }


}
