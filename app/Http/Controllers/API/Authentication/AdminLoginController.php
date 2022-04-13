<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\API\Authentication\LoginRequest;
use App\Http\Resources\API\AdminUser\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

final class AdminLoginController extends AbstractApiController
{
    private Request $request;

    private UserRepositoryInterface $userRepository;

    public function __construct(
        Request $request,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct();

        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function __invoke(LoginRequest $request)
    {
        $user = $this->userRepository->findByEmail($request->getEmail());

        if ($user === null) {
            return $this->respondUnauthorised(['message' => 'Invalid Credentials']);
        }

        try {
            $response = $this->authenticate(
                $request->getEmail(),
                $request->getPassword()
            );

            if (Arr::get($response, 'error') !== null) {
                return $this->respondError(Arr::get($response, 'message'), Response::HTTP_UNAUTHORIZED);
            }

            return response ([
                'token_type' => Arr::get($response, 'token_type'),
                'expires_in' => Arr::get($response, 'expires_in', 0),
                'access_token' => Arr::get($response, 'access_token'),
                'refresh_token' => Arr::get($response, 'refresh_token'),
                'user' => new UserResource($user),
            ])->header('Content-Type', 'application/json');
            // @codeCoverageIgnoreStart
        } catch (\Throwable $exception) {
            return $this->respondInternalError([
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ]);
            // @codeCoverageIgnoreEnd
        }
    }

    /**
     * @throws \Exception
     */
    private function authenticate(string $username, string $password): array
    {
        $request =  $this->request->create('/oauth/token', 'POST');
        $request->headers->set('Accept', 'application/json');
        $request->request->add([
            'client_id' => Config::get('auth.guards.api.client_id'),
            'client_secret' => Config::get('auth.guards.api.client_secret'),
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ]);

        $res = app()->handle($request);

        return json_decode($res->getContent(), true);
    }
}
