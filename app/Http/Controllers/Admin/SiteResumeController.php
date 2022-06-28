<?php

namespace App\Http\Controllers\Admin;

use App\Constant;
use App\Helpers\BaseService;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\SiteResume;
use Illuminate\Http\Request;

class SiteResumeController extends BaseController
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

        $list = SiteResume::orderBy($fieldOrder, $orderType);
        if ($value) {
            $list = $list->where('title', 'like', "%$value%");
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
        $company_id     = BaseService::getCompanyId();
        $data = $request->all();
        $id = isset($data['id']) && $data['id'] ? $data['id'] : '';
        $title = isset($data['title']) && $data['title'] ? $data['title'] : '';
        $subtitle = isset($data['subtitle']) && $data['subtitle'] ? $data['subtitle'] : '';
        $position = isset($data['position']) && $data['position'] ? $data['position'] : 1;
        $links = isset($data['links']) && $data['links'] ? $data['links'] : '';
        $content = isset($data['content']) && $data['content'] ? $data['content'] : '';
        $from = isset($data['from']) && $data['from'] ? BaseService::formatDate($data['from'], "Y-m-d") : '';
        $to = isset($data['to']) && $data['to'] ? BaseService::formatDate($data['to'], "Y-m-d") : '';
        $showHomepage = isset($data['show_homepage']) && $data['show_homepage'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $status = isset($data['status']) && $data['status'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $continue = isset($data['continue']) && $data['continue'] == 'on' ? Constant::STATUS_ACTIVE : Constant::STATUS_INACTIVE;
        $photo = isset($data['photo']) && $data['photo'] ? $data['photo'] : [];


        $conditions = [];
        $conditions[] =
            ['subtitle', $subtitle];
        if($id){
            $object = SiteResume::find($id);
            $conditions[] = ['id', '<>', $id];
        }else{
            $object = new SiteResume();
            $getLastInfo = SiteResume::orderBy("ordinal", Constant::ORDER_DESC)->select("ordinal");
            $getLastInfo = $getLastInfo->first();
            $lastNo      = isset($getLastInfo->ordinal) && $getLastInfo->ordinal ? $getLastInfo->ordinal + 1 : 1;
            $object['ordinal'] = $lastNo;

        }

        $checkTitleExists = SiteResume::where($conditions)->get()->count();

        if($checkTitleExists){
            return json_encode([
                'success' => false,
                'message' => __("Name already exists")
            ]);
        }

        unset($data['continue']);
        unset($data['_token']);

        if($photo){
            $fileName = "P_".time().".".$photo->getClientOriginalExtension();
            $object['photo']  = $fileName;
        }

        $object['show_homepage'] = $showHomepage;
        $object['status'] = $status;
        $object['from'] = $from;
        $object['to'] = $to;
        $object['title'] = $title;
        $object['subtitle'] = $subtitle;
        $object['content'] = $content;
        $object['links'] = $links;
        $object['position'] = $position;

        if(!$object->save()){
            return json_encode([
                'success' => false,
                'message' => __("Save unsuccessfully")
            ]);
        }
        if($photo){
            /** Upload file */
            $path = public_path().'/uploads/'.$company_id.'/Resumes/'.$object->id.'/Photo/';
            $photo->move($path, $fileName);
        }
        return json_encode([
            'success' => true,
            'is_continue' => $continue,
            'message' => __("Save successfully")
        ]);
    }

    public function changePublic(Request  $request){
        $data = $request->all();
        $id = $data['id'];
        $object = SiteResume::find($id);
        $showHomepage = $object->show_homepage == Constant::STATUS_ACTIVE  ? Constant::STATUS_INACTIVE : Constant::STATUS_ACTIVE;
        $object->show_homepage = $showHomepage;
        if($object->save()){
            return json_encode([
                "success" => true,
                "message" => __("Show homepage successfully")
            ]);
        }
        return json_encode([
            "success" => false,
            "message"=> __("Show homepage fail")
        ]);
    }

    public function rowReorder(Request $request) {

        $data           = $request->all();
        $arrSequences   = isset($data['seqs']) ? (array)json_decode($data['seqs'], true) : [];

        foreach ($arrSequences as $item) {
            $menu = SiteResume::where('id', $item['id'])->first();
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
        $table = "site_resumes";
        $object = SiteResume::find($id);
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
