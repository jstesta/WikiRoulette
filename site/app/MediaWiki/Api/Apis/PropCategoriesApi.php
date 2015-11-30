<?php

namespace App\MediaWiki\Api\Apis;

/**
 * MediaWiki Prop:Categories API
 */
class PropCategoriesApi extends \App\MediaWiki\Api\Apis\ApiBase
{
	const NAME = 'categories';

	const PARAM_SHOW = 'clshow';
	const PARAM_LIMIT = 'cllimit';
	const PARAM_CONTINUE = 'clcontinue';

	private $parameters = array(
		self::PARAM_SHOW => '!hidden',
		self::PARAM_LIMIT => '10',
		);

	/**
	 * PropCategories
	 *
	 * @param array $parameters an array of parameters to override
	 */
	public function __construct($parameters = array())
	{
		parent::__construct(false);

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
		return 'prop';
	}
}
