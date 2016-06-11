<?php namespace App\Presenters\Setting;

use Laracasts\Presenter\Presenter;

class SettingPresenter extends Presenter {

	/**
	 * Affiche la valeur
	 *
	 * @return string
	 */ 
	public function value()
	{
		$value = $this->value;
		$v = json_decode($value);
		return is_array($v) ? implode('<br> ', $v) : $value;
	}

}