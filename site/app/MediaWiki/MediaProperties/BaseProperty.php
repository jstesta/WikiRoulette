<?php

namespace App\MediaWiki\MediaProperties;

/**
 * Base MediaProperty implementation
 */
abstract class BaseProperty implements \App\MediaWiki\MediaProperties\MediaProperty
{
	protected $extraParameters = array();

	/**
	 * Get the URL string needed by the MediaWiki API
	 *
	 * @return string
	 */
	public abstract function getApiURLString();

	/**
	 * Get the query parameter string needed by the MediaWiki API.
	 *
	 * These parameters define how the API behaves (ex: limiting results).
	 *
	 * @return string
	 */
	public function getApiQueryString()
	{
		return http_build_query($this->extraParameters);
	}

	/**
	 * Get the array of extra parameters
	 *
	 * @return array
	 */
	public function getExtraParameters()
	{
		return $this->extraParameters;
	}
}
