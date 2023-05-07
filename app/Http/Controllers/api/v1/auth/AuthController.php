<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Http\Controllers\api\v1\auth\dto\UserLoginDto;
use App\Http\Controllers\api\v1\auth\dto\UserLoginResponseDTO;
use App\Http\Controllers\api\v1\auth\dto\UserRegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(Request $request)
    {

        try {
            $dto = new UserLoginDto($request->all());
            if (!$token = JWTAuth::attempt($dto->toArray())) {
                return response()->json(['error' => 'Email or password is incorrect'], 401);
            }
            $user = JWTAuth::user();

            $response = new UserLoginResponseDto(
                $token,
                'bearer',
                JWTAuth::factory()->getTTL() * 60,
                [
                    'email' => $user->email,
                    'name' => $user->name
                ]
            );
            return ApiResponse::success($response, "Auth Success");
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->getMessage());
        }

    }

    public function register(Request $request)
    {
        try {
            $dto = new UserRegisterDto($request->all());

            $user = [
                'name' => $dto->name,
                'email' => $dto->email,
                'password' => Hash::make($dto->password),
            ];

            $users = $this->userRepository->create($user);

            return ApiResponse::success($users, "Success Created Users");
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), $e->getCode(), $e->errors);
        }
    }


}
