<?php

namespace App\Http\Controllers\api\v1\auth\dto;

class UserLoginResponseDTO
{
    public $access_token;
    public $token_type;
    public $expires_in;
    public $user;

    public function __construct($access_token, $token_type, $expires_in, $user)
    {
        $this->access_token = $access_token;
        $this->token_type = $token_type;
        $this->expires_in = $expires_in;
        $this->user = $user;
    }
}
