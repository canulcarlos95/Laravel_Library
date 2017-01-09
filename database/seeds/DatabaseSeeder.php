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
      DB::table('permissions')->insert(array(
          'id'  => '128',
          'name' => 'add_auth',
          'created_at' => date('Y-m-d H:m:s'),
          'updated_at' => date('Y-m-d H:m:s')
    	));
    	DB::table('permissions')->insert(array(
           'id'  => '64',
           'name' => 'edit_auth',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
    	DB::table('permissions')->insert(array(
           'id'  => '32',
           'name' => 'del_auth',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
      DB::table('permissions')->insert(array(
           'id'  => '16',
           'name' => 'add_book',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('permissions')->insert(array(
           'id'  => '8',
           'name' => 'edit_book',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('permissions')->insert(array(
           'id'  => '4',
           'name' => 'del_book',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('permissions')->insert(array(
           'id'  => '2',
           'name' => 'view_book',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('permissions')->insert(array(
           'id'  => '1',
           'name' => 'view_auth',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
        'id'  => '1',
        'role'  => 'Author',
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
      ));
    	DB::table('roles')->insert(array(
        'id'  => '2',
        'role'  => 'Editorial',
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('roles')->insert(array(
        'id'  => '3',
        'role'  => 'Guest',
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '1',
        'perm_id'=>'1'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '1',
        'perm_id'=>'2'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '1',
        'perm_id'=>'4'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '1',
        'perm_id'=>'8'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '1',
        'perm_id'=>'16'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'1'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'2'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'4'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'8'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'16'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'32'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'64'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '2',
        'perm_id'=>'128'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '3',
        'perm_id'=>'1'
      ));
      DB::table('perm_role')->insert(array(
        'role_id'  => '3',
        'perm_id'=>'2'
      ));
      DB::table('editorials')->insert(array(
        'name'  => 'Independent',
        'email'  => 'Empty',
        'created_at' => date('Y-m-d H:m:s'),
        'updated_at' => date('Y-m-d H:m:s')
      ));
    }
}
