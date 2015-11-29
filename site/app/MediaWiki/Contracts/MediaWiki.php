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
	 * @param string  $locale
	 * @return array array of \App\MediaWiki\Models\RandomIdResponse
	 */
	public function getRandomPages($count = '1', $locale = '');

	/**
	 * Fetch properties of the given Wiki page IDs
	 *
	 * @param array   $ids
	 * @param array   $properties
	 * @return array // TODO return some interface or concrete model(s) for the result
	 */
	public function getProperties($ids, $properties);
}
