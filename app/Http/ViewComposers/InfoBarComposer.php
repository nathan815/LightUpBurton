<?php
namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use Kreait\Firebase;

class InfoBarComposer
{

    public function compose(View $view)
    {
        $firebase = (new Firebase\Factory())->create();
        $database = $firebase->getDatabase();
        $nowPlaying = $database->getReference('showData/nowPlaying')->getValue();
        $view->with('nowPlaying', $nowPlaying);
    }
}