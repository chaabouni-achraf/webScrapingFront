<?php

use Illuminate\Database\Seeder;
Use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate(); //Truncate peut causer des problémes si on utilise des clefs étrangers.
        Role::create (['name'=>'artcreator']);
        Role::create (['name'=>'frs']);
        Role::create (['name'=>'clt']);
        Role::create (['name'=>'admin']);
        Role::create (['name'=>'office']);
        
    }
}
