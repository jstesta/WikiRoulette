<?php

namespace App\MediaWiki\Models;

/**
 * Random Page model builder
 */
class RandomPageBuilder
{
	private $id;
	private $ns;
	private $title;
	private $contentModel;
	private $pageLanguage;
	private $pageLanguageHtmlCode;
	private $pageLanguageDir;
	private $touched;
	private $lastRevId;
	private $length;
	private $displayTitle;
	private $fullUrl;

	private function __construct($id)
	{
		$this->id = $id;
	}

	static function Begin($id = -1)
	{
		return new RandomPageBuilder($id);
	}

	function setNs($val)
	{
		$this->ns = $val;
		return $this;
	}

	function setTitle($val)
	{
		$this->title = $val;
		return $this;
	}

	function setContentModel($val)
	{
		$this->contentModel = $val;
		return $this;
	}

	function setPageLanguage($val)
	{
		$this->pageLanguage = $val;
		return $this;
	}

	function setPageLanguageHtmlCode($val)
	{
		$this->pageLanguageHtmlCode = $val;
		return $this;
	}

	function setPageLanguageDir($val)
	{
		$this->pageLanguageDir = $val;
		return $this;
	}

	function setTouched($val)
	{
		$this->touched = $val;
		return $this;
	}

	function setLastRevId($val)
	{
		$this->lastRevId = $val;
		return $this;
	}

	function setLength($val)
	{
		$this->length = $val;
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

	function getId()
	{
		return $this->id;
	}

	function getNs()
	{
		return $this->ns;
	}

	function getTitle()
	{
		return $this->title;
	}

	function getContentModel()
	{
		return $this->contentModel;
	}

	function getPageLanguage()
	{
		return $this->pageLanguage;
	}

	function getPageLanguageHtmlCode()
	{
		return $this->pageLanguageHtmlCode;
	}

	function getPageLanguageDir()
	{
		return $this->pageLanguageDir;
	}

	function getTouched()
	{
		return $this->touched;
	}

	function getLastRevId()
	{
		return $this->lastRevId;
	}

	function getLength()
	{
		return $this->length;
	}

	function getDisplayTitle()
	{
		return $this->displayTitle;
	}

	function getFullUrl()
	{
		return $this->fullUrl;
	}

	function build()
	{
		return new RandomPage($this);
	}
}
