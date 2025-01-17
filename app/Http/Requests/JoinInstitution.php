<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoinInstitution extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && !auth()->user()->is_banned;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'joincode' => 'required|max:12|min:3|string'
        ];
    }
}
