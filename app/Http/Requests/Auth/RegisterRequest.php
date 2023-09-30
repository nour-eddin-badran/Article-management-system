<?php

namespace App\Http\Requests\Auth;

use App\Modules\EnumManager\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => Rule::requiredIf(fn () => !\request()->has('provider')),
            'email' => Rule::requiredIf(fn () => !\request()->has('provider')) . '|email',
            'mobile' => Rule::requiredIf(fn () => !\request()->has('provider')) . '|unique:users',
            'password' => Rule::requiredIf(fn () => !\request()->has('provider')),
            'user_type' => ['required', Rule::in(UserTypeEnum::AUTHOR, UserTypeEnum::MANAGERIAL)],
            'role_id' => Rule::requiredIf(fn () => \request()->get('user_type') == UserTypeEnum::MANAGERIAL),
        ];
    }
}
