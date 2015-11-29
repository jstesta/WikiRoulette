<?php

namespace App\MediaWiki\Api;

/**
 * Marker for a class that has a parameter list
 */
interface Parameterized
{
	/**
	 * Get the parameter list
	 *
	 * @return array
	 */
	public function parameterList();
}
