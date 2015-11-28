<?php

namespace App\MediaWiki\Models;

/**
 * Random ID API response model
 */
class RandomIdResponse
{
	private $id;
	private $ns;
	private $title;

	public function __construct($id, $ns, $title)
	{
		$this->id = $id;
		$this->ns = $ns;
		$this->title = $title;
	}

	public static function parseFrom($data)
	{
		// TODO error checking

		return new RandomIdResponse(
			$data->id,
			$data->ns,
			$data->title
		);
	}

	/**
	 * Get the id
	 *
	 * @return int
	 **/
	public function id()
	{
		return $this->id;
	}

	/**
	 * Get the namespace
	 *
	 * @return string
	 **/
	public function ns()
	{
		return $this->ns;
	}

	/**
	 * Get the title
	 *
	 * @return string
	 **/
	public function title()
	{
		return $this->title;
	}

	public function __toString()
	{
		return "RandomIdResponse [id=" . $this->id . ", ns=" . $this->ns . ", title=" . $this->title . "]";
	}
}
