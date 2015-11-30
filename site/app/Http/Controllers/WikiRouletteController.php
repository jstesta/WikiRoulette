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
	const SESSION_RANDOM_PAGES = 'randompages';
	const SESSION_DETAIL_PREFIX = 'detail_';

	/**
	 * The default (index) action
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, MediaWiki $mediaWiki)
	{
		// FIXME just for testing
		if ($request->session()->has(self::SESSION_RANDOM_PAGES))
		{
			$pages = $request->session()->get(self::SESSION_RANDOM_PAGES);
		}
		else
		{
			$pages = $mediaWiki->getRandomPages(10);
			$request->session()->put(self::SESSION_RANDOM_PAGES, $pages);
		}

		$viewData = array(
			'title' => 'Nice Spin!',
			'pages' => $pages,
			);

		return view('wikiroulette.index', $viewData);
	}

	/**
	 * The detail view action
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function detail(Request $request, MediaWiki $mediaWiki, $id)
	{
		// FIXME just for testing
		$sessionKey = self::SESSION_DETAIL_PREFIX . $id;
		if ($request->session()->has($sessionKey))
		{
			$detail = $request->session()->get($sessionKey);
		}
		else
		{
			$detail = $mediaWiki->getDetail($id);
			$request->session()->put($sessionKey, $detail);
		}

		echo $detail[0];
		echo "<br /><br />";
	}

	/**
	 * The refresh random pages action
	 */
	public function refresh(Request $request)
	{
		$request->session()->forget(self::SESSION_RANDOM_PAGES);

		return redirect()->action('WikiRouletteController@index');
	}
}
