<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DocumentationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                'title'        => 'required|string',
                'description'  => 'nullable',
                'content'      => 'nullable',
                'publish_date' => 'required|date',
                'cover'        => 'file|mimes:png,jpg,jpeg,svg,ico'
            ];
        } else {
            $rules = [
                'title'        => 'required|string',
                'description'  => 'nullable',
                'content'      => 'nullable',
                'publish_date' => 'required|date',
                'cover'        => 'required|file|mimes:png,jpg,jpeg,svg,ico'
            ];
        }

        return $rules;
    }
}
