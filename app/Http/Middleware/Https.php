<?php
namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\App as FacadesApp;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Redirect;

class UseSSL
{

    public function handle($request, Closure $next)
    {
        if( App::environment('local') ){
            return Redirect::secure($request->path());
        }

        return $next($request);
    }
}
