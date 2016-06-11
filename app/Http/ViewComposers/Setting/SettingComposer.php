<?php namespace App\Http\ViewComposers\Setting;

use Illuminate\Contracts\View\View;
use App\Models\Setting\Setting;

class SettingComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $settings = Setting::getSettings();
        $settings = ['site_name' => "Starterkit"];
        $view->with('settings', $settings);
    }

}