<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "firstName" => "required|max:70",
            "lastName" => "required|max:70",
            "phoneNumber" => "required|max:15",
            "gender" => "required|max:70",
            "visitortype" => "required",
            "IDNo" => "required|max:70",
            "nationalityId" => "required",
            "organizationId" => "required",
            "premisesIf" => "required",
            "description" => "required"
        ];
    }
}
