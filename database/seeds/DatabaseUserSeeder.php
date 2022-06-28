<?php

use App\Constant;
use App\Helpers\BaseService;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $list = [
            ['name' => "Master Admin", 'email' => "admin@gmail.com", 'password' => "Vtm4test@", "is_admin" => Constant::MASTER_ADMIN, 'company_id' => Constant::MASTER_COMPANY_ID],
            ['name' => "Customer Admin", 'email' => "helen@gmail.com", 'password' => "Vtm4test@", "is_admin" => Constant::CUSTOMER_ADMIN, 'company_id' => Constant::MASTER_COMPANY_ID],
        ];
        foreach($list as $key => $item){
            $object = new User();
            $password = $item['password'];
            $item['password'] = bcrypt($password);
            $object = BaseService::renderObject($object, $item);
            $object->save();
        }
    }
}
