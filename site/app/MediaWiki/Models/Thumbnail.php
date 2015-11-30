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
	private $original;

	function __construct($source, $width = -1, $height = -1, $original)
	{
		$this->source = $source;
		$this->width = $width;
		$this->height = $height;
		$this->original = $original;
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

	function getOriginal()
	{
		return $this->original;
	}

	function __toString()
	{
		return 'Thumbnail[source=' . $this->source . ', width=' . $this->width . ', height=' . $this->height . ', original=' . $this->original . ']';
	}
}
