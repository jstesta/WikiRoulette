<?php

namespace App\MediaWiki\ApiLogic;

use App\MediaWiki\Models\RandomIdResponse;

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
			'format' => 'json',
			'rnnamespace' => 0, // namespace '(Main)'
			'rnlimit' => $this->count,
			'utf8' => '' // make sure output is UTF-8 encoded
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

		// TODO error checking

		$decoded = json_decode($response);

		$items = array();

		foreach ($decoded->query->random as $random)
		{
			$items[] = RandomIdResponse::parseFrom($random);
		}

		return $items;
	}
}
