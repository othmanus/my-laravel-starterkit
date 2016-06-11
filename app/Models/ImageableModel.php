<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageableModel extends Model 
{

	/**
	 * Max number of images associated to the model
	 * @var int $max
	 */
	protected $max = 10;

	/**
	 * Image styles for the model
	 * @var array $styles
	 */
	protected $styles = [
		"large" 	=> ["width" => 850, "height" => 850],
		"medium" 	=> ["width" => 450, "height" => 450],
		"thumbnail" => ["width" => 150, "height" => 150],
	];
	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	public function images()
	{
		return $this->morphMany('App\Models\Image\Image', 'imageable')->orderBy('position');
	}

	/*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Associate the uploaded images to the model
	 * The uploaded images are stored in the folder public/temp
	 * 
	 * @var  array $images_id
	 * @var  string $new_name image name
	 * @return  $this
	 */
	public function associateImages($images_id, $new_name = null) 
	{

		$temp_path = public_path("temp")."/";
		$styles = $this->image_styles;

		$images = \App\Models\Image\Image::whereIn("id", $images_id)->get();

		foreach($images as $image)
		{

			$name = $new_name ? $new_name."-".$image->id : $this->image_name.'-'.$image->id;

			// get the original path
			$module = \Str::plural($this->module_name);
			$original_path = "uploads/{$module}/images/original";
			// change image name

			// move to new destination
			$image = $image->move($temp_path, $original_path, $name);

			if($image) {
				// associate to imageable model
				$this->images()->save($image);
			}
		}
		return $this;
	}

	/**
	 * create all the styles for each associated image according the $image_styles variable
	 * 
	 * @return $this
	 */
	public function createImageStyles()
	{
		foreach($this->images as $image)
		{
			$image->createStyles($this->image_styles);
		}

		return $this;
	}

	/**
	 * delete all the styles for each associated image according the $image_styles variable
	 * 
	 * @return $this
	 */
	public function deleteImageStyles()
	{
		foreach($this->images as $image) {
			$image->deleteStyles($this->image_styles);
			$image->delete();
		}
	}
	/*
	|--------------------------------------------------------------------------
	| Getters and Setters
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Default image for the model
	 * @return Image
	 */
	public function getDefaultImageAttribute()
	{
		if($this->images->isEmpty())
            return null;

        return $this->images()->default() ? $this->images()->default() : $this->images->first();
	}

	/**
	 * Default image name
	 * @return  string
	 */
	public function getModuleNameAttribute()
	{
		return \Str::snake(class_basename($this));
	}

	/**
	 * Default image name
	 * @return  string
	 */
	public function getImageNameAttribute()
	{
		return $this->slug;
	}

	/**
	 * Return array of styles for the model.
	 * Mandatory for images
	 * @return array ["style_name" => ["width" => ##, "height" => ##], ...]
	 */
	public function getImageStylesAttribute()
	{
		return $this->styles;
	} 

	/**
	 * Max number of images for the model
	 * Mandatory
	 * @return int
	 */
	public function getMaxImagesAttribute()
	{
		return $this->max;
	}

	/**
	 * Max remaining images for the model
	 * Mandatory
	 * @return int
	 */
	public function getRemainingImagesAttribute()
	{
		return $this->images ? $this->max - $this->images->count() : $this->max;
	}
}