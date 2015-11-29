<?php

namespace App\MediaWiki\Api;

/**
 * Makes requests to the MediaWiki API
 *
 * TODO: Handle continuing queries
 */
class Executor
{
	// TODO: move to configuration var
	const USER_AGENT = 'WikiRoulette/1.1 (https://github.com/jstesta/WikiRoulette; jstesta@gmail.com)';

	private $baseUrl;
	private $action;
	private $urls = array();

	public function __construct($baseUrl, $action)
	{
		$this->baseUrl = $baseUrl;
		$this->action = $action;
	}

	/**
	 * Perform API request
	 *
	 * @return mixed mixed array representing response data
	 */
	public function request()
	{
		$defaultParams = array(
			'format' => 'jsonfm',
			'utf8' => '' // make sure output is UTF-8 encoded
			);

		$query = array();
		$query[] = http_build_query($defaultParams);
		$query[] = $this->action->asQueryString();

		// build the final URL
		$url = $this->baseUrl . '?' . implode('&', $query);

		$curl = $this->prepareCurl($url);
		$result = curl_exec($curl);
		curl_close($curl);

		// TODO: handle continuing query scenario

		// TODO: handle errors

		$this->urls[] = $url;

		return $result;
	}

	/**
	 * Prepares a new cURL object with the given URL
	 *
	 * @param string $url
	 * @return resource
	 */
	private function prepareCurl($url)
	{
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		return $curl;
	}

	/**
	 * Get all the URLs requested by this Executor
	 *
	 * @return array
	 */
	public function finalUrls()
	{
		return $this->urls;
	}
}
