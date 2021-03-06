<?php

namespace App\Models\Page;

use App\Models\ImageableModel;
use Laracasts\Presenter\PresentableTrait;

use Cviebrock\EloquentSluggable\Sluggable;

class Page extends ImageableModel
{

    use Sluggable;
    use PresentableTrait;
        
    protected $presenter = 'App\Presenters\Page\PagePresenter';

	protected $guarded = ['id'];
	
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

	/*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	|
	*/

	/*
	|--------------------------------------------------------------------------
	| Getters and Setters
	|--------------------------------------------------------------------------
	|
	*/


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
