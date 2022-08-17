<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
    public function run()
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('0123456789'),
            'roles_name' => ["owner"],
            'status' => 'نشط',
        ]);
            $role1= Role::create(['name' => 'owner']);
            $role2= Role::create(['name' => 'customer']);
            $role3= Role::create(['name' => 'provider']);
            $user->assignRole([$role1->id]);

            // add permissions owner
            $permissions = Permission::pluck('id','id')->all();
            $role1->syncPermissions($permissions);

    }
}
