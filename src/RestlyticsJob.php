<?php namespace Restlytics;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RestlyticsJob implements ShouldQueue
{
	use Queueable;
	use InteractsWithQueue, SerializesModels;
	
	/*
	 * API Key
	 */
	private $key;
	
	/*
	 * API Secret
	 */
	private $secret;
	
	/*
	 * Request Data
	 */
	private $data;
	
	public function __construct($apiKey, $apiSecret, $data)
	{
		$this->key = $apiKey;
		$this->secret = $apiSecret;
		$this->data = $data;
	}
	
	public function handle()
	{
		$client = new Client();
		$client->postAsync("http://api.restlytics.com/track", [
			'body' => json_encode($this->data),
			'auth' => [
				$this->key,
				$this->secret
			]
		])->wait();
	}
}
