<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class engrDocumentation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'engr_cv'=>['required','mimes:pdf'],
            'workplace'=>'required',
            'jobtype'=>'required',
            'description'=>'required',
        ];
    }
}