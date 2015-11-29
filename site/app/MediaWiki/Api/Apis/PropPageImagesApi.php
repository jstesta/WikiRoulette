<?php

namespace App\MediaWiki\Api\Apis;

/**
 * MediaWiki Prop:PageImages API
 */
class PropPageImagesApi extends \App\MediaWiki\Api\Apis\ApiBase
{
	const NAME = 'pageimages';

	const PARAM_PROP = 'piprop';
	const PARAM_LIMIT = 'pilimit';
	const PARAM_CONTINUE = 'picontinue';

	private $parameters = array(
		self::PARAM_PROP => 'thumbnail',
		self::PARAM_LIMIT => '1',
		);

	/**
	 * PropPageImagesApi
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
