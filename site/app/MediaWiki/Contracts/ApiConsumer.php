<?php

namespace App\MediaWiki\Contracts;

/**
 * MediaWiki API consumer
 */
interface ApiConsumer
{
	/**
	 * Consume the decoded JSON response
	 */
	public function consume($response);

	/**
	 * Check if the consumed data requires further API requests
	 *
	 * @return boolean
	 */
	public function shouldContinue();

	/**
	 * Get parsed objects (typically models representing the requested data)
	 *
	 * @return array
	 */
	public function getData();
}
