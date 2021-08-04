<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
class UpdatePostRequest extends FormRequest
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
            'title' => 'required|between:5,100',
            'post_image' => 'nullable|file|mimes:jpg,png,gif',
            'body' => 'required|string|max:10000',
            'delete_image' => 'nullable',
            'category_id' => 'required|numeric',
        ];
    }
}
