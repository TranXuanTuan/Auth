<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArtistCreateRequest extends FormRequest
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
            'artist_name' => 'required|max:100',
            'intro' => 'required|max:300',
            'category_id' => 'required',
        ];
    }

    public function messages ()
    {
        return [
            'artist_name.required' => 'Please Enter Artist Name',
            'intro.required' => 'Please Enter Intro',
            'category_id.required' => 'Please Choose Category',
        ];
    }
}
