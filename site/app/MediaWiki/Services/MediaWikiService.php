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
use App\MediaWiki\Consumers\RandomPageConsumer;
use App\MediaWiki\Consumers\DetailConsumer;

/**
 * Consumes the MediaWiki API
 */
class MediaWikiService implements \App\MediaWiki\Contracts\MediaWiki
{
	/**
	 * Fetch random MediaWiki IDs
	 *
	 * @param int     $count
	 * @param string  $locale
	 * @return array // TODO
	 */
	public function getRandomPages($count = '1', $locale = '')
	{
		$apis = array();
		$apis[] = new ListRandomApi(array(ListRandomApi::PARAM_LIMIT => $count), true);
		$apis[] = new PropInfoApi();

		$action = new QueryAction(array(), $apis);

		$executor = new Executor($action, $locale);
		$result = $executor->request();

		$consumer = new RandomPageConsumer();
		$consumer->consume(json_decode($result));

		return $consumer->getData();
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
		$apis = array();
		$apis[] = new PropCategoriesApi();
		$apis[] = new PropInfoApi(array(PropInfoApi::PARAM_PROP => 'url|displaytitle'));
		$apis[] = new PropPageImagesApi();

		$action = new QueryAction(array(QueryAction::PARAM_PAGEIDS => $id), $apis);

		$executor = new Executor($action);
		$result = $executor->request();

		$consumer = new DetailConsumer();
		$consumer->consume(json_decode($result));

		// print_r($executor->finalUrls());
		return $consumer->getData();
	}
}
