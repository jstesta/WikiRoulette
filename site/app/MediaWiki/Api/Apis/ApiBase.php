<?php

namespace App\MediaWiki\Api\Apis;

/**
 * Base implementation of \App\MediaWiki\Api\Api
 */
abstract class ApiBase implements \App\MediaWiki\Api\Api
{
	private $isGenerator = false;

	/**
	 * ApiBase
	 *
	 * @param boolean $isGenerator
	 */
	public function __construct($isGenerator = false)
	{
		$this->isGenerator = $isGenerator;
	}

	/**
	 * Check if this is a generator or not
	 *
	 * @return boolean
	 */
	public function isGenerator()
	{
		return $this->isGenerator;
	}

	/**
	 * Get the URL query string representation
	 *
	 * @return string
	 */
	public function asQueryString()
	{
		$queryStrings = array();
		$params = array();

		// add the api parameters
		$prefix = $this->isGenerator() ? 'g' : '';
		foreach ($this->parameterList() as $paramKey => $paramValue)
		{
			$params[$prefix . $paramKey] = $paramValue;
		}

		// build and return the query string
		return http_build_query($params);
	}

	/**
	 * Get the API query identifier
	 */
	public abstract function apiQueryIdentifier();

	/**
	 * Get the API query name
	 */
	public abstract function apiQueryName();
}
