<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserRoleMiddleware
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
        

        $currentActionName = $request->route()->getActionName();

        list($controller, $method) = explode('@', $currentActionName);

        $controller = str_replace(["App\\Http\\Controllers\\", "Controller"], "", $controller);

        if( $request->user()->hasRole('employee') ) {

            if(  $method == 'update' || $method == 'edit' || $method == 'destroy'  ){
                
                return redirect()->route('dashboard')->with('error-message', 'Request Failed!');

            }elseif ( $controller == 'User' || $controller == 'Model' || $controller == 'Make' || $controller == 'ProductName' || $controller == 'DealerInfo' ) {
                return redirect()->route('dashboard')->with('error-message', 'Request Failed!');
            }
            
        }elseif( $request->user()->hasRole('manager') ) {

            if( $method == 'destroy'  ){
                
                return redirect()->route('dashboard')->with('error-message', 'Request Failed!');

            }
        }

        return $next($request);
    }
}
