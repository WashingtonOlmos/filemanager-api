<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto',
            'username.max' => 'El nombre de usuario debe tener menos de 255 caracteres',
            'username.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre debe tener menos de 255 caracteres',
            'lastname.required' => 'El apellido es requerido',
            'lastname.string' => 'El apellido debe ser una cadena de texto',
            'lastname.max' => 'El apellido debe tener menos de 255 caracteres',
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo electrónico debe ser una cadena de texto',
            'email.lowercase' => 'El correo electrónico debe ser en minúsculas',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida',
            'email.max' => 'El correo electrónico debe tener menos de 255 caracteres',
            'email.unique' => 'El correo electrónico ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'La contraseña no coincide',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un símbolo especial (@$!%*?&)',
            'password_confirmation.required' => 'La confirmación de la contraseña es requerida',
        ];
    }
}
