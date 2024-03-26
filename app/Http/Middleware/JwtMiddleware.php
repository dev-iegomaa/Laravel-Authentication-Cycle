<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponseTrait;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    use ApiResponseTrait;
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return $this->apiResponse(422, 'Token is Invalid');
        } catch (TokenExpiredException $e) {
            return $this->apiResponse(422, 'Token is Expire');
        } catch (Exception $e) {
            return $this->apiResponse(422, 'Authorization Token not found');
        }
        return $next($request);
    }
}
