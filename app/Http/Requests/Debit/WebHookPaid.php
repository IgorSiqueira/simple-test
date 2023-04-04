<?php

namespace App\Http\Requests\Debit;

use Illuminate\Foundation\Http\FormRequest;

class WebHookPaid extends FormRequest
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
            'debit_id'=>['required','integer','exists:debits,id'],
            'paid_at'=>['required','date_format:Y-m-d H:i:s'],
            'paid_amount'=>['required','regex:/^\d+(\.\d{1,2})?$/'],
            'paid_by'=>['required','string','max:150']
        ];
    }
    
    public function messages()
    {
        return [
            'paid_amount.regex'=>__('validation.double'),
        ];
    }
}
