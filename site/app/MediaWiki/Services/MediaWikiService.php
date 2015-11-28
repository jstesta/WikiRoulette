<?php

namespace App\MediaWiki\Services;

use App;

use App\MediaWiki\ApiLogic\GetRandomIds;
use App\MediaWiki\ApiLogic\GetProperties;

/**
 * Consumes the MediaWiki API
 */
class MediaWikiService implements \App\MediaWiki\Contracts\MediaWiki
{
	// TODO move these to application configuration vars
	private static $SERVICE_PROTOCOL = 'https';
	private static $SERVICE_DOMAIN = 'wikipedia.org';
	private static $SERVICE_PORT = '';
	private static $SERVICE_API = '/w/api.php';

	/**
	 * Fetch random MediaWiki IDs
	 *
	 * @param int     $count
	 * @param string  $locale
	 * @return array array of \App\MediaWiki\Models\RandomIdResponse
	 */
	public function getRandomIds($count = '1', $locale = '')
	{
		$url = $this->buildAPIBaseURL();

		$api = new GetRandomIds($url, $count);

		return $api->request();
	}

	/**
	 * Fetch properties of the given Wiki page IDs
	 *
	 * @param array   $ids
	 * @param array   $properties
	 * @return array // TODO return some interface or concrete model(s) for the result
	 */
	public function getProperties($ids, $properties)
	{
		$url = $this->buildAPIBaseURL();

		$api = new GetProperties($url, $ids, $properties);

		return $api->request();
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
		return self::$SERVICE_PROTOCOL
			. '://'
			. $locale
			. '.'
			. self::$SERVICE_DOMAIN
			. self::$SERVICE_PORT
			. self::$SERVICE_API;
	}
}
