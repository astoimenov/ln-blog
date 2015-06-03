<?php

namespace LittleNinja\Http\Requests;

use LittleNinja\Http\Requests\Request;

class PostRequest extends Request
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
            'post_title' => 'required|max:255',
            'post_slug' => 'required|max:255',
            'post_content' => 'required'
        ];
    }
}