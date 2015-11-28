<?php

namespace App\MediaWiki\ApiLogic;

/**
 * ApiLogic: 'API:Properties'
 *
 * Reference: https://www.mediawiki.org/wiki/API:Properties
 */
class GetProperties extends ApiLogic
{
	private $baseUrl;
	private $pageIds;
	private $properties;

	public function __construct($baseUrl, $pageIds, $properties)
	{
		$this->baseUrl = $baseUrl;
		$this->pageIds = $pageIds;
		$this->properties = $properties;
	}

	/**
	 * Perform API request
	 *
	 * @return mixed // TODO define an interface or concrete type for the result
	 */
	public function request()
	{
		// TODO split into multiple requests

		$query = array(
			'action' => 'query',
			'prop' => $this->buildPropertiesString(),
			'format' => 'jsonfm', // debug
			'utf8' => '', // make sure output is UTF-8 encoded
			'continue' => '', // use continuing queries
			'pageids' => implode('|', $this->pageIds),
			);

		$url = $this->baseUrl . '?' . http_build_query($query) . '&' . $this->buildExtraQueryString();

		$curl = $this->prepareCurl($url);
		$result = array($url);
		$result = curl_exec($curl);
		curl_close($curl);

		return $this->consume($result);
	}

	/**
	 * Consume API response
	 *
	 * @return mixed // TODO define an interface or concrete type for the result
	 */
	private function consume($response)
	{
		// TODO consume JSON response
		// TODO define errors/exceptions

		// TODO error checking

		return $response;
	}

	/**
	 * Build the string of properties to get, suitable for the URL
	 *
	 * Builds a string like 'categories|pageimages'
	 *
	 * @return string
	 */
	private function buildPropertiesString()
	{
		$strings = array();

		foreach ($this->properties as $property)
		{
			$strings[] = $property->getApiURLString();
		}

		return implode('|', $strings);
	}

	/**
	 * Build the string of extra query parameters, suitable for the URL
	 *
	 * Builds a string like 'cllimit=1&clshow=!hidden&piprop=thumbnail'
	 *
	 * @return string
	 */
	private function buildExtraQueryString()
	{
		$strings = array();

		foreach ($this->properties as $property)
		{
			$strings[] = $property->getApiQueryString();
		}

		return implode('&', $strings);
	}
}
