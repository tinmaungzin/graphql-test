<?php

namespace App\Http\Middleware;

use Closure;

class ModifyHeadersMiddleware
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
//        $response = $next( $request );
//        $response->header( 'Access-Control-Allow-Origin', '*' );
//        $response->header( 'Access-Control-Allow-Headers', 'Origin, Content-Type' );
//        return $response;


        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type,X-Token-Auth, Authorization');


//        $response = $next($request);
//        if (!$request->isMethod('OPTIONS')) {
//            return $response;
//        }
//        $allow = $response->headers->get('Allow'); // true list of allowed methods
//        if (!$allow) {
//            return $response;
//        }
//        $headers = [
//            'Access-Control-Allow-Methods' => $allow,
//            'Access-Control-Max-Age' => 3600,
//            'Access-Control-Allow-Headers' => 'X-Requested-With, Origin, X-Csrftoken, Content-Type, Accept',
//        ];
//        return $response->withHeaders($headers);


//        if ($request->isMethod('OPTIONS')){
//            $response = Response::make();
//        } else {
//            $response = $next($request);
//        }
//        return $response
//            ->header('Access-Control-Allow-Origin', '*')
//            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');




    }
}
