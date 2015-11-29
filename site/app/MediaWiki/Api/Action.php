<?php

namespace App\MediaWiki\Api;

/**
 * Marker for a MediaWiki Action
 *
 * Actions are the main endpoints to the MediaWiki API
 *
 * @see https://www.mediawiki.org/wiki/API:Main_page#A_simple_example
 */
interface Action extends \App\MediaWiki\Api\QueryStringable, \App\MediaWiki\Api\Parameterized
{
	/**
	 * Get a list of \App\MediaWiki\Api\Apis used by this Action
	 *
	 * @return array
	 */
	public function apiList();
}
