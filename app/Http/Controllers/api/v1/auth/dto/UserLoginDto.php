<?php

namespace App\Http\Controllers\api\v1\auth\dto;

use App\Exceptions\ValidationException;
use Illuminate\Validation\Validator;

class UserLoginDto
{
    public $email;
    public $password;

    /**
     * @throws ValidationException
     */
    public function __construct($data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException("Bad Request", 400, $validator->errors()->all());
        }

        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    protected function validate(array $data): Validator
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ];

        return app('validator')->make($data, $rules);
    }

    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
