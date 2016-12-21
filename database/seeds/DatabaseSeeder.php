<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert(array(
           'role' => 'add_auth',
           'permissions'  => '128',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
    	DB::table('roles')->insert(array(
           'role' => 'edit_auth',
           'permissions'  => '64',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
    	DB::table('roles')->insert(array(
           'role' => 'del_auth',
           'permissions'  => '32',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
      DB::table('roles')->insert(array(
           'role' => 'add_book',
           'permissions'  => '16',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
           'role' => 'edit_book',
           'permissions'  => '8',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
           'role' => 'del_book',
           'permissions'  => '4',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
           'role' => 'view_book',
           'permissions'  => '2',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
           'role' => 'view_auth',
           'permissions'  => '1',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
    	// $this->call(UsersTableSeeder::class);
    }
}
