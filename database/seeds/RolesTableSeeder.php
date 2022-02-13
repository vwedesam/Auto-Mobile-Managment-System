<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //DB::table('roles')->truncate();
        //DB::table('Role')->insert([]);
        $admin = new Role();               //-------
        $admin->name = 'admin';                //   |
        $admin->display_name = 'Admin';        //   |      
        $admin->save(); 

        $manager = new Role();              
        $manager->name = 'manager';                //   |
        $manager->display_name = 'manager';        //   |      
        $manager->save();                        //   |
                                               //   |
        $employee = new Role();                  //   |
        $employee->name = 'employee';              //   |------- Create Roles
        $employee->display_name = 'Employee';      //   |
        $employee->save(); 

        //DB::table('role_user')->truncate();

        // User1 as Admin                //----------
        $user1 = User::find(1);                //   |
        $user1->detachRole($admin);           //   |
        $user1->attachRole($admin);   

        // // User1 as Employee                //----------
        // $user1 = User::find(2);                //   |
        // $user1->detachRole($employee);           //   |
        // $user1->attachRole($employee);           

    }
}
