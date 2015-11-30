<?php

namespace App\MediaWiki\Models;

use App\MediaWiki\Models\RandomPageBuilder;

/**
 * RandomPage model
 */
class RandomPage
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

	/**
	 * RandomPage constructor from builder
	 */
	public function __construct(RandomPageBuilder $b)
	{
		$this->id = $b->getId();
		$this->ns = $b->getNs();
		$this->title = $b->getTitle();
		$this->contentModel = $b->getContentModel();
		$this->pageLanguage = $b->getPageLanguage();
		$this->pageLanguageHtmlCode = $b->getPageLanguageHtmlCode();
		$this->pageLanguageDir = $b->getPageLanguageDir();
		$this->touched = $b->getTouched();
		$this->lastRevId = $b->getLastRevId();
		$this->length = $b->getLength();
		$this->displayTitle = $b->getDisplayTitle();
		$this->fullUrl = $b->getFullUrl();
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

	function getThumbnail()
	{
		return $this->thumbnail;
	}

	function __toString()
	{
		return 'RandomPage ['
			. 'id=' . $this->getId() . ', '
			. 'ns=' . $this->getNs() . ', '
			. 'title=' . $this->getTitle() . ', '
			. 'contentModel=' . $this->getContentModel() . ', '
			. 'pageLanguage=' . $this->getPageLanguage() . ', '
			. 'pageLanguageHtmlCode=' . $this->getPageLanguageHtmlCode() . ', '
			. 'pageLanguageDir=' . $this->getPageLanguageDir() . ', '
			. 'touched=' . $this->getTouched() . ', '
			. 'lastRevId=' . $this->getLastRevId() . ', '
			. 'length=' . $this->getLength() . ', '
			. 'displayTitle=' . $this->getDisplayTitle() . ', '
			. 'fullUrl=' . $this->getFullUrl()
			. ']';
	}
}
