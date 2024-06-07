<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class CreateAdminUserSeeder extends Seeder

{
    public function run(): void
    {
        $user = User::where('email', 'sarzil31@gmail.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "Mueed Hasan Sarzil";
            $user->email = "admin@gmail.com";
            $user->phone = "01846699646";
            $user->password = Hash::make('123456');
            $user->save();
        }
    }
}