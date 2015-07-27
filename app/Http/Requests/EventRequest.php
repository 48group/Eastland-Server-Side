<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends Request {

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
            'startDate' => 'required|date|after:today',
            'endDate' => 'required|date|after:startDate',
            'name' => 'required',
            'place' => 'required',
            'category' => 'required',
            'shopId' => 'required',
		];
	}

    public function messages()
    {
        return [
            'shopId.required' => 'The shop field is required',
        ];
    }

}
