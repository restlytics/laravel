<?php namespace Restlytics;

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Restlytics
{
	public function handle(Request $request, Closure $next)
	{
		$response = $next($request);
		
		$currentRoute = Route::current();
		if(!$currentRoute)
		{
			return $response;
		}
		
		$method = request()->method();
		if($method == 'OPTIONS')
		{
			return $response;
		}
		
		$apiKey = config('restlytics.api_key');
		$apiSecret = config('restlytics.api_secret');
		
		if (empty($apiKey) || empty($apiSecret))
		{
			return $response;
		}
		
        $endpoint = $currentRoute->uri();
        if (in_array($endpoint, config('restlytics.ignore_endpoints', [])))
        {
            return $response;
        }

        $headers = array_filter($request->headers->all(), function($key)
        {
	        return !in_array($key, config('restlytics.ignore_headers'));
        }, ARRAY_FILTER_USE_KEY);
		
		$body = array_filter($request->all(), function($key)
		{
			return !in_array($key, config('restlytics.ignore_request_params'));
		}, ARRAY_FILTER_USE_KEY);

		
		$params = [
			'method' => $method,
			'endpoint' => $endpoint,
			'full_url' => $request->fullUrl(),
			'response_code' => $response->status(),
			'ip_address' => $request->ip(),
			'request_headers' => $headers,
            'request_body' => $body,
			'user_agent' => $request->userAgent(),
			'requested_at' => $_SERVER['REQUEST_TIME_FLOAT'],
			'time_taken' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
		];
		
		Log::info(json_encode($params));

		$client = new Client();
		$client->postAsync( config('app.url') . "/track", [
			'body' => json_encode($params),
			'auth' => [
                $apiKey,
                $apiSecret
			]
		]);

		return $response;
	}
}
