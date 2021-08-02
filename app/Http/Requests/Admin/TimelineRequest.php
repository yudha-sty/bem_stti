<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TimelineRequest extends FormRequest
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
                'title'               => 'required|string',
                'description'         => 'nullable',
                'activity_date_start' => 'required|date',
                'activity_date_end'   => 'required|date|after_or_equal:activity_date_start',
                'activity_time_start' => 'required',
                'activity_time_end'   => 'required',
                'cover'               => 'file|mimes:png,jpg,jpeg,svg,ico'
            ];
        } else {
            $rules = [
                'title'               => 'required|string',
                'description'         => 'nullable',
                'activity_date_start' => 'required|date',
                'activity_date_end'   => 'required|date|after_or_equal:activity_date_start',
                'activity_time_start' => 'required',
                'activity_time_end'   => 'required',
                'cover'               => 'required|file|mimes:png,jpg,jpeg,svg,ico'
            ];
        }

        return $rules;
    }
}
