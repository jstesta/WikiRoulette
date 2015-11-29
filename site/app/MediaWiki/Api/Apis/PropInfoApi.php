<?php

namespace App\MediaWiki\Api\Apis;

/**
 * MediaWiki Prop:Info API
 */
class PropInfoApi extends \App\MediaWiki\Api\Apis\ApiBase
{
	const NAME = 'info';

	const PARAM_PROP = 'inprop';
	const PARAM_CONTINUE = 'incontinue';

	private $parameters = array(
		self::PARAM_PROP => 'displaytitle',
		);

	/**
	 * PropInfoApi
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
