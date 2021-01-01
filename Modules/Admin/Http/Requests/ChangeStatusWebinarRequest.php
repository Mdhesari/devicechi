<?php

namespace Modules\Admin\Http\Requests;

use App\Models\Webinar\Webinar;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusWebinarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max = max(array_keys(Webinar::STATUS));
        return [
            'status' => "required|integer|min:0|max:$max"
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
