<?php

namespace App\MediaWiki\Models;

/**
 * Thumbnail model
 */
class Thumbnail
{
	private $source;
	private $width;
	private $height;

	function __construct($source, $width = -1, $height = -1)
	{
		$this->source = $source;
		$this->width = $width;
		$this->height = $height;
	}

	function getSource()
	{
		return $this->source;
	}

	function getWidth()
	{
		return $this->width;
	}

	function getHeight()
	{
		return $this->height;
	}

	function __toString()
	{
		return 'Thumbnail[source=' . $this->source . ', width=' . $this->width . ', height=' . $this->height . ']';
	}
}
