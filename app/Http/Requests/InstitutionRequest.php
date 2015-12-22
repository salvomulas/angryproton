<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class InstitutionRequest extends Request
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
            'name'  =>  'required|min:3|max:255',
            'slug'  =>  'required|min:2|max:8',
            'address'  =>  'required|max:255',
            'city'  =>  'required|max:255',
            'zip'  =>  'required|numeric',
            'country'  =>  'required|min:2|max:80',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ein Name für die Institution wird benötigt',
            'slug.required' => 'Ein Slug für die Institution wird benötigt',
            'address.required' => 'Eine Adresse für die Institution wird benötigt',
            'city.required' => 'Eine Ortschaft für die Institution wird benötigt',
            'zip.required' => 'Eine Postleitzahl für die Institution wird benötigt',
            'country.required' => 'Ein Land für die Institution wird benötigt',
        ];
    }

}
