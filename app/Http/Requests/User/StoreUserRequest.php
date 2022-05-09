<?php

namespace App\Http\Requests\User;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:140'],
            'document_number' => ['required', 'unique:users', 'numeric', 'digits:11'],
            'age' => ['required', 'numeric'],
            'email' => ['required', 'unique:users', 'email'],
            'phone' => ['nullable', 'string', 'regex:/^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$/'],
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'The phone format is invalid, use: \'(XX) XXXXX-XXXX\'',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->all()], 422);
        throw new ValidationException($validator, $response);
    }
}
