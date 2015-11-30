<?php

namespace App\MediaWiki\Consumers;

use App\MediaWiki\Models\RandomPageBuilder;
use App\MediaWiki\Models\Thumbnail;

class RandomPageConsumer extends \App\MediaWiki\Consumers\BaseConsumer
{
	/**
	 * Consume the decoded JSON response
	 */
	public function consume($response)
	{
		// TODO error checking & validation

		foreach ($response as $key => $value)
		{
			switch ($key)
			{
				case 'batchcomplete':
					// TODO: batches
					break;

				case 'continue':
					$this->continue = $value;
					$this->shouldContinue = true;
					// TODO: continuing queries
					break;

				case 'query':
					foreach ($value->pages as $pageId => $pageData)
					{
						$this->data[] = $this->parsePage($pageId, $pageData);
					}
					break;
			}
		}
	}

	private function parsePage($pageId, $pageData)
	{
		$builder = RandomPageBuilder::Begin($pageId);

		foreach ($pageData as $key => $value)
		{
			switch ($key)
			{
				case 'ns':
					$builder->setNs($value);
					break;

				case 'title':
					$builder->setTitle($value);
					break;

				case 'contentmodel':
					$builder->setContentModel($value);
					break;

				case 'pagelanguage':
					$builder->setPageLanguage($value);
					break;

				case 'pagelanguagehtmlcode':
					$builder->setPageLanguageHtmlCode($value);
					break;

				case 'pagelanguagedir':
					$builder->setPageLanguageDir($value);
					break;

				case 'touched':
					$builder->setTouched($value);
					break;

				case 'lastrevid':
					$builder->setLastRevId($value);
					break;

				case 'length':
					$builder->setLength($value);
					break;

				case 'displaytitle':
					$builder->setDisplayTitle($value);
					break;

				default:
					break;
			}
		}

		return $builder->build();
	}
}
