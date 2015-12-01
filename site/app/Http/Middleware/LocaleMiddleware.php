<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\WikiRouletteController;

/**
 * Set the app locale if in the user's session
 */
class LocaleMiddleware
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
		if ($request->session()->has(WikiRouletteController::SESSION_LOCALE))
		{
			$locale = $request->session()->get(WikiRouletteController::SESSION_LOCALE);
			config(['app.locale' => $locale]);
		}

		return $next($request);
	}
}
