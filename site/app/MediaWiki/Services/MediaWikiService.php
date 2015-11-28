<?php

namespace App\MediaWiki\Services;

use App;

use App\MediaWiki\ApiLogic\GetRandomIds;

/**
 * Consumes the MediaWiki REST API
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
	 * @return array
	 */
	public function getRandomIds($count = '1', $locale = '')
	{
		$url = $this->buildAPIBaseURL();

		$api = new GetRandomIds($url, $count);

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
