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
	const SESSION_LOCALE = 'locale';
	const SESSION_FORCE_RELOAD = 'force';

	// TODO: move to a configuration var and allow user to set it
	const RANDOM_PAGES = 10;

	/**
	 * The default (index) action
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, MediaWiki $mediaWiki)
	{
		if ($request->session()->has(self::SESSION_FORCE_RELOAD))
		{
			$pages = $mediaWiki->getRandomPages(self::RANDOM_PAGES);
			$request->session()->put(self::SESSION_RANDOM_PAGES, $pages);
		}
		else if ($request->session()->has(self::SESSION_RANDOM_PAGES))
		{
			$pages = $request->session()->get(self::SESSION_RANDOM_PAGES);
		}
		else
		{
			$pages = $mediaWiki->getRandomPages(self::RANDOM_PAGES);
			$request->session()->put(self::SESSION_RANDOM_PAGES, $pages);
		}

		$viewData = array(
			'lang' => config('app.locale'),
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
		$sessionKey = self::SESSION_DETAIL_PREFIX . $id;
		if ($request->session()->has($sessionKey))
		{
			$pages = $request->session()->get($sessionKey);
		}
		else
		{
			$pages = $mediaWiki->getDetail($id);
			$request->session()->put($sessionKey, $pages);
		}

		$detail = $pages[0];

		$viewData = array(
			'lang' => config('app.locale'),
			'title' => $detail->getTitle(),
			'page' => $detail,
			);

		return view('wikiroulette.detail', $viewData);
	}

	/**
	 * The refresh random pages action
	 */
	public function refresh(Request $request)
	{
		$request->session()->forget(self::SESSION_RANDOM_PAGES);

		return redirect()->action('WikiRouletteController@index');
	}

	/**
	 * The change locale action
	 */
	public function locale(Request $request, $locale)
	{
		// TODO move to configuration
		$acceptableLocales = array('en', 'ja');

		if (empty($locale) || !in_array($locale, $acceptableLocales))
		{
			$locale = config('app.fallback_locale');
		}

		$request->session()->put(self::SESSION_LOCALE, $locale);
		$request->session()->flash(self::SESSION_FORCE_RELOAD, true);

		return redirect()->action('WikiRouletteController@index');
	}
}
