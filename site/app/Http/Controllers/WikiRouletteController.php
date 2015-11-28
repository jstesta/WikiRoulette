<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MediaWiki\Contracts\MediaWiki;

/**
 * WikiRoulette controller
 */
class WikiRouletteController extends Controller
{
	/**
	 * The default (index) page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, MediaWiki $mediaWiki)
	{
		// FIXME just for testing
		return print_r($mediaWiki->getRandomIds());
	}
}
