<?php

namespace App\MediaWiki\Models;

/**
 * Detail Page model builder
 */
class DetailPageBuilder
{
	private $id;
	private $displayTitle;
	private $fullUrl;
	private $categories;
	private $thumbnail;
	private $title;

	private function __construct($id)
	{
		$this->id = $id;
	}

	static function Begin($id = -1)
	{
		return new DetailPageBuilder($id);
	}

	function setId($val)
	{
		$this->id = $val;
		return $this;
	}

	function setTitle($val)
	{
		$this->title = $val;
		return $this;
	}

	function setDisplayTitle($val)
	{
		$this->displayTitle = $val;
		return $this;
	}

	function setFullUrl($val)
	{
		$this->fullUrl = $val;
		return $this;
	}

	function setCategories($val)
	{
		$this->categories = $val;
		return $this;
	}

	function setThumbnail($val)
	{
		$this->thumbnail = $val;
		return $this;
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

	function build()
	{
		return new DetailPage($this);
	}
}
