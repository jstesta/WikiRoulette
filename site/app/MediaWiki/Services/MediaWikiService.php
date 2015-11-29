<?php

namespace App\MediaWiki\Services;

use App;

use App\MediaWiki\ApiLogic\GetRandomIds;
use App\MediaWiki\ApiLogic\GetProperties;
use App\MediaWiki\Api\Actions\QueryAction;
use App\MediaWiki\Api\Apis\ListRandomApi;
use App\MediaWiki\Api\Apis\PropInfoApi;
use App\MediaWiki\Api\Apis\PropCategoriesApi;
use App\MediaWiki\Api\Apis\PropPageImagesApi;
use App\MediaWiki\Api\Executor;

/**
 * Consumes the MediaWiki API
 */
class MediaWikiService implements \App\MediaWiki\Contracts\MediaWiki
{
	// TODO move these to application configuration vars
	private static $SERVICE_PROTOCOL = 'https';
	private static $SERVICE_DOMAIN = 'wikipedia.org';
	private static $SERVICE_PORT = '';
	private static $SERVICE_API = '/w/api.php';

	/**
	 * Fetch random MediaWiki IDs
	 *
	 * @param int     $count
	 * @param string  $locale
	 * @return array // TODO
	 */
	public function getRandomPages($count = '1', $locale = '')
	{
		$url = $this->buildAPIBaseURL();

		$apis = array();
		$apis[] = new ListRandomApi(array(ListRandomApi::PARAM_LIMIT => $count), true);
		$apis[] = new PropInfoApi();

		$action = new QueryAction(array(), $apis);

		$executor = new Executor($url, $action);

		$result[] = $executor->request();
		print_r($executor->finalUrls());
		return $result;
	}

	/**
	 * Fetch properties of the given Wiki page IDs
	 *
	 * @param array   $ids
	 * @param array   $properties
	 * @return array // TODO return some interface or concrete model(s) for the result
	 */
	public function getDetail($id)
	{
		$url = $this->buildAPIBaseURL();

		$apis = array();
		$apis[] = new PropCategoriesApi();
		$apis[] = new PropPageImagesApi();

		$action = new QueryAction(array(QueryAction::PARAM_PAGEIDS => $id), $apis);

		$executor = new Executor($url, $action);

		$result[] = $executor->request();
		print_r($executor->finalUrls());
		return $result;
	}

	/**
	 * Builds the MediaWiki API URL using the specified locale, or the
	 * current App locale if no locale is specified
	 *
	 * @return string
	 */
	private function buildAPIBaseURL($locale = '')
	{
		if ($locale == '')
		{
			$locale = App::getLocale();
		}

		// builds a string like 'https://en.wikipedia.org/w/api.php'
		return self::$SERVICE_PROTOCOL
			. '://'
			. $locale
			. '.'
			. self::$SERVICE_DOMAIN
			. self::$SERVICE_PORT
			. self::$SERVICE_API;
	}
}
