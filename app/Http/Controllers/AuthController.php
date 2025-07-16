<?php
namespace App\Http\Controllers;

use App\Application\UseCases\Auth\LoginUseCase;
use App\Application\UseCases\Auth\RegisterUseCase;
use App\Application\DTOs\LoginDTO;
use App\Application\DTOs\RegisterDTO;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private LoginUseCase $loginUseCase,
        private RegisterUseCase $registerUseCase
    ) {}

    public function login(Request $request)
    {
        $dto = new LoginDTO(
            $request->email,
            $request->password
        );

        return $this->loginUseCase->execute($dto);
    }

    public function register(Request $request)
    {
        $dto = new RegisterDTO(
            $request->name,
            $request->email,
            $request->password
        );

        return $this->registerUseCase->execute($dto);
    }
}