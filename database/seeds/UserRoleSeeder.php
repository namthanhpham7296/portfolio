<?php

use App\Helpers\BaseService;
use App\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->truncate();

        $list = [
            ['name' => "SupperAdmin", 'description' => "Quyền cao nhất cho phéo tạo các user dưới cấp"],
            ['name' => "Admin", 'description' => "Addmin, quyền cho phép tạo các user bên dưới"],
            ['name' => "Store Manager", 'description' => "Quản lý store cho phép tạo store"],
            ['name' => "Staff", 'description' => "Chỉ có quyền view"],
        ];

        foreach ($list as $key => $item){
            $object = new UserRole();
            $object->name = $item['name'];
            $object->description = $item['description'];

            $object->save();
        }
    }
}
