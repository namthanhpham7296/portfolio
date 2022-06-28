<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Constant;
use App\FunctionMenu;
use App\Helpers\BaseService;
use App\Helpers\ExcelService;
use App\Language;
use App\Position;
use App\Store;
use App\SystemMessage;
use App\User;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Database\Eloquent\Builder;
class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

    }

    public function index()
    {
        $title = trans("User List");
        $company_id = BaseService::getCompanyId();

        $listCompany = Company::where('status', Constant::STATUS_ACTIVE)->get();
        $listUserRole = UserRole::get();


        return view('Admin.User.index', compact(
            'title',
            'listUserRole',
            'listCompany'
        ));
    }

    public function search (Request $request) {
        $value = $request['search']['value'];
        $data = $request->all();
        $company_id = BaseService::getCompanyId();

        $is_admin = $data['is_admin'] ?? 0;

        $start = (int)$request->get('start');
        $length = (int)$request->get('length');
        $fieldOrder = isset($request["columns"][$request["order"][0]["column"]]["name"]) ? $request["columns"][$request["order"][0]["column"]]["name"] : null;
        $orderType = isset($request["order"][0]["dir"]) ? $request["order"][0]["dir"] : null;

        $list = User::select('users.*')
            ->orderBy($fieldOrder, $orderType);

        if($is_admin){
            $list = $list->where('users.is_admin', $is_admin);
        }

        if ($value) {

            $list = $list->where( function ( $query ) use ($value){
                $query->where('users.code', 'like', "%$value%")
                    ->orWhere('users.name', 'like', "%$value%")
                    ->orWhere('users.phone', 'like', "%$value%")
                    ->orWhere('users.contact_email', 'like', "%$value%")
                ;
            });


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

    public function saveData(Request $request) {


        $data           = $request->all();
        $id             = $data['id'] ?? '';
        $code           = $data['code'] ?? '';
        $email          = $data['email'] ?? '';
        $password       = $data['password'] ?? '';
        $position_id    = $data['position_id'] ?? '';
        $is_admin       = $data['is_admin'] ?? '';
        $company_id     = $data['company_id'] ?? '';

        $status     = isset($data['status']) && $data['status'] == "on" ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $isContinue = isset($data['continue']) && $data['continue'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;

        if($is_admin == Constant::TA_ADMIN && empty($company_id)){
            return json_encode([
                "success" => false,
                "message" => __(SystemMessage::PLEASE_SELECT_TRAVEL_AGENT_BEFORE)
            ]);
        }

        $conditions = [];
        $conditions[] = ["code", $code];

        if($id) {
            $object = User::find($id);
            $conditions[] = ["id", "<>", $id];
        } else {
            $object = new User();
            $data['company_id'] = $company_id ?? BaseService::getCompanyId();

        }
        $exist = User::where($conditions)->get()->count();

        if($exist) {
            return json_encode([
                "success" => false,
                "message" => __(SystemMessage::MESSAGE_EXIST_CODE)
            ]);
        }



        $functions_access = null;
        if($position_id){
            $position = Position::find($position_id);
            if(!$position){
                return json_encode([
                    "success" => false,
                    "message" => __(SystemMessage::POSITION_NOT_FOUND)
                ]);
            }

            $functions_access = $position->functions_access;

        }



        unset($data['continue']);

        $data['functions_access'] = $functions_access;
        $data['status'] = $status;
        $data['password'] = Hash::make($password);

        $object = BaseService::renderObject($object, $data);

        if($object->save()) {
            return json_encode([
                'success'       => true,
                'is_continue'   => $isContinue,
                'message'       => __(SystemMessage::MESSAGE_SAVE_SUCCESSFULLY)
            ]);
        }

        return json_encode([
            'success'       => false,
            'message'       => __(SystemMessage::MESSAGE_SAVE_UNSUCCESSFULLY)
        ]);
    }

    public function saveGeneral(Request $request){
        $data = $request->all();
        $authUser       = Auth::user();
        $authUserId     = $authUser->id;
        $authUserName   = $authUser->name;
        $auth_is_admin = $authUser->is_admin;
        $controllerName = substr(class_basename(Route::current()->controller), 0, -10);

        $auth_lang_key = $authUser->lang_key;
        $date_format = $auth_lang_key == 'vn' ? 'd/m/Y' : 'm/d/Y';

        $company_id     = BaseService::getCompanyId();

        $id                 = $data['id'] ?? '';
        $code               = $data['code'] ?? null;
        $birthday           = isset($data['birthday']) && $data['birthday'] ? BaseService::reformatDate($data['birthday']) : null;
        $status             = isset($data['status']) && $data['status'] == 'on'  ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $position_id        = $data['position_id'] ?? null;
        $lang_key           = $data['lang_key'] ?? null;

        $avatar             = $data['avatar'] ?? [];

        $object = User::find($id);

        if(!$object){
            abort(404);
        }

//        $error_null = false;
//        if($auth_is_admin == Constant::MASTER_ADMIN){
//            if(empty($code) || empty($position_id)){
//                $error_null = true;
//            }
//
//            if(!empty($position_id)){
//                $position = Position::find($position_id);
//                if(!$position){
//                    return json_encode([
//                        "success" => false,
//                        "message" => __(SystemMessage::POSITION_NOT_FOUND)
//                    ]);
//                }
//
//                $functions_access = $position->functions_access;
//                $data['functions_access'] = $functions_access;
//            }
//
//        }else{
//            if(empty($code)){
//                $error_null = true;
//            }
//        }
//
//        if($error_null){
//            return json_encode([
//                'success'  => false,
//                'message'  => __(SystemMessage::MESSAGE_DATA_REQUIRED_IS_NULL)
//            ]);
//        }

        $conditions = [
            ['id', '<>', $id],
            ['code', $code],
            ['company_id', $company_id],
        ];

        $exist = User::where($conditions)->count();
        if($exist){
            return json_encode([
                'success'  => false,
                'message'  => __(SystemMessage::MESSAGE_EXIST_CODE)
            ]);
        }

        $fileName = "";
        if($avatar){
            $fileName = "P_".time().".".$avatar->getClientOriginalExtension();;
            $data['avatar']  = $fileName;
        }



        $data['birthday']           = $birthday;
        $data['status']             = $status;

        $object = BaseService::renderObject($object, $data);
        if(!$object->save()){
            return json_encode([
                'success'  => false,
                'message'  => __(SystemMessage::MESSAGE_SAVE_SUCCESSFULLY)
            ]);
        }

        if($avatar){
            /** Upload file */
            $path = public_path().'/uploads/'.$company_id.'/User/'.$object->id.'/Avatar/';
            $avatar->move($path, $fileName);
        }
        if($object->id == $authUser->id){
            Auth::setUser($object);
        }

        /**
         * Save log
         */

        $contentLog = __("User: ")." <b>".$authUserName."</b> - ID: ".$authUserId." <br>"
            .__("Update User: ")." <br>"
            .__("Value: ")." <b>".json_encode($object, JSON_PRETTY_PRINT)."</b> "." <br>"
        ;
        $arrData = [];
        $arrData['user_id']      = $authUserId;
        $arrData['action_id']    = Constant::ACTION_UPDATE;
        $arrData['screen_name']  = BaseService::getFunctionName($controllerName, Constant::MODULE_A);
        $arrData['content']      = $contentLog;

        BaseService::writeLogSystem($arrData);
        return json_encode([
            'success'   => true,
            'id'        => $id,
            'message'   => __(SystemMessage::MESSAGE_SAVE_SUCCESSFULLY)
        ]);


    }

    public function changeAvatar(Request $request) {
        $data           = $request->all();

        $id     = isset($data['id']) ? $data['id'] : '';

        $avatar = isset($data['avatar_hidden']) ? $data['avatar_hidden'] : [];

        $object = User::find($id);
        if(empty($object)) {
            return json_encode([
                "success" => false,
                "message" => __(SystemMessage::MESSAGE_OBJECT_NOT_FOUND)
            ]);
        }

        $oldAvatar  = $object->avatar;

        $fileName   = $avatar->getClientOriginalName();
        $mimeType   = $avatar->getClientMimeType();
        $extension  = $avatar->getClientOriginalExtension();
        $size       = $avatar->getSize();

        if(!$size){
            return json_encode([
                'success'       => false,
                'message'       => __('File upload invalid!')
            ]);
        }

        $object->avatar = $fileName;

        if($object->save()) {

            $path = public_path()."/uploads/Admin/User/".$id."/avatar/";

            if(file_exists($path)){
//                unlink($path.$oldAvatar);
            }

            $avatar->move($path, $fileName);

            $avatarPath = url('public/uploads/Admin/User/'.$id.'/avatar/'.$fileName.'?t='.time());

            $authUser = Auth::user();
            $authUserId = $authUser->id;
            if($authUserId == $id){
                session()->put('user.avatar', $fileName );
                session()->save();
            }

            return json_encode([
                'success'       => true,
                'avatar_path'   => $avatarPath,
                'message'       => __(SystemMessage::MESSAGE_SAVE_SUCCESSFULLY)
            ]);
        }

        return json_encode([
            'success'       => false,
            'message'       => __(SystemMessage::MESSAGE_SAVE_UNSUCCESSFULLY)
        ]);
    }

    public function changePassword(Request $request) {
        $data           = $request->all();

        $id                 = isset($data['id']) ? $data['id'] : '';
        $current_password   = isset($data['current_password']) ? trim($data['current_password']) : '';
        $password           = isset($data['password']) ? trim($data['password']) : '';
        $confirm_password   = isset($data['confirm_password']) ? trim($data['confirm_password']) : '';

        $object = User::find($id);
        if(empty($object)) {
            return json_encode([
                "success" => false,
                "message" => __(SystemMessage::MESSAGE_OBJECT_NOT_FOUND)
            ]);
        }

        if(strlen($password) < 8 || strlen($password) > 20){
            return json_encode([
                'success'       => false,
                'message'       => __('Password must not be less than 8 characters and exceed 20 characters')
            ]);
        }

        if($password != $confirm_password){
            return json_encode([
                'success'       => false,
                'message'       => __('Re-entered password is incorrect')
            ]);
        }

        if(!empty($current_password)){
            if (!Hash::check($current_password, $object->password)) {
                return json_encode([
                    "success" => false,
                    "message" => __("Current password is not correct")
                ]);
            }
        }

        $object->password = Hash::make($password);

        if($object->save()) {

            return json_encode([
                'success'       => true,
                'message'       => __('Password update successful')
            ]);
        }

        return json_encode([
            'success'       => false,
            'message'       => __('Password update failed')
        ]);
    }

    public function delete(Request $request) {
        $id = $request['id'];
        $object = User::find($id);

        if(!$object) {
            return json_encode([
                'success' => false,
                'alert'   => __(SystemMessage::MESSAGE_OBJECT_NOT_FOUNT)
            ]);
        }

        if($object->delete()) {
            return json_encode([
                'success' => true,
                'message' => __(SystemMessage::MESSAGE_DELETE_SUCCESSFULLY)
            ]);
        }

        return json_encode([
            'success' => false,
            'message' => __(SystemMessage::MESSAGE_DELETE_UNSUCCESSFULLY)
        ]);
    }

    public function profile($page = null, $id = null){

        $title = trans("User Profile");

        $authUser   = Auth::user();
        $company_id = BaseService::getCompanyId();
        $page       = $page ? $page : 'general';
        $id         = $id ? $id : $authUser->id;

        $userInfo = User::find($id);

        if(!$userInfo){
            abort(404);
        }
        $userInfo = $userInfo->toArray();

        $listLanguage = [];
        $listCompany = [];
        $listUserRole = [];
        $listStore = [];
        $listFunctionMenu = [];
        $functions_menus = [];

        switch ($page){
            case 'general':


                $listCompany = Company::get();
                $listUserRole = UserRole::get();

                break;
            case "accessMenu":
                $listFunctionMenu = FunctionMenu::get()->toArray();
                $functions_menus = [];
                foreach ($listFunctionMenu as $key => $item){
                    if($item['parent_id']){continue;}
                    $item['parent'] = "#";
                    $item['text'] = $item['name'];

                    array_push($functions_menus, [
                        'id' => $item['id'],
                        'parent' => "#",
                        'text' => $item['name'],
                    ]);

                    foreach ($listFunctionMenu as $children){
                        if($children['parent_id'] == $item['id']){

                            array_push($functions_menus, [
                                'id' => $children['id'],
                                'parent' => $item['id'],
                                'text' => $children['name'],
                            ]);
                        }
                    }

                }

                break;
        }
        $back_url = url('admin/user/index');
        return view('Admin.User.profile', compact(
            'title',
            'page',
            'back_url',
            'listCompany',
            'listUserRole',
            'functions_menus',
            'userInfo'
        ));
    }

    public function saveAccessMenu(Request $request) {
        $data = $request->all();

        $id                 = $data['id'] ?? '';
        $functions_access   = $data['functions_access'] ?? [];

        $object = User::find($id);
        if(empty($object)) {
            return json_encode([
                "success" => false,
                "message" => __(SystemMessage::MESSAGE_OBJECT_NOT_FOUND)
            ]);
        }

        $functions_access = implode(',', $functions_access);

        $object->functions_access = $functions_access;

        if($object->save()) {

            return json_encode([
                'success'       => true,
                'message'       => __('Granted access successfully')
            ]);
        }

        return json_encode([
            'success'       => false,
            'message'       => __('Granted access failed')
        ]);
    }

    public static function renderAccessMenuTree($user){

        $isAdmin                = isset($user['is_admin']) ? $user['is_admin'] : -1;
        $strUserModulesAccess   = isset($user['modules_access']) ? $user['modules_access'] : '';
        $strUserFunctionsAccess = isset($user['functions_access']) ? $user['functions_access'] : '';
        $arrUserModuleAccess    = explode(',', $strUserModulesAccess);
        $arrUserFunctionsAccess = explode(',', $strUserFunctionsAccess);

//        $listRoleAccess = RoleAccess::where('is_admin', $isAdmin)->get()->toArray();
        $listRoleAccess = RoleAccess::get()->toArray();

        $listModuleAccess = Module::where('status', Constant::STATUS_ACTIVE)
            ->whereIn('id', $arrUserModuleAccess)
            ->get()->toArray();

        $listFunctionAll = FunctionMenu::where('status', Constant::STATUS_ACTIVE)
//            ->whereIn('id', $arrFunctionsAccess)
            ->get()->toArray();

        foreach($listFunctionAll as $key => $item){
            $id = $item['id'];
            $semiParentId = $item['semi_parent_id'];
            if($semiParentId){continue;}
            foreach($listFunctionAll as $cKey => $child){
                if($child['semi_parent_id'] != $id){
                    continue;
                }
                $listFunctionAll[$cKey]['parent_id'] = $id;

            }
        }

        foreach ($listModuleAccess as $key => $module){
            $listFunction = [];

            $functionsRoleAccess = "";
            foreach ($listRoleAccess as $roleAccess){
                if($roleAccess['module_id'] == $module['id'] &&  $roleAccess['is_admin'] == $isAdmin) {
                    $functionsRoleAccess = $roleAccess['functions_access'];
                    break;
                }
            }

            $functionsUserAccess = [];
            foreach ($listFunctionAll as $function){

                if($function['module_id'] == $module['id']) {
                    array_push($listFunction, $function);
                }

                if(in_array($function['id'], $arrUserFunctionsAccess)){
                    array_push($functionsUserAccess, $function['id']);
                }

            }

            $listFunction = BaseService::buildTreeMaster($listFunction, 0);
            $listModuleAccess[$key]['functions']          = $listFunction;
            $listModuleAccess[$key]['functions_access']   = implode(',', $functionsUserAccess);
            $listModuleAccess[$key]['role_access_id']     = -1;

        }

        return $listModuleAccess;
    }

    public function import()
    {
        $title = trans("Nhập danh sách người dùng");


        return view('Admin.User.import', compact(
            'title'
        ));
    }

    public function saveImportData(Request $request) {
        $data           = $request->all();

        $id     = isset($data['id']) ? $data['id'] : '';

        $file = isset($data['file']) ? $data['file'] : [];

        if(empty($file) || !$file->getSize()) {
            return json_encode([
                "success" => false,
                "message" => __("File upload invalid")
            ]);
        }

        $fileName   = $file->getClientOriginalName();
        $mimeType   = $file->getClientMimeType();
        $extension  = $file->getClientOriginalExtension();
        $size       = $file->getSize();

        $path = public_path()."/uploads/Admin/User/import/";

        $file->move($path, $fileName);

        $pathFile = $path.$fileName;

        try {

            $ext = pathinfo($pathFile, PATHINFO_EXTENSION);

            if(strtolower($ext) == 'xlsx'){
                $reader =  new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }

            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($pathFile);

        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($pathFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        //  Get data default

        $listDepartment = Department::where('status', Constant::STATUS_ACTIVE)
            ->orderBy('name', 'asc')
            ->get()
            ->toArray()
        ;

        $listPosition = Position::where('status', Constant::STATUS_ACTIVE)
            ->orderBy('name', 'asc')
            ->get()
            ->toArray()
        ;

        $listRole = Role::where('status', Constant::STATUS_ACTIVE)
            ->orderBy('name', 'asc')
            ->get()
            ->toArray()
        ;

        $listUser = User::get()
            ->toArray()
        ;
        //  Get worksheet dimensions


        $objWorksheet   = $spreadsheet->getSheet(0);
        $highestRow     = $objWorksheet->getHighestRow();

        $colB  = 0;
        $colC  = 1;
        $colD  = 2;
        $colE  = 3;
        $colF  = 4;
        $colG  = 5;
        $colH  = 6;
        $colI  = 7;
        $colJ  = 8;
        $colK  = 9;
        $colL  = 10;
        $colM  = 11;




        $beginRow   = 7;

        $arrDataError = [];
        $totalInsert = 0;
        $totalUpdate = 0;

        $list = [];
        for($row = $beginRow; $row <= $highestRow; $row++){

            $rowData   = $objWorksheet->rangeToArray("B$row:M$row", NULL, TRUE, FALSE);

            $code           = trim($rowData[0][$colB]);
            $name           = trim($rowData[0][$colC]);
            $gender         = trim($rowData[0][$colD]);
            $birthday       = trim($rowData[0][$colE]);
            $address        = trim($rowData[0][$colF]);
            $phone          = trim($rowData[0][$colG]);
            $contactEmail   = trim($rowData[0][$colH]);
            $departmentCode = trim($rowData[0][$colI]);
            $positionCode   = trim($rowData[0][$colJ]);
            $email          = trim($rowData[0][$colK]);
            $password       = trim($rowData[0][$colL]);
            $roleCode       = trim($rowData[0][$colM]);

            if(empty($code)){
                array_push($arrDataError, $row);
                continue;
            }

            $departmentId   = BaseService::compareValue($listDepartment, $departmentCode);
            $positionId     = BaseService::compareValue($listPosition, $positionCode);
            $id             = BaseService::compareValue($listUser, $email, 'email', 'id');

            $isAdmin            = null;
            $modulesAccess      = null;
            $functionsAccess    = null;
            foreach ($listRole as $role){
                if(trim($role['code']) == $roleCode){
                    $isAdmin            = $role['is_admin'];
                    $modulesAccess      = $role['modules_access'];
                    $functionsAccess    = $role['functions_access'];
                    break;
                }
            }

            $birthday = empty($birthday) ? '' : BaseService::reformatDate($birthday);

            $data = [
                'department_id'     => $departmentId,
                'position_id'       => $positionId,
                'code'              => $code,
                'name'              => $name,
                'phone'             => $phone,
                'email'             => $email,
                'contact_email'     => $contactEmail,
                'birthday'          => $birthday,
                'password'          => Hash::make($password),
                'modules_access'    => $modulesAccess,
                'functions_access'  => $functionsAccess,
                'is_admin'          => $isAdmin,
            ];

            if(!empty($id)){
                $data['id'] = $id;
            }

            array_push($list, $data);

        }


        $totalInsert = 0;
        $totalUpdate = 0;
        foreach($list as $key => $item){
            if(isset($item['id'])){
                $id = $item['id'];
                $object = User::find($id);
                $totalUpdate++;
            }else{
                $object = new User();
                $totalInsert++;
            }

            $object->department_id      = $item['department_id'];
            $object->position_id        = $item['position_id'];
            $object->code               = $item['code'];
            $object->name               = $item['name'];
            $object->phone              = $item['phone'];
            $object->email              = $item['email'];
            $object->contact_email      = $item['contact_email'];
            $object->birthday           = $item['birthday'];
            $object->password           = $item['password'];
            $object->modules_access     = $item['modules_access'];
            $object->functions_access   = $item['functions_access'];
            $object->is_admin           = $item['is_admin'];

            $object->save();

        }

        $message = "";
        if($totalInsert != 0){
            $message .= "* ".__('Number of rows inserted').": <b>".$totalInsert."</b>.";
        }

        if($totalUpdate != 0){
            $message .= "<br/>* ".__('Number of rows updated').": <b>".$totalUpdate."</b>.";
        }

        return json_encode([
            'success'       => true,
            'message'       => $message
        ]);
    }

    public function export(Request $request) {

        $this->autoRender = false;
        $data       = $request->all();
        $q = $data['q'];

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $pathFile = public_path()."/samples/blank.xlsx";
        $spreadsheet = $reader->load($pathFile);


        $company = BaseService::getCompanyInfo();

        $title = __("User List");

        $objWorksheet = ExcelService::defaultInit($spreadsheet);


        $subject 		= $company['title'] ?? '';
        $address 		= $company['address'] ?? '';
        $phoneNumber 	= $company['phone_number'] ?? '';
        $email 			= $company['email'] ?? '';

        $startRow = 1;

        $summaryInfo = $subject.PHP_EOL;
        $summaryInfo .= "Địa chỉ: ".$address.PHP_EOL;
        $summaryInfo .= "Điện thoại: ".$phoneNumber.PHP_EOL;
        $summaryInfo .= "Email: ".$email;

        $objWorksheet
            ->setCellValue('A'.$startRow, $summaryInfo)
            ->setCellValue('A'.($startRow + 1), $title)
        ;

        $objWorksheet->mergeCells('A'.($startRow).':G'.($startRow));
        $objWorksheet->getRowDimension($startRow)->setRowHeight(60);
        $objWorksheet->getStyle('A'.$startRow)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(10)
            ->setItalic(true)
        ;

        $objWorksheet->getStyle('A'.$startRow)
            ->getAlignment()->setWrapText(true);
        $objWorksheet->getRowDimension($startRow +1)->setRowHeight(30);
        $objWorksheet->mergeCells('A'.($startRow + 1).':G'.($startRow + 1));
        $objWorksheet->getStyle("A".($startRow + 1))->getFont()
            ->setName('Times New Roman')
            ->setBold(true)
            ->setSize(15)
        ;
        $objWorksheet->getStyle('A'.($startRow + 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        # Define variable
        $labelId                = __('No.');
        $labelCode              = __('User Code');
        $labelName              = __('Fullname');
        $labelEmail             = __('Username');
        $labelPhone             = __('Phone');
        $labelContactEmail      = __('Email');
        $labelIsAdmin           = __('Permission');

        $indexTitle = $startRow + 2;
        $objWorksheet
            ->setCellValue('A' . $indexTitle  , $labelId)
            ->setCellValue('B' . $indexTitle  , $labelCode)
            ->setCellValue('C' . $indexTitle  , $labelName)
            ->setCellValue('D' . ($indexTitle), $labelEmail)
            ->setCellValue('E' . ($indexTitle), $labelPhone)
            ->setCellValue('F' . ($indexTitle), $labelContactEmail)
            ->setCellValue('G' . ($indexTitle), $labelIsAdmin)
        ;

        $objWorksheet->getStyle('A'.$indexTitle.':G'.$indexTitle)
            ->getFont()
            ->setName('Times New Roman')
            ->setBold(true)
            ->setSize(12);

        $beginData = $indexTitle + 1;

        $listUser = User::where("users.code", 'like', '%'.$q.'%')
            ->orWhere("users.name", 'like', '%'.$q.'%')
            ->leftJoin("roles", "roles.is_admin", "=", "users.is_admin")
            ->select("users.*", "roles.name as name_roles")
            ->get()->toArray();

        foreach($listUser as $key => $item){
            $code              = $item['code'];
            $name              = $item['name'];
            $email             = $item['email'];
            $phone             = $item['phone'];
            $contact_email     = $item['contact_email'];
            $name_roles        = $item['name_roles'];
            $objWorksheet
                ->setCellValue('A' . $beginData  , $key +1)
                ->setCellValue('B' . $beginData  , $code)
                ->setCellValue('C' . $beginData  , $name)
                ->setCellValue('D' . ($beginData), $email)
                ->setCellValue('E' . ($beginData), $phone)
                ->setCellValue('F' . ($beginData), $contact_email)
                ->setCellValue('G' . ($beginData), $name_roles)
            ;

            $beginData++;

        }

        $lastRow = 10;
        $lastCol = "G";

        ## Format template
        /*------------------------------------------------------------------------------------------------------------*/
        $objWorksheet->getStyle('A1:'.$lastCol.$lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        #Set width for column
        $hashColumn = range('A', 'G');
        $count = 0;
        foreach ($hashColumn as $key => $value) {
            $dimension = 0;
            switch ($value) {
                case 'A':
                    $dimension = 7;
                    break;
                case 'B':
                    $dimension = 15;
                    break;
                case 'C':
                    $dimension = 35;
                    break;
                case 'D':
                    $dimension = 30;
                    break;
                case 'E':
                    $dimension = 15;
                    break;
                case 'F':
                    $dimension = 30;
                    break;
                case 'G':
                    $dimension = 30;
                    break;
            }
            $lastRow = $beginData - 1;
            $objWorksheet->getColumnDimension($value)->setWidth($dimension);
            $objWorksheet->getStyle('A3:'.$lastCol.'3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $objWorksheet->getStyle('A4:A'.$lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $count++;
        }

        /**
         *  All Border Column
         */
        $styleBorder = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                ),
            )
        );
        $range = 'A'.($indexTitle).':'.$lastCol.$lastRow;
        $objWorksheet->getStyle($range)->applyFromArray($styleBorder);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $fileName = __($title.".xlsx");
        $objWorksheet->setTitle(__('Report'));
        # Output file
        $file = ExcelService::outputSpreadsheet($spreadsheet, false, $fileName);

        $filename = $title.'.xlsx';

        return json_encode ( array (
            'success' 	=> true,
            'file' 		=> $file,
            'alert' 	=> 'Report data processing complete',
            'filename' 	=> $filename
        ) );
    }

    public function removeAvatar(Request $request){
        $data = $request->all();
        $id = $data['id'] ?? '';

        $object = User::find($id);
        if(empty($object)){
            return json_encode([
                'success' => false,
                'message' => __(SystemMessage::MESSAGE_OBJECT_NOT_FOUND)
            ]);
        }

        $destination_file = public_path()."/uploads/Admin/User/".$id."/";

        if(file_exists($destination_file)){
            File::deleteDirectory($destination_file);
            $object->avatar = '';
            $object->save();
            $picturePath = asset('public/images/no_img.png');
            return json_encode([
               "success" => true,
                "alert"  => __("Remove picture successfully"),
                "picture_path" => $picturePath,
            ]);
        }

        return json_encode([
            "success" => false,
            "alert" => __("Remove picture failed")
        ]);
    }

    public function loadStore (Request $request) {
        $authUser = Auth::user();
        $authUserId = $authUser->id;

        $data = $request->all();

        $company_id = $data['company_id'] ?? -1;

        $listStore = Store::where('company_id', $company_id)
            ->where('status', Constant::STATUS_ACTIVE)
            ->get();

        $contentHtml = view('Elements.cbb', [
            'domeHtml' 		=> 'store_id',
            'nameHtml' 		=> 'store_id',
            'displayField'  => 'name',
            'isNone'  	    => true,
            'valueField'  	=> 'id',
            'listData' 		=> $listStore,
        ])->render();


        return json_encode([
            "success"       => true,
            "contentHtml"   => $contentHtml,
        ]);
    }

}
