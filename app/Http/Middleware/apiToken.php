<?php

namespace App\Http\Middleware;
use App\User;

use Closure;

class apiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		 if(!filter_has_var(INPUT_SERVER, 'HTTP_AUTHORIZATION')) {
            return $this->sendError('Please Login', '', $code = 401, '');
        }
        $api_token=$request->bearerToken();//filter_input(INPUT_SERVER, 'HTTP_AUTHORIZATION');strpos($url, 'user') !== false
        $author=User::where('api_token', $api_token)->first();
		if(is_null($author)){
            return $this->sendError('No Such Author', '',$code=401,'');
        }
        return $next($request);
    }
	public function sendError($error, $errorMessages = [], $code =200)
    {
        $response = [
            'error' => true,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $respone['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
