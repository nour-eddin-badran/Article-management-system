<?php

namespace App\Http\Requests\Article;

use App\Modules\EnumManager\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class AddArticleRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'cover' => 'required',
        ];
    }
}
