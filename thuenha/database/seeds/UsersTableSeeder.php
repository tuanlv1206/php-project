<?php
use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;
class UsersTableSeeder extends seeder
{
  public function run()
  {
    DB::statement('set foreign_key_checks=0;');
    Permission::truncate();
    Role::truncate();
    User::truncate();
    DB::table('role_user')->delete();
    DB::table('permission_role')->delete();

    // Initialize values
    $values = array(
      array('name' => 'Ngô Thành Vinh', 'email' => 'nanyangbk@gmail.com', 'password' => Hash::make('mickey02')),
      array('name' => 'Nguyễn Anh Quân', 'email' => 'quanchimbe@gmail.com', 'password' => Hash::make('mickey02')),
    );

    // Mass insert to the users table
    DB::table('users')->insert($values);

    //create a user
    $adminu = User::create([
                  'name' => 'tuanlv',
                  'email' => 'tuanlv1206@gmail.com',
                  'password' => bcrypt('123456'),
              ]);

    //create a role of admin
    $admin = Role::create([
        'name' => 'admin',
        'display_name' => 'Admin',
        'description' => 'Admin have permission to manage all action',
    ]);
    //create a permission for role
    $manage_users = Permission::create([
        'name' => 'manage-users-roles-and-permissions',
        'display_name' => 'Manage Users,Roles and Permissions',
        'description' => 'Can manage users,roles and permission"s',
    ]);
    //here attaching permission for admin role
    $admin->attachPermission($manage_users);
    //here attaching role for user
    $adminu->attachRole($admin);

    //here iam creating register role and permisssion
    $register = Role::create([
        'name' => 'inforegister',
        'display_name' => 'InfoRegister',
        'description' => 'This has full control on registering info',
    ]);
    $registerpermission = Permission::create([
        'name' => 'inforegisterpermission',
        'display_name' => 'InfoRegisterPermission',
        'description' => 'This has permission to register info',
    ]);
    //here attaching register roles and permissions
    $register->attachPermission($registerpermission);
    $adminu->attachRole($register);

    //here iam creating approve role and permisssion
    $approve = Role::create([
        'name' => 'approver',
        'display_name' => 'InfoApprove',
        'description' => 'This has full control on approving info',
    ]);
    $approvepermission = Permission::create([
        'name' => 'approvepermission',
        'display_name' => 'ApprovePermission',
        'description' => 'This has permission to approve info',
    ]);
    //here attaching register roles and permissions
    $approve->attachPermission($approvepermission);
    $adminu->attachRole($approve);
  }
}
