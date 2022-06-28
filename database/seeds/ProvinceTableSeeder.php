<?php

use App\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->truncate();
        $jsonFilePath = public_path()."/json/province.json";
        $contents = file_get_contents($jsonFilePath);
        $contents = json_decode($contents, true);

        foreach ($contents as $key => $item){
            $object = new Province();
            $object->code = $item['code'];
            $object->name = $item['name'];
            $object->phone_code = $item['phone_code'];
            $object->save();
        }

    }
}
