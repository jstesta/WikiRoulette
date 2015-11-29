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
	 * Fetch detailed info of the given Wiki page ID
	 *
	 * @param int   $id
	 * @return array // TODO return some interface or concrete model(s) for the result
	 */
	public function getDetail($id);
}
