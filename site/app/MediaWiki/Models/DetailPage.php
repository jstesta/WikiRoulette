<?php

namespace App\MediaWiki\Models;

use App\MediaWiki\Models\DetailPageBuilder;

/**
 * DetailPage model
 */
class DetailPage
{
	private $id;
	private $displayTitle;
	private $fullUrl;
	private $categories;
	private $thumbnail;
	private $title;

	/**
	 * DetailPage constructor from builder
	 */
	public function __construct(DetailPageBuilder $b)
	{
		$this->id = $b->getId();
		$this->title = $b->getTitle();
		$this->displayTitle = $b->getDisplayTitle();
		$this->fullUrl = $b->getFullUrl();
		$this->categories = $b->getCategories();
		$this->thumbnail = $b->getThumbnail();
	}

	function getId()
	{
		return $this->id;
	}

	function getTitle()
	{
		return $this->title;
	}

	function getDisplayTitle()
	{
		return $this->displayTitle;
	}

	function getFullUrl()
	{
		return $this->fullUrl;
	}

	function getCategories()
	{
		return $this->categories;
	}

	function getThumbnail()
	{
		return $this->thumbnail;
	}

	function __toString()
	{
		return 'DetailPage ['
			. 'id=' . $this->id . ', '
			. 'title=' . $this->title . ', '
			. 'displayTitle=' . $this->displayTitle . ', '
			. 'fullUrl=' . $this->fullUrl . ', '
			. 'categories=' . print_r($this->categories, true) . ', '
			. 'thumbnail=' . $this->thumbnail
			. ']';
	}
}
