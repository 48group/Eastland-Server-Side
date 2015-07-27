<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class detailRequest extends Request {

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
            'place' => 'required',
            'phone1' => 'required',
            'catId' => 'required'
		];
	}

    public function messages()
    {
        return [
            'place.required' => 'The Location field is required',
            'catId.required' => 'The Category field is required'
        ];
    }

}
