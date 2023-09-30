<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Modules\EnumManager\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (RoleTypeEnum::getConstants() as $roleName) {
            $user = User::factory()->create([
                'name' => $roleName,
                'email' => $roleName . '@example.com',
                'type' => UserTypeEnum::MANAGERIAL
            ]);

            $role = Role::findOrCreate($roleName);
            $user->assignRole($role);

            if (!App::environment('test')) {
                $defaultAvatar = file_get_contents("https://fakeimg.pl/60x60?text={$user->name}");
 		$base64Avatar = base64_encode($defaultAvatar);
		$avatar = $user->addMediaFromBase64($base64Avatar)->toMediaCollection('avatar');
                $ext = 'png';
                $filename = pathinfo($avatar->file_name, PATHINFO_FILENAME);

                if ($ext) {
                   $avatar ->file_name = "{$filename}.{$ext}";
                   $avatar ->save();
               }
            }
        }
    }
}
