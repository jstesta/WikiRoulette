<?php

namespace App\MediaWiki\Api\Apis;

/**
 * MediaWiki List:Random API
 */
class ListRandomApi extends \App\MediaWiki\Api\Apis\ApiBase
{
	const NAME = 'random';

	const PARAM_NAMESPACE = 'rnnamespace';
	const PARAM_CONTINUE = 'rncontinue';
	const PARAM_LIMIT = 'rnlimit';

	private $parameters = array(
		self::PARAM_NAMESPACE => '0',
		self::PARAM_LIMIT => '1'
		);

	/**
	 * ListRandomApi
	 *
	 * @param array $parameters an array of parameters to override
	 * @param boolean $isGenerator
	 */
	public function __construct($parameters = array(), $isGenerator = false)
	{
		parent::__construct($isGenerator);

		$this->parameters = array_merge($this->parameters, $parameters);
	}

	/**
	 * Get the parameter list
	 *
	 * @return array
	 */
	public function parameterList()
	{
		return $this->parameters;
	}

	/**
	 * Get the API query identifier
	 */
	public function apiQueryIdentifier()
	{
		return self::NAME;
	}

	/**
	 * Get the API query name
	 */
	public function apiQueryName()
	{
		return 'list';
	}
}
