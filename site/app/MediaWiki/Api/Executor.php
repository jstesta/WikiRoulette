<?php

namespace App\MediaWiki\Api;

use App;

/**
 * Makes requests to the MediaWiki API
 *
 * TODO: Handle continuing queries
 */
class Executor
{
	// TODO move these to application configuration vars
	const SERVICE_PROTOCOL = 'https';
	const SERVICE_DOMAIN = 'wikipedia.org';
	const SERVICE_PORT = '';
	const SERVICE_API = '/w/api.php';

	// TODO: move to configuration var
	const USER_AGENT = 'WikiRoulette/1.1 (https://github.com/jstesta/WikiRoulette; jstesta@gmail.com)';

	private $baseUrl;
	private $locale;
	private $action;
	private $urls = array();

	public function __construct($action, $locale = '')
	{
		$this->locale = $locale;
		$this->action = $action;
		$this->buildAPIBaseURL($locale);
	}

	/**
	 * Perform API request
	 *
	 * @return mixed mixed array representing response data
	 */
	public function request()
	{
		$defaultParams = array(
			'format' => 'json',
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

	/**
	 * Builds the MediaWiki API URL using the specified locale, or the
	 * current App locale if no locale is specified
	 *
	 * @return string
	 */
	private function buildAPIBaseURL($locale = '')
	{
		if ($locale == '')
		{
			$locale = App::getLocale();
		}

		// builds a string like 'https://en.wikipedia.org/w/api.php'
		$this->baseUrl = self::SERVICE_PROTOCOL
			. '://'
			. $locale
			. '.'
			. self::SERVICE_DOMAIN
			. self::SERVICE_PORT
			. self::SERVICE_API;
	}
}
