<?php

namespace App\MediaWiki\Consumers;

use App\MediaWiki\Models\RandomIdResponse;

/**
 * RandomIdsConsumer
 *
 * Logic to consume a MediaWiki API:Random response
 */
class RandomIdsConsumer extends BaseConsumer
{
	public function consume($response)
	{
		// TODO error checking & validation

		foreach ($response->query->random as $random)
		{
			$this->data[] = RandomIdResponse::parseFrom($random);
		}
	}
}
