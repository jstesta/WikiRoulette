<?php

namespace App\MediaWiki\Consumers;

/**
 * Base ApiConsumer implementation
 */
abstract class BaseConsumer implements \App\MediaWiki\Consumers\ApiConsumer
{
	protected $shouldContinue = false;
	protected $continue = array();
	protected $data = array();

	/**
	 * Consume the decoded JSON response
	 */
	public abstract function consume($response);

	/**
	 * Check if the consumed data requires further API requests
	 *
	 * @return boolean
	 */
	public function shouldContinue()
	{
		return $this->shouldContinue;
	}

	/**
	 * Get the 'continue' array returned by the API
	 *
	 * @return mixed
	 */
	public function getContinue()
	{
		return $this->continue;
	}

	/**
	 * Get parsed objects (typically models representing the requested data)
	 *
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}
}
