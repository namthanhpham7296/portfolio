<?php
/**
 * Author: doannd
 * Date: 2020-02-17
 * Time: 10:38 AM
 */

namespace App\Helpers;

use App\Company;
use App\FunctionMenu;
use App\LoginLog;
use App\Mail\SendMail;
use App\RoleAccess;
use App\Setting;
use App\SiteSetting;
use App\SystemLog;
use App\User;
use App\Constant;
use App\UserLogonLog;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use InvalidArgumentException;
use function GuzzleHttp\Psr7\_caseless_remove;

class BaseService
{

    public static function writeLoginLog(){
        $authUser = Auth::user();
        $authUserId = $authUser->id;

        $data = [
            'user_id'   => $authUserId,
            'device'    => gethostname(),
            'browser'   => self::getBrowserName(),
            'source_ip' => self::getSourceIp(),
        ];

        $object = new LoginLog();

        $object = self::renderObject($object, $data);
        $object->save();

    }

    public static function formatDate($date, $format = Constant::YMD) {
        $dateTime = null;
        if (!empty($date)) {
            if ($date instanceof \DateTime) {
                $dateTime = clone $date;
            } else {
                $date = preg_replace('/(\.|-|\/)/', '-', $date);
                $dateTime = new \DateTime($date);
            }
        }

        return is_null($dateTime) ? null : $dateTime->format($format);
    }

    public static function verifyGRecaptcha($captcha){

        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".Constant::GOOGLE_SECRET_KEY."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        return $response['success'];
    }

    public static function formatDateFromExcel($data, $format = Constant::YMD) {
        $dateTime = ($data - 25569) * 86400;
        $dateTime = date($format, $dateTime);
        return $dateTime;
    }

    public static function compareDate($date, $dateCompare = null){
        if(empty($dateCompare)){
            $dateCompare = date('Y-m-d');
        }

        $date1	= date_create($date);
        $date2	= date_create($dateCompare);
        $diff	= date_diff($date1,$date2);

        return $diff;

    }

    public static function renderContractCode($company_id){

        $count_contract = Contract::where('company_id', $company_id)->count();

        $code = "HĐ".$company_id.date('dmY').$count_contract;


        return $code;

    }

    public static function reformatCheckValue($value = null){
        return $value == "on" ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
    }

    public static function formatPhoneNumber($phone) {
        $phone = str_replace('+84', '0', $phone);
        if(strlen($phone) == 9 || (strlen($phone) == 10 && substr($phone, 0, 1) != 0)) {
            $phone = '0'.$phone;
        }

        return $phone;
    }

    public static function isAllow($featureCode) {
        $auth = Auth::user();
        /*$roleId = $auth->role_id;

        // Check super admin
        if ($auth->is_admin == ROLE_SUPER_ADMIN) {
            return true;
        }

        $featureCode = PLUGIN_DEFAULT.".".$featureCode;

        $roleDetails = Permission::where('role_id', '=', "$roleId")
            ->where("code", '=', "$featureCode")
            ->where('status', '=', Constant::STATUS_ACTIVE)->first();

        return isset($roleDetails->_id) ? true : false;*/

        return true;
    }

    /**
     * Tạo chuỗi code ngẫu nhiên
     *
     * @param int $length
     * @return string
     */
    public static function generateRandomStr($length = 20) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function compareString($value_1, $value_2){

        $value_1 = trim(strtolower($value_1));
        $value_2 = trim(strtolower($value_2));

        return $value_1 == $value_2 ? 1 : 0;
    }

    public static function _curl($url, $data = [], $method = 'GET')
    {
        $curl = curl_init();

        $opts = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            )
        ];

        if ($method == 'POST') {
            $opts[CURLOPT_MAXREDIRS] = 10;
            $opts[CURLOPT_POSTFIELDS] = json_encode($data);
            $opts[CURLOPT_HTTPHEADER] =  array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            );
        }

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = [];
        $message = "";
        if ($err) {
            $message = "cURL Error #:" . $err;
        } else {
            $result = json_decode($response, true);
        }

        return [
            'success' => $result ? true : false,
            'message' => $message,
            'data'    => $result
        ];
    }

    public static function convertVi2En($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        return $str;
    }

    public static function formatSlug($str, $format = "-") {
        $str = self::convertVi2En($str);
        $str = preg_replace('/[^A-Za-z0-9\s]/', '', $str); // Removes special chars. '/[^A-Za-z0-9\-\s]/'
        $str = preg_replace('/\s\s+/', ' ', $str); // Remove more than one white-space

//        // Thêm dấu thời gian
//        $str .= " ". time();

        $str = str_replace(' ', $format, trim($str)); // Replaces all spaces with hyphens.
        return mb_strtolower($str, 'UTF-8');
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public static function distance2Coordinates($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return round($angle * $earthRadius, 2);
    }

    public static function getSourceIp()
    {
        return getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
                getenv('HTTP_X_FORWARDED')?:
                    getenv('HTTP_FORWARDED_FOR')?:
                        getenv('HTTP_FORWARDED')?:
                            getenv('REMOTE_ADDR');
    }

    public static function getSetting()
    {
        $setting = Setting::find(1);

        return $setting;
    }

    public static function notification($firebaseTokens, $title, $message, $click_action = null, array $pushData = null)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        // Get setting
        $setting = self::getSetting();

        $fields = self::getPostFields($firebaseTokens, $title, $message, $click_action, $pushData);

        $headers = [
            'Authorization: key='.$setting->server_key,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        try {

            $success = true;
            $result = curl_exec($ch);
            $message = "[TC] ".$message;

            if ($result === FALSE) {
                //die('FCM Send Error: ' . curl_error($ch));

                $success = false;
                $message = 'FCM Send Error: ' . curl_error($ch);
            }

        } catch (\Exception $e) {

            $success = false;
            $message = $e->getMessage();

        }

        curl_close($ch);

        return $success;
    }

    public static function getPostFields($regIds, $title, $message, $click_action, $data = array()) {

        if(is_array($regIds)) {

            $fields = [
                "registration_ids" => $regIds,
                //"data" => is_string($message) ? ['message' => $message] : $message,
                "priority" => "high",
                "notification" => [
                    "title" => $title,
                    "sound" => "default",
                    "body" => is_string($message) ? $message : $message,
                    "badge" => 1
                ]
            ];

        } else {

            $fields = [
                "to" => $regIds,
                "priority" => "high",
                "notification" => [
                    "title" => $title,
                    "sound" => "default",
                    "body" => is_string($message) ? $message : $message,
                    "badge" => 1
                ]
            ];

        }

        if($click_action != null && $click_action != '') {

            $fields["notification"]["click_action"] = $click_action;

        }

        if(!empty($data)) {

            $data['message'] = $message;

            $fields["data"] = $data;

        }

        return json_encode($fields, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    public static function arraySortBy($dataArr, $field, $type = SORT_DESC)
    {
        $arr = array();
        foreach ($dataArr as $key => $row)
        {
            $arr[$key] = $row[$field];
        }
        array_multisort($arr, $type, $dataArr);

        return $dataArr;
    }

    public static function getBrowserName()
    {
        $info = array();

        $info["Browser"] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

        return isset($info["Browser"]) ? $info["Browser"] : "";
    }

    public static function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public static function renderListData($list = []){

        if(!count($list)){
            return [];
        }

        $results = [];
        foreach ($list as $key => $item)
        {
            $data = $item->toArray();
            array_push($results, $data);
        }

        return $results;

    }

    public static function getMenuList($authUser, $moduleId){


        if(empty($moduleId)){return [];}

        $functions_access = $authUser->functions_access;
        $arr_functions_access = explode(',', $functions_access);

        $listMenu = FunctionMenu::orderBy('ordinal', 'asc')
            ->where('display', Constant::STATUS_ACTIVE)
            ->whereIn('id', $arr_functions_access)
            ->where('module_id', $moduleId)->get()->toArray();

        $listChildMenu = $listMenu;

        $list = [];
        foreach ($listMenu as $key => $item){

            $parentId   = $item['parent_id'];
            $id         = $item['id'];

            if($parentId){continue;}

            $listChild = [];
            foreach ($listChildMenu as $keyC => $child){
                if($child['parent_id'] == $id){
                    array_push($listChild, $child);
                    unset($listChildMenu[$keyC]);
                }
            }

            if($listChild) {
                $item['list_child'] = $listChild;

            }

            array_push($list, $item);
        }

        return $list;

    }


    public static function getMenuListByUser($authUser, $moduleId){


        if(!isset($authUser) || !isset($moduleId)){
            return [];
        }

        $is_admin = $authUser->is_admin;

        $functions_access = $authUser->functions_access;
        $arr_functions_access = explode(',', $functions_access);

        $listMenuBefore = FunctionMenu::orderBy('ordinal', 'asc')
            ->where('display', Constant::STATUS_ACTIVE)
            ->where('module_id', $moduleId);
        if($is_admin != Constant::MASTER_ADMIN && Constant::LIVE_MODE){
            $listMenuBefore = $listMenuBefore->whereIn('id', $arr_functions_access);
        }
        $listMenuBefore = $listMenuBefore->get()->toArray();

        $listParentId = [];
        foreach ($listMenuBefore as $menu){
            if(!$menu['parent_id']){continue;}
            if(!in_array($menu['parent_id'], $listParentId)){
                $listParentId[] = $menu['parent_id'];
            }
        }

        $arr_functions_access = array_merge($arr_functions_access, $listParentId);
        $listMenu = FunctionMenu::orderBy('ordinal', 'asc')
            ->where('display', Constant::STATUS_ACTIVE)
            ->where('module_id', $moduleId);

        if($is_admin != Constant::MASTER_ADMIN && Constant::LIVE_MODE){
            $listMenu = $listMenu->whereIn('id', $arr_functions_access);
        }
        $listMenu = $listMenu->get()->toArray();

//        pr($arr_functions_access);
//        pr($listMenu);

        $listChildMenu = $listMenu;

        $list = [];
        foreach ($listMenu as $key => $item){

            $parentId   = $item['parent_id'];
            $id         = $item['id'];

            if($parentId){continue;}

            $listChild = [];
            foreach ($listChildMenu as $keyC => $child){
                if($child['parent_id'] == $id){
                    array_push($listChild, $child);
                    unset($listChildMenu[$keyC]);
                }
            }

            if($listChild) {
                $item['list_child'] = $listChild;

            }

            array_push($list, $item);

        }

        return $list;

    }

    public static function getCurrentDomainName(){
        $domain_name = parse_url(request()->root())['host'];
        return $domain_name;

    }

    public static function getCurrentFunction(Request $request){

        $action = $request->route()->getActionName();

        $arrAction = explode('@', $action);
        $action = isset($arrAction[1]) ? $arrAction[1] : '';

        $prefix = $request->route()->getPrefix();
        $arrPrefix = explode('/', $prefix);
        $plugin = isset($arrPrefix[0]) ? $arrPrefix[0] : '';
        $controller = isset($arrPrefix[1]) ? $arrPrefix[1] : '';

        if(
            empty($action) ||
            empty($plugin) ||
            empty($controller)
        ){
            return [];
        }

        $conditions = [
            ['plugin', $plugin],
            ['controller', $controller],
            ['action', $action]
        ];


        $currentFunction = FunctionMenu::where($conditions)->first();

        return $currentFunction;

    }

    public static function activeMenu(Request $request){

        $listMenu = $request->session()->get('listMenu');

        $prefix = $request->route()->getPrefix();
        $arrPrefix = explode('/', $prefix);

        $action     = $request->route()->getActionMethod();
        $plugin     = isset($arrPrefix[0]) ? $arrPrefix[0] : '';
        $controller = isset($arrPrefix[1]) ? $arrPrefix[1] : '';

        $semi_parent_id = 0;
        $id = -1;
        $parent_id = -1;

        foreach ($listMenu as $key => $item){

            if(
                $item['plugin']     == $plugin &&
                $item['controller'] == $controller &&
                $item['action']     == $action
            ){

                $id = $item['id'];
                $parent_id = $item['parent_id'];
                $semi_parent_id = $item['semi_parent_id'];

                break;

            }
        }


        if($parent_id == 0 && $id != 0){
            return [
                'active_group'       => $id,
                'active_function'    => -1,
            ];
        }

        if($parent_id != 0 && $id != 0 && !$semi_parent_id){
            return [
                'active_group'       => $parent_id,
                'active_function'    => $id,
            ];
        }


        return [
            'active_group'       => $parent_id,
            'active_function'    => $semi_parent_id,
        ];

    }

    public static function getCurrentModuleId(Request $request){
        $prefix = $request->route()->getPrefix();
        $arrPrefix = explode('/', $prefix);
        $moduleId = 0;
        $plugin = isset($arrPrefix[0]) ? $arrPrefix[0] : '';

        switch ($plugin){
            case 'admin':
                $moduleId = 1;
                break;
            case 'ta_portal':
                $moduleId = 2;
                break;
        }
        return $moduleId;

    }

    public static function generateIconFile($mimeType) {
        $icon = "fas fa-file-image-o text-success";
        switch ($mimeType) {
            case "doc":
            case "docx":
                $icon = "fas fa-file-word text-primary";
                break;
            case "xls":
            case "xlsx":
                $icon = "fas fa-file-excel text-success";
                break;
            case "ppt":
            case "pptx":
                $icon = "fas fa-file-powerpoint text-danger";
                break;
            case "pdf":
                $icon = "fas fa-file-pdf text-warning";
                break;
        }
        return $icon;
    }

    public static function removeField($list, $field){

        $temp = [];

        foreach ($list as $key => $item){
            array_push($temp, $item[$field]);
        }

        return $temp;

    }

    public static function reformatDate($date){

        if($date == '' || $date == null || $date == '00-00-0000' || $date == '00/00/0000'){
            return '';
        }

        $arrDate = strpos($date, '/') ? explode('/', $date) : explode('-', $date);
        if(count($arrDate) != 3){
            return '';
        }

        $authUser = Auth::user();
        $lang_key = $authUser->lang_key;
        $lang_key = empty($lang_key) ? 'en' : $lang_key;

        if($lang_key == 'en'){
            return $arrDate[2].'-'.$arrDate[0].'-'.$arrDate[1];
        }

        return $arrDate[2].'-'.$arrDate[1].'-'.$arrDate[0];

    }

    public static function formatDateTime($date, $style){
        return date($style, strtotime($date));
    }

    public static function deleteDir($dirPath) {
        if (is_dir($dirPath)) {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            $files = glob($dirPath . '*', GLOB_MARK);
            foreach ($files as $file) {
                if (is_dir($file)) {
                    self::deleteDir($file);
                } else {
                    unlink($file);
                }
            }
            rmdir($dirPath);
        }
        return 1;
    }



    public static function getCompanyId(){

        $authUser = Auth::user();

        if(!$authUser){
            return Constant::MASTER_COMPANY_ID;
        }

        $company_id = $authUser->company_id;
        return $company_id;

    }

    public static function getSiteSetting(){

        $object = SiteSetting::find(1);
        return $object;

    }

    public static function compareValue($listData, $value, $compareField = null, $returnField = null){

        $compareField   = !empty($compareField) ? $compareField : 'code';
        $returnField    = !empty($returnField) ? $returnField : 'id';

        foreach ($listData as $key => $item){
            if(trim($item[$compareField]) == $value){
                return $item[$returnField];
            }
        }

        return null;
    }

    public static function buildTreeMaster($listData, $pId = -1, $is_convert_node = true) {
        $arr = [];

        foreach ($listData as $key => $item) {

            $id 		= $item['id'];
            $parentId 	= $item['parent_id'];
            $name 		= $item['name'];

            $data = [
                'id' 		=> $id,
                'parent_id' => $parentId,
                'parent' 	=> $parentId,
                'name' 		=> $name,
                'data' 		=> $item,
            ];

            array_push($arr, $data);
        }

        $data = self::buildMenuTree($arr, $pId);
        if(!$is_convert_node) {
            return $data;
        }

        $list = [];

        if (count($data) > 0 && $is_convert_node) {

            foreach ($data as $key => $item) {
                $node = self::convertTreeNode($item);
                $list[] = $node;
            }
        }
        return $list;
    }

    public static function buildMenuTree($arr, $pid = -1, $level = 1) {
        $resp = array();
        if ($pid != -1) {
            $level++;
        }

        foreach($arr as $item) {

            if( $item['parent_id'] == $pid) {
                $item['level'] = $level;
                $resp[$item['id']] = $item;
                // using recursion
                $children = self::buildMenuTree($arr, $item['id'], $level);
                if($children) {
                    $resp[$item['id']]['children'] = $children;
                }
            }
        }

        return $resp;
    }

    public static function convertTreeNode($item, $id = null, $text = null, $category = "category", $state = null) {
        if ($state === null) {
            $state = [
                "opened" => false,
                "disabled" => false,
                "selected" => false,
            ];
        }

        $node = [
            "id" => ($id === null) ? $item["id"] : $id,
            "text" => ($text === null) ? $item["name"] : $text,
            "icon" => "",
            "state" => $state,
            "data" => isset($item["data"]) ? $item["data"] : [],
            "children" => [],
            "li_attr" => "",
            "a_attr" => [
                "data-type" => $category
            ],
            "type" => $category
        ];


        $children = [];
        if (isset($item["children"])) {
            foreach ($item["children"] as $child) {
                $children[] = self::convertTreeNode($child);
            }
        }

        $node["children"] = $children;

        return $node;
    }

    public static function copyImage($destination, $target_dir, $fileName){

        if (!file_exists($target_dir)) {

            mkdir($target_dir, 0777, true);

        }

        $context = stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer'      => false,
                    'verify_peer_name' => false
                )
            )
        );
        if(file_exists($destination) && !copy($destination, ($target_dir.$fileName), $context)){
            echo "failed to copy $destination...\n";
        }
    }

    /**
     * @param string $event
     * @param array $data
     */
    public static function send2Event($event, $data)
    {
        $redis = Redis::connection();
        $redis->publish($event, json_encode($data));
    }

    public static function strFiller ($str, $blank = null){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }

        if($blank){
            $str = str_replace(" ", "", $str);
        }

        return $str;

    }




    /**
     * Build tree year
     * @return array
     */
    public static function getTreeYear() {
        $data[] = [
            'id' => 0,
            'parent_id' => -1,
            'name' => __('Tất cả')
        ];
        $year = date("Y");
        for($i = $year; $i >= $year-5; $i--) {
            $data[] = [
                'id' => $i,
                'parent_id' => 0,
                'name' => $i
            ];
        }

        $listData = BaseService::buildTreeMaster($data);
        return $listData;
    }

    public static function commonFields(Blueprint $table)
    {
        $table->addColumn('timestamp', 'created_at', [0])->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->addColumn('integer', 'created_user')->nullable();
        $table->addColumn('timestamp', 'updated_at', [0])->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        $table->addColumn('integer', 'updated_user')->nullable();
        $table->addColumn('timestamp', 'deleted_at', [0])->nullable();
        $table->addColumn('integer', 'deleted_user')->nullable();
    }

    public static function updateById($table, $id, $data = array()) {
        return DB::table($table)->where('id', $id)->update($data);
    }

    public static function deleteById($table, $id) {
        return DB::table($table)->where('id', $id)->delete();
    }

    public static function insertRecord($table, $data) {
        return DB::table($table)->insertGetId($data);
    }

    public static function getIdByCondition($table, $cond = array()) {
        return DB::table($table)->where($cond)->first()->id;
    }

    public static function renderObject($object, $data){

        $listColumn = array_keys($data);

        foreach ($listColumn as $key => $column){
            $object->$column = empty($data[$column]) && $data[$column] != 0 ? null : trim($data[$column]);
        }

        return $object;

    }

    public static function formatDateVN($originalDate) {
        $date = strtotime($originalDate);
        $day = date('d', $date);
        $month = date('m', $date);
        $year = date('Y', $date);
        return is_null($date) ? '' : 'Ngày ' . $day . ' tháng ' . $month . ' năm ' . $year;
    }

    public static function rebuildVNdate( $format, $time = 0 )
    {
        if ( ! $time ) $time = time();

        $lang = array();
        $lang['sun'] = 'Chủ Nhật';
        $lang['mon'] = 'Thứ 2';
        $lang['tue'] = 'Thứ 3';
        $lang['wed'] = 'Thứ 4';
        $lang['thu'] = 'Thứ 5';
        $lang['fri'] = 'Thứ 6';
        $lang['sat'] = 'Thứ 7';
        $lang['sunday'] = 'Chủ nhật';
        $lang['monday'] = 'Thứ hai';
        $lang['tuesday'] = 'Thứ ba';
        $lang['wednesday'] = 'Thứ tư';
        $lang['thursday'] = 'Thứ năm';
        $lang['friday'] = 'Thứ sáu';
        $lang['saturday'] = 'Thứ bảy';
        $lang['january'] = 'Tháng Một';
        $lang['february'] = 'Tháng Hai';
        $lang['march'] = 'Tháng Ba';
        $lang['april'] = 'Tháng Tư';
        $lang['may'] = 'Tháng Năm';
        $lang['june'] = 'Tháng Sáu';
        $lang['july'] = 'Tháng Bảy';
        $lang['august'] = 'Tháng Tám';
        $lang['september'] = 'Tháng Chín';
        $lang['october'] = 'Tháng Mười';
        $lang['november'] = 'Tháng M. một';
        $lang['december'] = 'Tháng M. hai';
        $lang['jan'] = 'Tháng 01';
        $lang['feb'] = 'Tháng 02';
        $lang['mar'] = 'Tháng 03';
        $lang['apr'] = 'Tháng 04';
        $lang['may2'] = 'Tháng 05';
        $lang['jun'] = 'Tháng 06';
        $lang['jul'] = 'Tháng 07';
        $lang['aug'] = 'Tháng 08';
        $lang['sep'] = 'Tháng 09';
        $lang['oct'] = 'Tháng 10';
        $lang['nov'] = 'Tháng 11';
        $lang['dec'] = 'Tháng 12';

        $format = str_replace( "r", "D, d M Y H:i:s O", $format );
        $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );

        $return = date( $format, $time );

        $replaces = array(
            '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
            '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
            '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
            '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
            '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
            '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
            '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
            '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
            '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
            '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
            '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
            '/\[May\](\W|$)/' => $lang['may2'] . "$1",
            '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
            '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
            '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
            '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
            '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
            '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
            '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
            '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
            '/Monday(\W|$)/' => $lang['monday'] . "$1",
            '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
            '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
            '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
            '/Friday(\W|$)/' => $lang['friday'] . "$1",
            '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
            '/January(\W|$)/' => $lang['january'] . "$1",
            '/February(\W|$)/' => $lang['february'] . "$1",
            '/March(\W|$)/' => $lang['march'] . "$1",
            '/April(\W|$)/' => $lang['april'] . "$1",
            '/May(\W|$)/' => $lang['may'] . "$1",
            '/June(\W|$)/' => $lang['june'] . "$1",
            '/July(\W|$)/' => $lang['july'] . "$1",
            '/August(\W|$)/' => $lang['august'] . "$1",
            '/September(\W|$)/' => $lang['september'] . "$1",
            '/October(\W|$)/' => $lang['october'] . "$1",
            '/November(\W|$)/' => $lang['november'] . "$1",
            '/December(\W|$)/' => $lang['december'] . "$1" );

        return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
    }

    public static function convertDateVi($date) {
        $dateConvert = self::formatDate($date, DMY);
        $arrDate = explode("-", $dateConvert);
        $day = isset($arrDate[0]) ? $arrDate[0] : '';
        $month = isset($arrDate[1]) ? $arrDate[1] : '';
        $year = isset($arrDate[2]) ? $arrDate[2] : '';
        return "Ngày $day tháng $month năm $year";
    }

    public static function jamReadNumForVietnamese( $num = false ) {
        $str = '';
        $num  = trim($num);
        $arr = str_split($num);
        $count = count( $arr );
        $f = number_format($num);
        //KHÔNG ĐỌC BẤT KÌ SỐ NÀO NHỎ DƯỚI 999 ngàn
        if ( $count < 7 ) {
            $str = $num;
        } else {
            // từ 6 số trở lên là triệu, ta sẽ đọc nó !
            // "32,000,000,000"
            $r = explode(',', $f);
            switch ( count ( $r ) ) {
                case 4:
                    $str = $r[0] . ' Tỷ';
                    if ( (int) $r[1] ) { $str .= ' '. $r[1] . ' Triệu'; }
                    break;
                case 3:
                    $str = $r[0] . ' Triệu';
                    if ( (int) $r[1] ) { $str .= ' '. $r[1] . ' Nghìn'; }
                    break;
            }
        }
        return ( $str . '' );
    }

    // Ham doc so thanh chu
    public static function convertNumberToWords($number) {

        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'Bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười lăm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'ngàn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }


        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }


        if ($number < 0) {
            return $negative . self::convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::convertNumberToWords($remainder);
                    $string = $string;
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;

            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return ucfirst(mb_strtolower($string));
    }



    public static function updateOrdinal($beforeOrdinal, $table){
        $listOrdinal = DB::table($table)->orderBy("ordinal", ORDER_DESC)->select("id", "ordinal")->get()->toArray();
        foreach($listOrdinal as $key => $item){
            $object = DB::table($table)->where('id', $item->id)->first();
            $currentOrdinal = $object->ordinal;
            if($currentOrdinal == 1){
                break;
            }
            if($currentOrdinal > $beforeOrdinal) {
                DB::table($table)->where('id', $item->id)->update(['ordinal' => $object->ordinal - 1]);
            }

        }
        return true;
    }

    public static function getFullUrl(){
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function getHttpUrl(){
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    public static function getCurrentDomain(){
        return "https://$_SERVER[HTTP_HOST]";
    }

    public static function getCurrentPage(){
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);

        list($controller, $action) = explode('@', $controller);

        $listPage = Config::get('constants.LIST_PAGE');

        foreach ($listPage as $key => $item){
            if($item['controller'] == $controller){
               return $item['page'];
            }
        }

        return "";

    }

    public static function formatDomain($domain){
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('www.', '', $domain);
        $domain = str_replace('/', '', $domain);

        return $domain;
    }

    public static function getMacAddress() {
        $mac_info = exec('getmac');
        $arr_address = explode(" ", $mac_info);
        return isset($arr_address[0]) ? $arr_address[0] : '';
    }



    public static function createSpace($level) {
        $spaceStr = "";
        for ($i = 2; $i <= $level; $i++) {
            $spaceStr .= "&nbsp;&nbsp;&nbsp;";
        }
        return $spaceStr;
    }



    public static function writeLogSystem($arrData){
        $ip = self::getSourceIp();
        $object = new SystemLog();
        $object->user_id 		= $arrData['user_id'];
        $object->action_id	    = $arrData['action_id'];
        $object->screen_name 	= $arrData['screen_name'];
        $object->source_ip 	    = $ip;
        $object->url 			= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $object->content 		= $arrData['content'];
        $object->created_user   = $arrData['user_id'];
        $object->save();
    }

    public static function getFunctionName($controller, $action = null){
        $arrCondition = [
            ['status', Constant::STATUS_ACTIVE],
            ['module_id', Constant::MODULE_A]
        ];

        $listMenu = FunctionMenu::where($arrCondition)->orderBy("ordinal", Constant::ORDER_ASC)->get();

        $controller = strtolower($controller);

        $action = $action ? strtolower($action) : '';

        if(isset($listMenu)){
            foreach ($listMenu as $menu){

                $funcController = $menu['controller'] ? strtolower($menu['controller']) : '';

                $funcAction = $menu['action'] ? strtolower($menu['action']) : '';

                if($action && $funcController == $controller && $action == $funcAction) {

                    return $menu['name'];

                }

                if(!$action && $funcController == $controller){

                    return $menu['name'];

                }
            }
        }

        return '';
    }
    public static function getNameFromListStatus($arrStatus, $isStatus){
        if(isset($arrStatus)){
            $nameStatus = '';
            foreach($arrStatus as $statusInfo){
                $id   = isset($statusInfo['id']) ? $statusInfo['id'] : '';
                $name = isset($statusInfo['name']) ? __($statusInfo['name']) : '';
                if($id == $isStatus){
                    $nameStatus = $name;
                    break;
                }
            }
            return $nameStatus;
        }
        return '';
    }


    public static function getLocationInfoByIp($ip = null){

        $client  = @$_SERVER['HTTP_CLIENT_IP'];

        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

        $remote  = @$_SERVER['REMOTE_ADDR'];

        $result  = array('country'=> '', 'city'=>'');

        if($ip == null || $ip == ""){

            if(filter_var($client, FILTER_VALIDATE_IP)){

                $ip = $client;

            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){

                $ip = $forward;

            }else{

                $ip = $remote;

            }

        }

        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

        if($ip_data && $ip_data->geoplugin_countryName != null){

            $result['country'] = $ip_data->geoplugin_countryName;
            $result['country_code'] = $ip_data->geoplugin_countryCode;
            $result['city'] = $ip_data->geoplugin_city;

        }

        return $result;

    }

    public static function getUserBrowser() {
        $arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $user_browser = '';
        foreach ($arr_browsers as $browser) {
            if (strpos($agent, $browser) !== false) {
                $user_browser = $browser;
                break;
            }
        }
        switch ($user_browser) {
            case 'MSIE':
            case 'Trident':
                $user_browser = 'Internet Explorer';
                break;
            case 'Edg':
                $user_browser = 'Microsoft Edge';
                break;
        }
        return [
            "browser_name" => $user_browser,
            "user_agent" => $agent
        ];
    }

    public static function recordUserLogonLogs($userId){
        $ip = self::getSourceIp();
        $browserInfo = self::getUserBrowser();
        $source_area = self::getLocationInfoByIp();
        if($source_area["country"] != "" && $source_area["country"] != null){
            $source_area = implode(",", $source_area);
        }else{
            $source_area = "";
        }

        $object = new UserLogonLog();
        $object['user_id']      = $userId;
        $object['ondate']       = date('Y-m-d');
        $object['ontime']       = date('H:i:s');
        $object['source_ip']    = $ip;
        $object['source_area']  = $source_area;
        $object['browser']      = isset($browserInfo['browser_name']) ? $browserInfo['browser_name'] : "";
        $object['user_agent']      = isset($browserInfo['user_agent']) ? $browserInfo['user_agent'] : "";
        $object->save();

    }

    public static function splitString($str, $type = 'prev', $point = null){

        $arr = explode(' ', $str);

        if(empty($point)){
            $point = (int)count($arr) / 2;
        }

        $temp = [];
        if($type == "prev"){
            for ($i = 0; $i < $point; $i++){
                $temp[] = $arr[$i];
            }
        }else{
            for ($i = $point; $i <= count($arr); $i++){
                $temp[] = $arr[$i];
            }
        }

        return implode(" ", $temp);


    }

    public static function sendEmail($data){

        $to_email = $data['to_email'] ?? null;

        Mail::to($to_email)->send(new SendMail($data));

        return 1;
    }


    public static function checkUrlCode($url){

//        return 200;

        // Initializing new session
        $ch = curl_init($url);
        // Request method is set
        curl_setopt($ch, CURLOPT_NOBODY, true);
        // Executing cURL session
        curl_exec($ch);
        // Getting information about HTTP Code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode;

    }

    public static function spliceText($str, $start = null, $length = null){
        $length = $length ?? 10;
        $start  = $start ?? 0;
        $arr = explode(" ", $str);

        if(count($arr) <= $length || !count($arr)){
            return $str;
        }

        return implode(' ', array_splice($arr, $start, $length - 1))."...";

    }

    public static function renderTagifyToString($object){
        $temp = [];
        $arr = json_decode($object, true);
        foreach ($arr as $key => $item){
            $temp[] = $item['value'];
        }

        return count($temp) ? implode(", ", $temp) : "";

    }

    public static function renderCustomerCode($company_id = null){

        $company_id = $company_id ?? self::getCompanyId();

        $lastedObj = User::where("company_id", $company_id)
            ->where('is_admin', Constant::CUSTOMER_ADMIN)
            ->orderBy('id', 'desc')->first();

        if($lastedObj){
            $lastedObjId = $lastedObj->id;
        }else{
            $lastedObjId = 1;
        }

        if($lastedObjId < 10){
            $lastedObjId = "000".$lastedObjId;
        }else if($lastedObjId >= 10 && $lastedObjId <100){
            $lastedObjId = "00".$lastedObjId;
        }else if($lastedObjId >= 100 && $lastedObjId <1000){
            $lastedObjId = "0".$lastedObjId;
        }

        $temp = "KH".$company_id.$lastedObjId;

        return $temp;

    }

    public static function saveLoginLog(){
        $authUser = Auth::user();
        $authUserId = $authUser->id;
        $company_id = $authUser->company_id;

        $object = new UserLogonLog();
        $object->company_id = $company_id;
        $object->ondate = date('Y-m-d');
        $object->ontime  = date('H:i:s');
        $object->user_id = $authUserId;
        $object->source_ip = self::getSourceIp();
        $object->browser = json_encode(self::getUserBrowser());

        $object->save();

    }

    public static function createSlug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }

    public static function redirectAgent(Request $request){
        $currentURL = URL::current();
        $currentURL = str_replace('https://', '', $currentURL);
        $currentURL = str_replace('http://', '', $currentURL);
        $currentURL = str_replace('www.', '', $currentURL);
        if(substr($currentURL, -1) == "/"){
            $currentURL = substr($currentURL, 0, -1);
        }

        $listAgentDomain = Constant::AGENT_DOMAIN;

        return in_array($currentURL, $listAgentDomain);

    }



}
