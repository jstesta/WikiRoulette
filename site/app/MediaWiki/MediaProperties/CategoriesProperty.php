<?php

namespace App\MediaWiki\MediaProperties;

/**
 * 'API:Property/Categories' property definition
 */
class CategoriesProperty extends BaseProperty
{
	private $defaultParameters = array(
		'cllimit' => '1',
		'clshow' => '!hidden',
		);

	public function __construct($extras = array())
	{
		$this->extraParameters = array_merge($this->defaultParameters, $extras);
	}

	/**
	 * Get the URL string needed by the MediaWiki API
	 *
	 * @return string
	 */
	public function getApiURLString()
	{
		return 'categories';
	}

	public function __toString()
	{
		return 'CategoriesProperty [extraParameters=' . print_r($this->extraParameters, true) . ']';
	}
}
