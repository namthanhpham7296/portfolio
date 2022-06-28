<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(FunctionMenuTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(DatabaseUserSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        Model::reguard();
    }
}
