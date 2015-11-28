<?php

namespace App\MediaWiki\ApiLogic;

use App\MediaWiki\Consumers\RandomIdsConsumer;

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
	 * @return array array of \App\MediaWiki\Models\RandomIdResponse
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

		$consumer = $this->consume($result);

		// TODO handle continuing query scenario
		// if ($consumer->shouldContinue()) ...

		return $consumer->getData();
	}

	/**
	 * Consume API response
	 *
	 * @return object \App\MediaWiki\Consumers\RandomIdsConsumer
	 */
	private function consume($response)
	{
		// TODO define errors/exceptions

		// TODO error checking

		$decoded = json_decode($response);

		$consumer = new RandomIdsConsumer();
		$consumer->consume($decoded);
		return $consumer;
	}
}
