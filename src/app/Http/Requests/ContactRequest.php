<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        'email' => 'required | email',
        'user_id' => 'required',
        'work_start' => 'required',
        'work_end' => 'required',
        'work_date' => 'required',
        'work_id' => 'required',
        'rest_start' => 'required',
        'rest_end' => 'required',
        'rest_time' => 'required',
        ];
    }
}
