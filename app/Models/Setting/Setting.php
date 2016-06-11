<?php namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	protected $guarded = ['id'];

	public $timestamps = false;
	/*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	|
	*/
    /**
     * Récupère toutes les instances en un tableau
     *
     * @return array
     */
	public function scopeGetSettings($query)
	{
        return $query->get()->toArray();
//		return [
//			// Informations générales
//			'site_name' => $this->getFirstBy('key', 'site_name'),
//			'slogan' 	=> $this->getFirstBy('key', 'slogan'),
//			'logo' 		=> $this->getFirstBy('key', 'logo'),
//			'keywords' 	=> $this->getFirstBy('key', 'keywords'),
//
//			// Coordonnées de contact
//			'address' 	=> $this->getFirstBy('key', 'address'),
//			'phone' 	=> $this->getFirstBy('key', 'phone'),
//			'mobile' 	=> $this->getFirstBy('key', 'mobile'),
//			'fax' 		=> $this->getFirstBy('key', 'fax'),
//			'email' 	=> $this->getFirstBy('key', 'email'),
//
//			// Réseaux sociaux
//			'facebook' 	=> $this->getFirstBy('key', 'facebook'),
//			'google' 	=> $this->getFirstBy('key', 'google'),
//			'twitter' 	=> $this->getFirstBy('key', 'twitter'),
//			'youtube' 	=> $this->getFirstBy('key', 'youtube'),
//			'linkedin' 	=> $this->getFirstBy('key', 'linkedin'),
//			'instagram' => $this->getFirstBy('key', 'instagram'),
//
//			// Google Map
//			'latitude' 	=> $this->getFirstBy('key', 'latitude'),
//			'longitude' => $this->getFirstBy('key', 'longitude'),
//		];
	}
    
    /**
     * Return the first element
     * @param  string  $key   the key in the table (unique)
     * @param  string  $value the value of the key
     * @return Setting the instance of the Eloquent model
     */
    private function scopeGetFirstBy($query, $key, $value) {
        return $query->where($key, $value)->take(1)->get()->first();
    }
    
	/*
	|--------------------------------------------------------------------------
	| Getters and Setters
	|--------------------------------------------------------------------------
	|
	*/
	/**
	 * Vérifie si la valeur est un array ou pas
	 *
	 * @return string
	 */
	public function getIsArrayAttribute($value)
	{
		$v = json_decode($this->value);

		return is_array($v) ? true : false;
	}

	/**
	 * Convertie la value en array
	 *
	 * @return array
	 */
	public function getToArrayAttribute($value)
	{
		$value = json_decode($this->value);

		return is_array($value) ? $value : array($this->value);
	}

	/**
	 * Affiche la valeur comme string
	 *
	 * @return string
	 */ 
	public function getToStringAttribute($value)
	{
		$v = json_decode($this->value);
		return is_array($v) ? implode(' <br> ', $v) : $this->value;
	}

	/**
	 * Si la valeur entrée est un array, le convertir en JSON
	 *
	 * @param  $value
	 */
	public function setValueAttribute($value)
	{
		$this->attributes['value'] = is_array($value) ? json_encode($value) : $value;
	}


}
