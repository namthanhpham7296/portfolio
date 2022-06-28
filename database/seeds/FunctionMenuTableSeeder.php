<?php

use App\FunctionMenu;
use App\Helpers\BaseService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('function_menus')->truncate();

        $list = [

            // ================================================================== Admin Portal================================================================================================== //
            // Dashboard
            ['code' => 'adm_dashboard', 'module_id' => 1, "parent_code" => null, "semi_parent_code" => null, "name" => "Dashboard",'plugin' => "admin", "controller" => "dashboard", 'action' => 'index', "params" => null, "cls_icon" => "fas fa-chart-pie", "link" => "admin/dashboard/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            // Settings
            ['code' => 'adm_setting', 'module_id' => 1, "parent_code" => null, "semi_parent_code" => null, "name" => "Settings",'plugin' => "", "controller" => "", 'action' => '', "params" => null, "cls_icon" => "fas fa-cog", "link" => null, "is_link" => 0, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 3],
            //Core Data
            ['code' => 'adm_core_data', 'module_id' => 1, "parent_code" => null, "semi_parent_code" => null, "name" => "Core Data",'plugin' => "", "controller" => "", 'action' => '', "params" => null, "cls_icon" => "fas fa-database", "link" => null, "is_link" => 0, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 3],


        ];

        $listLevel2 = [
            // ================================================================== Admin Portal Level 2 ================================================================================================== //
            ['code' => 'adm_company_profile', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => null, "name" => "Company Profile",'plugin' => "admin", "controller" => "company", 'action' => 'profile', "params" => null, "cls_icon" => "fas fa-building", "link" => "admin/company/profile", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            // User List
            ['code' => 'adm_user', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => null, "name" => "User List",'plugin' => "admin", "controller" => "user", 'action' => 'index', "params" => null, "cls_icon" => "fas fa-users", "link" => "admin/user/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            ['code' => 'adm_language', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => null, "name" => "Language List",'plugin' => "admin", "controller" => "language", 'action' => 'index', "params" => null, "cls_icon" => "fas fa-globe-americas", "link" => "admin/language/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            ['code' => 'adm_localize', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => null, "name" => "Localize",'plugin' => "admin", "controller" => "localize", 'action' => 'index', "params" => null, "cls_icon" => "fas fa-language", "link" => "admin/localize/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            ['code' => 'adm_permission', 'module_id' => 1, "parent_code" => 'adm_core_data', "semi_parent_code" => null, "name" => "Permissions",'plugin' => "admin", "controller" => "permission", 'action' => 'index', "params" => null, "cls_icon" => "fad fa-concierge-bell", "link" => "admin/permission/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            ['code' => 'adm_user_role', 'module_id' => 1, "parent_code" => 'adm_core_data', "semi_parent_code" => null, "name" => "User Role",'plugin' => "admin", "controller" => "permission", 'action' => 'index', "params" => null, "cls_icon" => "fad fa-concierge-bell", "link" => "admin/permission/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],
            ['code' => 'adm_site_setting', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => null, "name" => "Site Setting",'plugin' => "admin", "controller" => "site", 'action' => 'index', "params" => null, "cls_icon" => "fad fa-concierge-bell", "link" => "admin/site/index", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 1, "ordinal" => 1],

        ];

        $listLevel3 = [

            // ================================================================== Admin Portal Level 3 ================================================================================================== //
            // Company Details
            ['code' => 'adm_company_detail', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => 'adm_company', "name" => "Company Detail",'plugin' => "admin", "controller" => "company", 'action' => 'detail', "params" => null, "cls_icon" => "fas fa-building", "link" => "admin/company/detail", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 0, "ordinal" => 1],
            // User Details
            ['code' => 'adm_user_detail', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => 'adm_user', "name" => "User Detail",'plugin' => "admin", "controller" => "user", 'action' => 'profile', "params" => null, "cls_icon" => "fas fa-user", "link" => "admin/user/profile", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 0, "ordinal" => 2],
            ['code' => 'adm_yacht_detail', 'module_id' => 1, "parent_code" => 'adm_setting', "semi_parent_code" => 'adm_yacht_list', "name" => "Yacht Detail",'plugin' => "admin", "controller" => "yacht", 'action' => 'detail', "params" => null, "cls_icon" => "fas fa-ship", "link" => "admin/yacht/detail", "is_link" => 1, "is_fullscreen" => 0, "is_ajax" => 0, "open_new_tab" => 0, "display" => 0, "ordinal" => 2],



            ///TA PORTAL



        ];

        foreach ($list as $key => $item){

            $temp = $item;
            unset($temp['code']);
            unset($temp['parent_code']);
            unset($temp['semi_parent_code']);

            $object = new FunctionMenu();
            $object = BaseService::renderObject($object, $temp);
            $object->save();

            $id = $object->id;
            $list[$key]['id'] = $id;

        }

        foreach ($listLevel2 as $key2 => $level2){

            $code = $level2['code'];
            $parent_code = $level2['parent_code'];
            $semi_parent_code = $level2['semi_parent_code'];

            $temp = $level2;
            unset($temp['code']);
            unset($temp['parent_code']);
            unset($temp['semi_parent_code']);

            $parent_id = null;

            foreach ($list as $parent){
                if($parent['code'] == $parent_code){
                    $parent_id = $parent['id'];
                    break;
                }
            }

            if(!$parent_id){
                continue;
            }

            $temp['parent_id'] = $parent_id;
            $object = new FunctionMenu();
            $object = BaseService::renderObject($object, $temp);
            $object->save();
            $id = $object->id;

            $listLevel2[$key2]['parent_id'] = $parent_id;
            $listLevel2[$key2]['id'] = $id;
        }

        foreach ($listLevel3 as $key3 => $level3){

            $code = $level3['code'];
            $parent_code = $level3['parent_code'];
            $semi_parent_code = $level3['semi_parent_code'];

            $temp = $level3;
            unset($temp['code']);
            unset($temp['parent_code']);
            unset($temp['semi_parent_code']);

            $semi_parent_id = null;
            $parent_id = null;
            foreach ($listLevel2 as $level2){
                if($level2['code'] == $semi_parent_code){
                    $parent_id = $level2['parent_id'];
                    $semi_parent_id = $level2['id'];
                    break;
                }
            }

            if(!$parent_id){
                continue;
            }

            $temp['semi_parent_id'] = $semi_parent_id;
            $temp['parent_id'] = $parent_id;

            $object = new FunctionMenu();
            $object = BaseService::renderObject($object, $temp);
            $object->save();
            $id = $object->id;

        }

    }
}
