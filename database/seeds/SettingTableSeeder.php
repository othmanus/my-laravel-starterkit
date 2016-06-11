<?php

use Illuminate\Database\Seeder;

use App\Models\Setting\Setting;

class SettingTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('settings')->delete();
		DB::update("ALTER TABLE settings AUTO_INCREMENT = 1");

		/*
		|--------------------------------------------------------------------------
		| Configuration générale
		|--------------------------------------------------------------------------
		*/
		$setting = new Setting;
		$setting->key = "site_name";
		$setting->value = "Starter Kit";
		$setting->save();

		$setting = new Setting;
		$setting->key = "slogan";
		$setting->value="My Laravel starter kit";
		$setting->save();

		$setting = new Setting;
		$setting->key = "logo";
		$setting->value = "front/images/logo.png";
		$setting->save();

		$setting = new Setting;
		$setting->key = "keywords";
		$setting->value = "";
		$setting->save();

		/*
		|--------------------------------------------------------------------------
		| Coordonnées de contact
		|--------------------------------------------------------------------------
		*/
		
		// Les adresse (siège social)
		$setting = new Setting;
		$setting->key = "address";
		$setting->value = [
		
		];
		$setting->save();

		// Les emails de contact
		$setting = new Setting;
		$setting->key = "email";
		$setting->value = [
		
		];
		$setting->save();

		// Les numéros de téléphones
		$setting = new Setting;
		$setting->key = "phone";
		$setting->value = [
		
		];
		$setting->save();

		// Les numéros mobile
		$setting = new Setting;
		$setting->key = "mobile";
		$setting->value = [
		];
		$setting->save();

		// Les numéros de fax
		$setting = new Setting;
		$setting->key = "fax";
		$setting->value = [
		
		];
		$setting->save();

		$setting = new Setting;
		$setting->key = "opening_time";
		$setting->value="";
		$setting->save();

		/*
		|--------------------------------------------------------------------------
		| Réseaux sociaux
		|--------------------------------------------------------------------------
		*/
		$setting = new Setting;
		$setting->key = "facebook";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "google";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "twitter";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "youtube";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "linkedin";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "instagram";
		$setting->value = "";
		$setting->save();

		/*
		|--------------------------------------------------------------------------
		| Google Map
		|--------------------------------------------------------------------------
		*/
		$setting = new Setting;
		$setting->key = "latitude";
		$setting->value = "";
		$setting->save();

		$setting = new Setting;
		$setting->key = "longitude";
		$setting->value = "";
		$setting->save();
	}

}
