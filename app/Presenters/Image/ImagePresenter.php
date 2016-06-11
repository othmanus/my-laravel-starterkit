<?php

namespace App\Presenters\Image;

use Laracasts\Presenter\Presenter;

class ImagePresenter extends Presenter
{
	/*
	|--------------------------------------------------------------------------
	| Each function (presenter) represents a style.
	| By default, the path stored is the original path for the image.
	|--------------------------------------------------------------------------
	*/

	/**
	 * Original image
	 * @return string
	 */
	public function original()
	{
		return asset($this->path);
	}

	/**
	 * large style
	 * @return string
	 */
	public function large()
	{
		return asset(str_replace("original", "large", $this->path));
	}

	/**
	 * medium style
	 * @return string
	 */
    public function medium()
	{
		return asset(str_replace("original", "medium", $this->path));
	}

	/**
	 * thumbnail style
	 * @return string
	 */
	public function thumbnail()
	{
		return asset(str_replace("original", "thumbnail", $this->path));
	}
    
    
}
