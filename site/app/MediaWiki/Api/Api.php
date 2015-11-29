<?php

namespace App\MediaWiki\Api;

/**
 * Marker for a MediaWiki parameterized API
 */
interface Api extends \App\MediaWiki\Api\QueryStringable, \App\MediaWiki\Api\Parameterized
{
	/**
	 * Whether this API is a generator or not
	 *
	 * @return boolean
	 * @see https://www.mediawiki.org/wiki/API:Query#Generators
	 */
	public function isGenerator();
}
