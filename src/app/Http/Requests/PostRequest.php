<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            //投稿画像のバリデーション。必須、ファイルの種類、形式、最大6MB
            'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:6000',
            //キャプションのバリデーション。必須、最大200文字
            'caption' => 'required|max:200'
        ];
    }
}
