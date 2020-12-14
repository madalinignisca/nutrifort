<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Food;

class UpdateFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', [Food::class, $this->food]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:255',
            'fat'           => 'required|numeric|min:0|max:100',
            'saturated_fat' => 'required|numeric|min:0|max:100',
            'carbohydrate'  => 'required|numeric|min:0|max:100',
            'sugar'         => 'required|numeric|min:0|max:100',
            'protein'       => 'required|numeric|min:0|max:100',
            'animal'        => 'required|boolean',
        ];
    }
}
