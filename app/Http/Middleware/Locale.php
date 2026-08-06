<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

class Locale
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
     $raw_locale = Session::get('locale');
     if (in_array($raw_locale, Config::get('app.locales'))) {
       $locale = $raw_locale;
     }
     else {
       if( Config::get('app.locale') != null ) {
         $locale = Config::get('app.locale');
       }else{
         $locale = 'ar';
       }
      }
       App::setLocale($locale);
       return $next($request);
   }
 }