<?php

namespace App\MediaWiki\Api\Actions;

/**
 * The MediaWiki Query Action
 *
 * @see https://www.mediawiki.org/wiki/API:Query
 */
class QueryAction implements \App\MediaWiki\Api\Action
{
	const NAME = 'query';

	const PARAM_CONTINUE = 'continue';
	const PARAM_PAGEIDS = 'pageids';
	const PARAM_REDIRECTS = 'redirects';
	const PARAM_GENERATOR = 'generator';

	private $parameters;
	private $apis;

	/**
	 * QueryAction
	 *
	 * @param array $parameters an array of parameters to override
	 * @param array $apis an array of \App\MediaWiki\Api\Api
	 */
	public function __construct($parameters = array(), $apis = array())
	{
		$this->parameters = $parameters;
		$this->apis = $apis;
	}

	/**
	 * Get a list of \App\MediaWiki\Api\Api used by this Action
	 *
	 * @return array
	 */
	public function apiList()
	{
		return $this->apis;
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
	 * Get the URL query string representation
	 *
	 * @return string
	 */
	public function asQueryString()
	{
		$queryStrings = array();
		$params = array();

		// add the action param
		$params['action'] = self::NAME;

		// add the action parameters
		$params = array_merge($params, $this->parameterList());

		// add this action's query string
		$queryStrings[] = http_build_query($params);

		// build the api query strings
		$apiKey = array();
		foreach ($this->apiList() as $api)
		{
			$queryStrings[] = $api->asQueryString();

			if ($api->isGenerator())
			{
				$apiKey[self::PARAM_GENERATOR][] = $api->apiQueryIdentifier();
			}
			else
			{
				$apiKey[$api->apiQueryName()][] = $api->apiQueryIdentifier();
			}
		}

		$apis = array();
		foreach ($apiKey as $key => $v)
		{
			$apis[$key] = implode('|', $v);
		}
		$queryStrings[] = http_build_query($apis);

		// build and return the query string
		return implode('&', $queryStrings);
	}
}
