<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MediaWiki\Contracts\MediaWiki;
use App\MediaWiki\MediaProperties\CategoriesProperty;
use App\MediaWiki\MediaProperties\PageImagesProperty;
use App\Bookmark;

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

	const LANGUAGES = array(
		'en' => 'English',
		'ja' => '日本語',
		'ru' => 'русский',
		'fr' => 'français',
		'nl' => 'Nederlands',
		'de' => 'Deutsch',
		'sv' => 'svenska',
		'it' => 'italiano',
		'es' => 'español',
		'pl' => 'polski',
		'zh' => '中文',
		);

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
			'languages' => self::LANGUAGES,
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

		// EXPERIMENTAL: feature to see if it's easy to link to categories
		// TODO: Move to a separate function or configuration
		$categoryUrl = 'https://' . config('app.locale') . '.wikipedia.org/wiki/';

		$viewData = array(
			'lang' => config('app.locale'),
			'title' => $detail->getTitle(),
			'page' => $detail,
			'categoryUrl' => $categoryUrl,
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
		if (empty($locale) || !array_key_exists($locale, self::LANGUAGES))
		{
			$locale = config('app.fallback_locale');
		}

		$request->session()->put(self::SESSION_LOCALE, $locale);
		$request->session()->flash(self::SESSION_FORCE_RELOAD, true);

		return redirect()->action('WikiRouletteController@index');
	}

	/**
	 * The create bookmark action
	 */
	public function bookmark(Request $request)
	{
		// Validate that the session has data
		if (!$request->session()->has(self::SESSION_RANDOM_PAGES))
		{
			return redirect()->action('WikiRouletteController@index');
		}

		// Take the RandomPage data in the user's session and store it in the db
		$pages = $request->session()->get(self::SESSION_RANDOM_PAGES);
		$pages = serialize($pages);
		$locale = config('app.locale');

		// Check if a matching bookmark already exists before creating a new one
		$existing = Bookmark::where('locale', $locale)->where('data', '=', $pages)->first();
		if (!empty($existing))
		{
			return redirect()->action('WikiRouletteController@bookmarkLoad', $existing->id);
		}

		// Make a new one
		$bookmark = new Bookmark;
		$bookmark->locale = $locale;
		$bookmark->data = $pages;
		$bookmark->save();

		return redirect()->action('WikiRouletteController@bookmarkLoad', $bookmark->id);
	}

	/**
	 * The load bookmark action
	 */
	public function bookmarkLoad(Request $request, $id)
	{
		$bookmark = Bookmark::findOrFail($id);

		$locale = $bookmark->locale;
		$pages = unserialize($bookmark->data);

		$request->session()->put(self::SESSION_LOCALE, $locale);
		$request->session()->put(self::SESSION_RANDOM_PAGES, $pages);

		$viewData = array(
			'lang' => config('app.locale'),
			'title' => 'Nice Spin!',
			'pages' => $pages,
			'languages' => self::LANGUAGES,
			);

		return view('wikiroulette.index', $viewData);
	}
}
