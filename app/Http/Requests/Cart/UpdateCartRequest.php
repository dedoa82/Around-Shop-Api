<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'user_id'       => 'exists:App\User,id',
            // 'user_id'    =>'exists:App\User,id|in:' . Auth::user()->id ,
            'quantity'      => 'integer',
            'size_id'       => 'exists:App\Models\Size,id',
            'color_id'      => 'exists:App\Models\Color,id',
        ];
    }
}
