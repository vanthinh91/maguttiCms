<?php namespace App\MaguttiCms\Middleware;
use Closure;
use Illuminate\Foundation\Application;

use App\MaguttiCms\Tools\JsonResponseTrait;

class Localization
{

    use JsonResponseTrait;

    /**
     * Localization constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // read the language from the request header
        $locale = ($request->has('lang'))? strtolower($request->lang) : $this->app->config->get('app.locale');
        // check the languages defined is supported
        if (!array_key_exists($locale, $this->app->config->get('app.locales'))) {
            // respond with error
            // at the moment  do notihg
            $this->setError(true);
            $this->setHttpStatus(422);
            $this->setMsg( __('api.errors.invalid_data')  );
            return $this->apiResponse();
            die();

        }

        // set the local language
        $this->app->setLocale($locale);
        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', $locale);

        // return the response
        return $response;
    }
}