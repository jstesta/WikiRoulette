<?php

namespace App\MediaWiki\Contracts;

/**
 * Defines the MediaWiki service interface
 */
interface MediaWiki
{
	/**
	 * Fetch random MediaWiki IDs
	 *
	 * @param int     $count
	 * @param string  $lang
	 * @return array // TODO return some interface or concrete model(s) for the result
	 */
	public function getRandomIds($count = '1', $locale = '');
}
