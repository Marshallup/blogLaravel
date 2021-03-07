<?php

namespace App\Http\Requests;

use App\Rules\UserSameAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore(Auth::user()->id)
//                new UserSameAttribute,
//                'unique:users'
            ],
            'thumbnail' => 'nullable|image|file|max:1000'
        ];
    }
}
