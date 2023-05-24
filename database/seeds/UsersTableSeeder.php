<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $artcreatorrole = Role::where ('name', 'artCreator')->first();
        $frsrole = Role::where ('name', 'frs')->first();
        $cltrole = Role::where ('name', 'clt')->first();
        $adminrole = Role::where ('name', 'admin')->first();
        $officerole = Role::where ('name', 'office')->first();

        $artcreator = User::create([
            'name'=>'artcreator user',
            'email'=>'artcreator@artcreator.com',
            'password'=> Hash::make ('password')
        ]);

        $frs = User::create([
            'name'=>'frs user',
            'email'=>'frs@frs.com',
            'password'=> Hash::make ('password')
        ]);

        $clt= User::create([
            'name'=>'clt user',
            'email'=>'clt@clt.com',
            'password'=> Hash::make ('password')
        ]);

        $admin = User::create([
            'name'=>'admin user',
            'email'=>'admin@admin.com',
            'password'=> Hash::make ('password')
        ]);
        
        $office = User::create([
            'name'=>'office user',
            'email'=>'office@office.com',
            'password'=> Hash::make ('password')
        ]);

        $admin->roles()->attach($adminrole);
        $artcreator->roles()->attach($artcreatorrole);
        $frs->roles()->attach($frsrole);
        $clt->roles()->attach($cltrole);
        $office->roles()->attach($officerole);

    }
}
