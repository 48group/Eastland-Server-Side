<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//        return response()->json($request->route('token'));
        $t = DB::table('tokens')
            ->where('token' , $request->route('token'))
            ->first();
        if($t)
        {
            $input = $request->all();
            $input['userId'] = $t->userId;
            $request->replace($input);
            return $next($request);
        }
        else
        {
            return response()->json(['errorMessage' => 'token is not valid'],403);
        }

	}

}
