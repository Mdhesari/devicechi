<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateAdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:4', 'max:16'],
            'description' => ['required', 'min:8'],
            'state_id' => ['required', 'exists:city_states,id'],
            'model_id' => ['required', 'exists:phone_models,id'],
            'variant_id' => ['required', 'exists:phone_variants,id'],
            'price' => ['required', 'numeric', 'regex:/^\d{1,10}\.\d{1,2}$|^\d{0,10}$/i'],
            'is_exchangeable' => ['nullable'],
            'age_id' => ['required', 'exists:phone_ages,id'],
            'contacts' => ['required', 'array', 'min:1'],
            'is_multicard' => ['nullable'],
            'accessories' => ['nullable', 'array'],
            'accessories.*' => 'exists:phone_accessories,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
