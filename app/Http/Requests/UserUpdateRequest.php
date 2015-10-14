<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
        $id = $this->segment(2);
        return [
            'firstName' => 'required|max:255' . $id,
            'lastName'  => 'required|max:255' . $id,
            'email'     => 'required|email|max:255|unique:users' . $id,
            'password'  => 'required|confirmed|min:6' . $id,
            'profile_type'    => 'required' . $id,
        ];
    }
}
