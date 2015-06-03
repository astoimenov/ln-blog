<?php

namespace LittleNinja\Http\Requests;

use LittleNinja\Http\Requests\Request;

class CommentRequest extends Request
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
            'user_name' => 'required|max:255',
            'user_email' => 'required|max:255|email',
            'comment_content' => 'required'
        ];
    }
}
