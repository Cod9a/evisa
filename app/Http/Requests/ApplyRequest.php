<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
            'type_visa' => 'required|max:255',
            'provenance' => 'required|max:255',
            'motif' => 'required|max:255',
            'passport_type' => 'required|max:255',
            'passport_num' => 'required|max:255',
            'passport_expiration' => 'required|max:255',
            'passport' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'mission' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'work' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'ticket' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'hotel' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'accommodation' => 'mimes:jpeg,png,jpg,pdf|max:512',
            'imposition' => 'mimes:jpeg,png,jpg,pdf|max:512',
        ];
    }
}
