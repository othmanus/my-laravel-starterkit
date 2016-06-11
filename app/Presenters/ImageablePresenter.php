<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ImageablePresenter extends Presenter {

	/**
	 * Path to the default "no image" to display in case no image is available
	 * @var $default_no_image 
	 */
	protected $default_no_image = "uploads/no-image/original/no-image.png";

	/**
     * Default image large
     * 
     * @return string
     */
    public function default_image_large()
    {
    	return $this->default_image ? $this->default_image->present()->large : asset(str_replace("original", "large", $this->default_no_image));
    }

    /**
     * Default image medium
     * 
     * @return string
     */
    public function default_image_medium()
    {
    	return $this->default_image ? $this->default_image->present()->medium : asset(str_replace("original", "medium", $this->default_no_image));
    }

    /**
     * Default image thumbnail
     * 
     * @return string
     */
    public function default_image_thumbnail()
    {
    	return $this->default_image ? $this->default_image->present()->thumbnail : asset(str_replace("original", "thumbnail", $this->default_no_image));
    }

}