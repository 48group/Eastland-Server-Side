<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemRequest extends Request {

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
            'name' => 'required',
            'price' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:200'
		];
	}
    public function messages()
    {
        return [
            'name.required' => 'The Item Name field is required',
            'picture.required' => 'You should choose an image',
        ];
    }

}
