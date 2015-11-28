<?php

namespace App\MediaWiki\ApiLogic;

/**
 * Abstract class for each MediaWiki API consumed
 */
abstract class ApiLogic
{
	// TODO: move to configuration var
	const USER_AGENT = 'WikiRoulette/1.1 (https://github.com/jstesta/WikiRoulette; jstesta@gmail.com)';

	/**
	 * Make the request to the API
	 *
	 * @return mixed
	 */
	public abstract function request();

	/**
	 * Prepares a new curl object with the given URL
	 *
	 * @param string $url
	 * @return resource
	 */
	protected function prepareCurl($url)
	{
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_USERAGENT, self::USER_AGENT);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		return $curl;
	}
}
