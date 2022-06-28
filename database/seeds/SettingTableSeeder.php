<?php

use App\Constant;
use App\Helpers\BaseService;
use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        $list = [
            ['company_id' => Constant::MASTER_COMPANY_ID, 'turn_off_recaptcha' => 1, ],
        ];

        foreach ($list as $key => $item){
            $object = new Setting();
            $object = BaseService::renderObject($object, $item);
            $object->save();
        }
    }
}
