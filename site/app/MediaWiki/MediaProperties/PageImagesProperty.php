<?php

namespace App\MediaWiki\MediaProperties;

/**
 * 'API:Property/Pageimages' property definition
 */
class PageImagesProperty extends BaseProperty
{
	private $defaultParameters = array(
		'piprop' => 'thumbnail|original',
		'pilimit' => '1',
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
		return 'pageimages';
	}

	public function __toString()
	{
		return 'PageImagesProperty [extraParameters=' . print_r($this->extraParameters, true) . ']';
	}
}
