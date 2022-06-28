<?php

use App\Helpers\BaseService;
use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        $list = [
            ['name' => "View", 'description' => ""],
            ['name' => "Insert", 'description' => ""],
            ['name' => "Update", 'description' => ""],
            ['name' => "Delete", 'description' => ""],
            ['name' => "Import", 'description' => ""],
            ['name' => "Export", 'description' => ""],
            ['name' => "Analytics", 'description' => ""],
        ];

        foreach ($list as $key => $item){
            $object = new Permission();
            $object = BaseService::renderObject($object, $item);
            $object->save();
        }
    }
}
