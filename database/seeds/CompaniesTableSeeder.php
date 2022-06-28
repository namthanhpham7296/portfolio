<?php

use App\Constant;
use App\Helpers\BaseService;
use App\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->truncate();

        $list = [
            ['name' => "Master Company", 'address' => "364 Noname road", "email" => 'namthanhpham7296@gmail.com', 'phone_number' => "0342876982", 'status' => Constant::STATUS_ACTIVE],
        ];

        foreach ($list as $key => $item){
            $object = new Company();
            $object = BaseService::renderObject($object, $item);
            $object->save();
        }
    }
}
