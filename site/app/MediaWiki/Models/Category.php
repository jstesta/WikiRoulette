<?php

namespace App\MediaWiki\Models;

/**
 * Category model
 */
class Category
{
	private $ns;
	private $title;

	function __construct($ns, $title)
	{
		$this->ns = $ns;
		$this->title = $title;
	}

	function getNs()
	{
		return $this->ns;
	}

	function getTitle()
	{
		return $this->title;
	}

	function __toString()
	{
		return 'Category[ns=' . $this->ns . ', title=' . $this->title . ']';
	}
}
