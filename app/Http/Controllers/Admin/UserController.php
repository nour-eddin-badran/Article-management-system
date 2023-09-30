<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\UserDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function __construct(private Request $request, private UserService $userService) {
        parent::__construct($request);
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $users = $this->userService->getDataForDatatable();

            return prepareDataTable($users, 'users');
        }

        return view('pages.user.index', [
            'roles' => getRoles()
        ]);
    }


    public function store(RegisterRequest $request)
    {
        $this->userService->add(new UserDto(
            $request->name,
            $request->email,
            $request->mobile,
            $request->password,
            $request->role_id
        ));

        return \response([], Response::HTTP_OK);
    }

    public function edit(User $user)
    {
        $userRoleId = $user->roles->first() ? $user->roles->first()->id : null;

        return view('pages.user.update', [
            'user' => $user,
            'roles' => getRoles(),
            'user_role_id' => $userRoleId
        ]);
    }

    public function update(User $user)
    {
        $this->userService->updateUser($user);

        return redirect()->to(route('users.edit', $user->id));
    }


    public function blockToggle(int $userId)
    {
        $this->userService->blockToggle($userId);

        return redirect()->back();
    }

    public function activationToggle(int $userId)
    {
        $this->userService->activationToggle($userId);

        return redirect()->back();
    }

    public function destroy(int $userId)
    {
        $this->userService->destroy($userId);

        return $this->successResponse();
    }
}