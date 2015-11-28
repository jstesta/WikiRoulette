<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MediaWiki\Contracts\MediaWiki;
use App\MediaWiki\MediaProperties\CategoriesProperty;
use App\MediaWiki\MediaProperties\PageImagesProperty;

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

	/**
	 * The detail view page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function detail(Request $request, MediaWiki $mediaWiki, $id)
	{
		// FIXME just for testing
		$c = new CategoriesProperty();
		$i = new PageImagesProperty();
		return print_r($mediaWiki->getProperties(array($id), array($c, $i)));
	}
}
