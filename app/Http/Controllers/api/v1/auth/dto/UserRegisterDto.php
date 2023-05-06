<?php

namespace App\Http\Controllers\api\v1\auth\dto;

use App\Exceptions\ValidationException;
use App\Http\Responses\ApiResponse;
use Illuminate\Validation\Validator;

class UserRegisterDto
{
    public $name;
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

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    protected function validate(array $data): Validator
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        return app('validator')->make($data, $rules);
    }
}
