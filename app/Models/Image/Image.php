<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

use File;

class Image extends Model 
{

    use PresentableTrait;
    
    protected $presenter = 'App\Presenters\Image\ImagePresenter';

	protected $guarded = ['id'];

	/*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Polymorphic relationship
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function imageable()
    {
        return $this->morphTo();
    }

	/*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Retourne l'image par défaut
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function scopeDefault($query)
	{
		return $query->where('default', 1)->take(1)->get();
	}

	/*
	|--------------------------------------------------------------------------
	| Getters and Setters
	|--------------------------------------------------------------------------
	|
	*/

	public function getModuleNameAttribute($value)
	{
		return \Str::snake(class_basename($this->imageable_type));
	}

	/*
	|--------------------------------------------------------------------------
	| Custom functions
	|--------------------------------------------------------------------------
	|
	*/
    /**
     * Move an image from src to dest with a custom name
     * @param string $src
     * @param string $dest
     * @param string $name
     * @return string 
     */ 
    public function move($src, $dest, $name = null)
    {
		// rename image
		$new = null;
		if($name) {
			$old = $this->file_name;
			$extension = last(explode('.', $old));
			$new = $name.'.'.$extension;
			
		}

        $this->createDirectory(public_path($dest));
        
		// move to the new destination
		$src .= $this->file_name;
		$dest .= '/'.$new;
		
		File::move($src, public_path($dest));

		// change the name and the path in DB
		if($new) {
			$this->file_name = $new;
			$this->path = $dest;
            $this->save();
		}
            
		return $this;
    }

    /**
	 * Create resized images based on styles and the model associated
	 *
	 * @param  array  $styles ["style_name" => ["width" => ##, "height" => ##], ...]
	 * @param  string $action resize or crop
	 * @return boolean
	 */
	public function createStyles(array $styles, $action = 'resize')
	{
		if(!$this->imageable)
			throw new \Exception;

		$model = \Str::plural($this->imageable->module_name);

		foreach($styles as $style => $dimensions) {

			// get dimensions
			$width = array_get($dimensions, 'width', 0);
			$height = array_get($dimensions, 'height', 0);
			// create the destination path
			$dest = "uploads/{$model}/images/{$style}/";

			$bool = $this->createDirectory(public_path($dest));

			// create the image style path
			$dest .= $this->file_name;

			// create the image with Intervention\Image package
			// $this->path should return the full path for the original uploaded image
			$image = \Image::make(public_path($this->path));

			// Si aucun style n'est défini
			// ou Si le width et le height ne sont pas défini
			// donc sauvegarder avec les mêmes dimensions
			if(!$style || ($width == 0 && $height == 0))
				$image->save(public_path($dest), 99);

			// si dimensions < au style, l'ajuster
			if($width < $height && $image->width() <= $width) {
				$image->resizeCanvas($width, $height);

			} elseif ($height <= $width && $image->height() <= $height) {
				$image->resizeCanvas($width, $height);

			} elseif($action == 'resize') {
				$image = $this->resize($image, $width, $height);

			} elseif($action == 'crop') {
				$image = $image->crop($image, $width, $height);
			}
			// sauvegarder l'image traité dans sa destination
			$image->save(public_path($dest), 99);
		}

		return $this;
	}

	/**
	 * Delete all the styles for an image
	 * 
	 * @return $this
	 */
	public function deleteStyles(array $styles)
	{
		if(!$this->imageable)
			throw new \Exception;

		$model = \Str::plural($this->imageable->module_name);

		foreach($styles as $style => $dimensions) {
			$dest = "uploads/{$model}/images/{$style}/{$this->file_name}";
			File::delete(public_path($dest));
		}

		// Delete original image
		File::delete(public_path($this->path));

		return $this;
	}

    /**
     * Create new directory and subdirectories
     * @param string $path
     * @return bool
     */
    public function createDirectory($path) {

		if(!\File::isDirectory($path))
			return \File::makeDirectory($path, 0755, true);

		return false;
    }
}
