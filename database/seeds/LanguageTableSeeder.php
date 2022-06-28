<?php

use App\Helpers\BaseService;
use App\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->truncate();

        $list = [
            ['code' => 'en','name' => "English", 'status' => 1],
            ['code' => 'vi','name' => "Vietnamese", 'status' => 1],
            ['code' => 'jp','name' => "Japan", 'status' => 1],
        ];

        foreach ($list as $key => $item){
            $object = new Language();
            $object = BaseService::renderObject($object, $item);
            $object->save();
        }
    }
}
