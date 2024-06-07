<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class GeneratePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will Generate Permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to update permission...');

        // Run migrations
        // $this->call('migrate:fresh');

        // Seed the database

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
                    // admin Permissions
                    'User.create',
                    'User.view',
                    'User.edit',
                    'User.delete',
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
                'group_name' => 'Course',
                'permissions' => [
                    'category.index',
                    'category.create',
                    'category.edit',
                    'category.delete',
                    'course.index',
                    'course.create',
                    'course.edit',
                    'course.delete',
                    'subject.index',
                    'subject.create',
                    'subject.edit',
                    'subject.delete',
                    'chapter.index',
                    'chapter.create',
                    'chapter.edit',
                    'chapter.delete',
                    'chapter-content.index',
                    'chapter-content.create',
                    'chapter-content.edit',
                    'chapter-content.delete',
                    'instructor.index',
                    'instructor.create',
                    'instructor.edit',
                    'instructor.delete',
                    'course-instructor.index',
                    'course-instructor.create',
                    'course-instructor.edit',
                    'course-instructor.delete',
                    'exam.index',
                    'exam.create',
                    'exam.edit',
                    'exam.delete',
                    'question.index',
                    'question.create',
                    'question.edit',
                    'question.delete',
                    'exam-score.index',
                    'exam-score.show',
                    'flash-card.index',
                    'flash-card.create',
                    'flash-card.edit',
                    'flash-card.delete'
                ]
            ],

            [
                'group_name' => 'Order',
                'permissions' => [
                    'orders.index'
                ]
            ],
            [
                'group_name' => 'Apps Version',
                'permissions' => [
                    'Version'
                ]
            ],
            [
                'group_name' => 'Feedbacks',
                'permissions' => [
                    'student-feedback.index',
                    'course-discussion.index'
                ]
            ],
            [
                'group_name' => 'All User Notification',
                'permissions' => [
                    'send-all-users',
                    'send-all-users.create',
                    'send-all-users.store'
                ]
            ],
            [
                'group_name' => 'Banner',
                'permissions' => [
                    'banner-list',
                    'banner-edit'
                ]
            ],
            [
                'group_name' => 'About Us',
                'permissions' => [
                    'about-list',
                    'about-edit'
                ]
            ],
            [
                'group_name' => 'Category-Content',
                'permissions' => [
                    'content-list',
                    'content-edit'
                ]
            ],
            [
                'group_name' => 'Contact Us',
                'permissions' => [
                    'contact-list',
                    'contact-edit'
                ]
            ],
            [
                'group_name' => 'Testimonial',
                'permissions' => [
                    'testimonial-list',
                    'testimonial-add',
                    'testimonial-edit',
                    'testimonial-delete'
                ]
            ],
            [
                'group_name' => 'Gallery',
                'permissions' => [
                    'gallery-list',
                    'gallery-add',
                    'gallery-edit',
                    'gallery-delete'
                ]
            ],
            [
                'group_name' => 'Legend',
                'permissions' => [
                    'legend.index',
                    'legend.create',
                    'legend.edit',
                    'legend.delete',
                ]
            ],
            [
                'group_name' => 'Enrollment',
                'permissions' => [
                    'enroll.index',
                    'enroll.create',
                    'enroll.delete',
                ]
            ],
            [
                'group_name' => 'Company Policy',
                'permissions' => [
                    'company-policy.index',
                    'company-policy.create',
                    'company-policy.edit',
                    'company-policy.delete',
                ]
            ],
            [
                'group_name' => 'Partner',
                'permissions' => [
                    'partner.index',
                    'partner.create',
                    'partner.edit',
                    'partner.delete'
                ]
            ],
            [
                'group_name' => 'Advertisement',
                'permissions' => [
                    'advertisement.index',
                    'advertisement.create',
                    'advertisement.edit',
                    'advertisement.delete'
                ]
            ],
            [
                'group_name' => 'Syllabus',
                'permissions' => [
                    'syllabus.index',
                    'syllabus.create',
                    'syllabus.edit',
                    'syllabus.delete'
                ]
            ],
            [
                'group_name' => 'Coupons',
                'permissions' => [
                    'coupons.index',
                    'coupons.create',
                    'coupons.edit',
                    'coupons.delete'
                ]
            ],
            [
                'group_name' => 'Coupon User',
                'permissions' => [
                    'coupon-users.index',
                    'coupon-users.create',
                    'coupon-users.edit',
                    'coupon-users.delete'
                ]
            ],
            [
                'group_name' => 'Certificate',
                'permissions' => [
                    'certificate.index',
                    'certificate.create',
                    'certificate.delete'
                ]
            ],
            [
                'group_name' => 'Certificate Settings',
                'permissions' => [
                    'certificate.settings.create',
                ]
            ],
            [
                'group_name' => 'Project Settings',
                'permissions' => [
                    'project.settings.create',
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

        // Assign super admin role permission to superadmin user
        $user = User::where('email', 'admin@sslwireless.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "Super Admin";
            $user->username = "admin";
            $user->email = "admin@sslwireless.com";
            $user->phone = "01670000000";
            $user->password = Hash::make('12345678');
            $user->status = true;
            $user->save();
        }
        $user->assignRole($roleSuperAdmin);

        // $this->call('db:seed');

        $this->info('permission updated success.');
    }
}
