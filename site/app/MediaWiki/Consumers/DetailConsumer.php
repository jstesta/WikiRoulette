<?php

namespace App\MediaWiki\Consumers;

use App\MediaWiki\Models\DetailPageBuilder;
use App\MediaWiki\Models\Thumbnail;
use App\MediaWiki\Models\Category;

class DetailConsumer extends \App\MediaWiki\Consumers\BaseConsumer
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
		$builder = DetailPageBuilder::Begin($pageId);

		foreach ($pageData as $key => $value)
		{
			switch ($key)
			{
				case 'fullurl':
					$builder->setFullUrl($value);
					break;

				case 'categories':
					$builder->setCategories($this->parseCategories($value));
					break;

				case 'displaytitle':
					$builder->setDisplayTitle($value);
					break;

				case 'thumbnail':
					$builder->setThumbnail($this->parseThumbnail($value));
					break;

				default:
					break;
			}
		}

		return $builder->build();
	}

	private function parseThumbnail($data)
	{
		foreach ($data as $key => $value)
		{
			switch ($key)
			{
				case 'source':
					$source = $value;
					break;

				case 'width':
					$width = $value;
					break;

				case 'height':
					$height = $value;
					break;

				default:
					break;
			}
		}

		return new Thumbnail($source, $width, $height);
	}

	private function parseCategories($data)
	{
		$categories = array();

		foreach ($data as $category)
		{
			unset($ns);
			unset($title);

			foreach ($category as $key => $value)
			{

				switch ($key)
				{
					case 'ns':
						$ns = $value;
						break;

					case 'title':
						$title = $value;
						break;

					default:
						break;
				}
			}

			$categories[] = new Category($ns, $title);
		}

		return $categories;
	}
}
