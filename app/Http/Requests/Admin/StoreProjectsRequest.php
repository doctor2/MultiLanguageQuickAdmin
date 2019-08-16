<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectsRequest extends FormRequest
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
            'title_en' => 'required',
            'additional_en' => 'required',
            'preview_image' => 'sometimes|required|image|mimes:jpg,jpeg,png',
            'year' => 'integer',
            'order' => 'max:2147483647|nullable|numeric',
        ];
    }
}
