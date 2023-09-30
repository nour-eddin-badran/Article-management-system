<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Modules\EnumManager\Enums\{UserStatusEnum, UserTypeEnum};

class UserService extends BaseService
{

    public function __construct(protected User $user)
    {
       parent::__construct($user);
    }

    public function getDataForDatatable()
    {
        $users = $this->getQuery()
            ->orderByDesc('id')->get();

       return $users;
    }

    public function add(UserDto $userDto): void
    {
        \DB::transaction(function () use ($userDto) {
            $user = User::create([
                'name' => $userDto->getName(),
                'email' => $userDto->getEmail(),
                'mobile' => $userDto->getMobile(),
                'password' => Hash::make($userDto->getPassword()),
                'type' => UserTypeEnum::MANAGERIAL
            ]);

            $user->syncRoles($userDto->getRoleId());
        });
    }

    /**
     * This method will be used to update admin panel users
     * @param $id
     * @throws \Throwable
     */
    public function updateUser(User $user): void
    {
        $data = $this->getDataFromRequest();

        // check password change
        if (\request('password') == $user->password) {
            unset($data['password']);
        }

        \DB::transaction(function () use ($user, $data) {
            $user->update($data);
            $user->syncRoles($data['role_id']);
        });
    }

    private function getDataFromRequest(): array
    {
        return [
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'mobile' => request()->get('mobile'),
            'password' => Hash::make(\request()->get('password')),
            'role_id' => request()->get('role_id'),
        ];
    }
}