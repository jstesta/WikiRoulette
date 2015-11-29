<?php

namespace App\MediaWiki\Api;

/**
 * Marker for a class that can represent itself as a URL query string
 */
interface QueryStringable
{
	/**
	 * Get the URL query string representation
	 *
	 * @return string
	 */
	public function asQueryString();
}
