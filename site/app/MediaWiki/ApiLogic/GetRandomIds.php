<?php

namespace App\MediaWiki\ApiLogic;

/**
 * ApiLogic: 'API:Random'
 *
 * Reference: https://www.mediawiki.org/wiki/API:Random
 */
class GetRandomIds extends ApiLogic
{
	private $baseUrl;
	private $count;

	public function __construct($baseUrl, $count)
	{
		$this->baseUrl = $baseUrl;
		$this->count = $count;
	}

	/**
	 * Perform API request
	 *
	 * @return mixed // TODO define an interface or concrete type for the result
	 */
	public function request()
	{
		$query = array(
			'action' => 'query',
			'list' => 'random',
			// 'format' => 'json', // debugging
			'rnnamespace' => 0,
			'rnlimit' => $this->count,
			);

		$url = $this->baseUrl . '?' . http_build_query($query);

		$curl = $this->prepareCurl($url);
		$result = array($url);
		$result = curl_exec($curl);
		curl_close($curl);

		return $this->consume($result);
	}

	/**
	 * Consume API response
	 *
	 * @return mixed // TODO define an interface or concrete type for the result
	 */
	private function consume($response)
	{
		// TODO consume JSON response
		// TODO define errors/exceptions

		return $response;
	}
}
