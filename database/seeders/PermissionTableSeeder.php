<?php



namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionTableSeeder extends Seeder

{

    public function run()
    {

        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    'User-create',
                    'User-view',
                    'User-edit',
                    'User-delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role-list',
                    'role-create',
                    'role-edit',
                    'role-delete',
                ]
            ],
            [
                'group_name' => 'settigs',
                'permissions' => [
                    'settings-create'
                ]
            ],

            [
                'group_name' => 'employees',
                'permissions' => [
                    'employees.list',
                ]
                ],

            [
                'group_name' => 'event',
                'permissions' => [
                    'event.list',
                ]
                ],

                [
                    'group_name' => 'designation',
                    'permissions' => [
                        'designation.list',
                    ]
                    ],

                    [
                        'group_name' => 'expense',
                        'permissions' => [
                            'expense.list',
                        ]
                        ],
                        [
                            'group_name' => 'Department',
                            'permissions' => [
                                'department.list',
                            ]
                            ],

                            [
                                'group_name' => 'Payment',
                                'permissions' => [
                                    'payment.list',
                                ]
                                ],
    


        ];
        // Do same for the admin guard for tutorial purposes

        $roleSuperAdmin = Role::firstOrCreate([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::firstOrCreate(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
        // DB::table('model_has_roles')->insertOrUpdate([
        //     'role_id' => 1,
        //     'model_id' => 1,
        //     'model_type' => 'App\Models\User'
        // ]);
        // Assign super admin role permission to superadmin user
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }
}
