<?php

namespace App\MediaWiki\MediaProperties;

/**
 * MediaWiki page property
 */
interface MediaProperty
{
	/**
	 * Get the URL string needed by the MediaWiki API
	 *
	 * @return string
	 */
	public function getApiURLString();

	/**
	 * Get the query parameter string needed by the MediaWiki API.
	 *
	 * These parameters define how the API behaves (ex: limiting results).
	 *
	 * @return string
	 */
	public function getApiQueryString();

	/**
	 * Get the array of extra parameters
	 *
	 * @return array
	 */
	public function getExtraParameters();
}
