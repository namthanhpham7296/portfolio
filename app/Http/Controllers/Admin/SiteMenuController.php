<?php

namespace App\Http\Controllers\Admin;

use App\Constant;
use App\Helpers\BaseService;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\SiteMenu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SiteMenuController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function search(Request $request){
        $value = $request['search']['value'];
        $data = $request->all();
        $start = (int)$request->get('start');
        $length = (int)$request->get('length');
        $fieldOrder = isset($request["columns"][$request["order"][0]["column"]]["name"]) ? $request["columns"][$request["order"][0]["column"]]["name"] : null;
        $orderType = isset($request["order"][0]["dir"]) ? $request["order"][0]["dir"] : null;

        $list = SiteMenu::orderBy($fieldOrder, $orderType);
        if ($value) {
            $list = $list->where('users.code', 'like', "%$value%");
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

    public function saveData(Request $request){
        $data = $request->all();
        $id = isset($data['id']) && $data['id'] ? $data['id'] : '';
        $name = isset($data['name']) && $data['name'] ? $data['name'] : '';
        $isRedirect = isset($data['is_redirect']) && $data['is_redirect'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $isPublic = isset($data['is_public']) && $data['is_public'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $status = isset($data['status']) && $data['status'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $continue = isset($data['continue']) && $data['continue'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;

        $conditions = [];
        $conditions[] =
            ['name', $name];
        if($id){
            $object = SiteMenu::find($id);
            $conditions[] = ['id', '<>', $id];
        }else{
            $object = new SiteMenu();
            $getLastInfo = SiteMenu::orderBy("ordinal", Constant::ORDER_DESC)->select("ordinal");
            $getLastInfo = $getLastInfo->first();
            $lastNo      = isset($getLastInfo->ordinal) && $getLastInfo->ordinal ? $getLastInfo->ordinal + 1 : 1;
            $data['ordinal'] = $lastNo;

        }

        $checkNameExists = SiteMenu::where($conditions)->get()->count();

        if($checkNameExists){
            return json_encode([
                'success' => false,
                'message' => __("Name already exists")
            ]);
        }

        unset($data['continue']);
        unset($data['_token']);
        $data['is_public'] = $isPublic;
        $data['is_redirect'] = $isRedirect;
        $data['status'] = $status;
        $object = BaseService::renderObject($object, $data);
        if(!$object->save()){
            return json_encode([
                'success' => false,
                'message' => __("Save unsuccessfully")
            ]);
        }

        return json_encode([
            'success' => true,
            'is_continue' => $continue,
            'message' => __("Save successfully")
        ]);
    }

    public function changeRedirect(Request  $request){
        $data = $request->all();
        $id = $data['id'];
        $object = SiteMenu::find($id);
        $isRedirect = $object->is_redirect ? Constant::STATUS_INACTIVE : Constant::STATUS_ACTIVE;
        $object->is_redirect = $isRedirect;
        if($object->save()){
            return json_encode([
                "success" => true,
                "message" => __("Change redirect successfully")
            ]);
        }
        return json_encode([
            "success" => false,
            "message"=> __("Change redirect fail")
        ]);
    }

    public function changePublic(Request  $request){
        $data = $request->all();
        $id = $data['id'];
        $object = SiteMenu::find($id);
        $isPublic = $object->is_public == Constant::STATUS_ACTIVE  ? Constant::STATUS_INACTIVE : Constant::STATUS_ACTIVE;
        $object->is_public = $isPublic;
        if($object->save()){
            return json_encode([
                "success" => true,
                "message" => __("Change public successfully")
            ]);
        }
        return json_encode([
            "success" => false,
            "message"=> __("Change public fail")
        ]);
    }

    public function rowReorder(Request $request) {
        $data           = $request->all();
        $arrSequences   = isset($data['seqs']) ? (array)json_decode($data['seqs'], true) : [];
        foreach ($arrSequences as $item) {
            $menu = SiteMenu::where('id', $item['id'])->first();
            if (empty($menu)) {
                return response()->json([
                    'error' => __('Menu not found').'.',
                ], 400);
            }
            $menu->ordinal = $item['new_seq'];
            $menu->save();
        }
        return [
            'success' => true,
            'message' => __("Changed ordinal successfully").'.',
        ];

    }

    public function delete(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $table = "site_menus";
        $object = SiteMenu::find($id);
        if(!$object){
            return json_encode([
                'success' => false,
                'message' => __('Delete unsuccessfully')
            ]);
        }

        if($object->delete()){
            $beforeOrdinal = $object->ordinal;
            BaseService::updateOrdinal($beforeOrdinal, $table);
            return json_encode([
                'success' => true,
                'message' => __('Delete successfully')
            ]);
        }

        return json_encode([
            'success' => false,
            'message' => __('Delete faild')
        ]);
    }

}
