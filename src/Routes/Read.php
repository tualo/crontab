<?php

namespace Tualo\Office\Crontab\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;


class Read extends \Tualo\Office\Basic\RouteWrapper
{
    public static function scope(): string
    {
        return 'crontab.read';
    }

    public static function register()
    {
        Route::add('/crontab/read', function ($matches) {

            $db = App::get('session')->getDB();
            try {
                $sessionfile = (string)App::get('tempPath') . '/' . '.ht_crontab_state';
                if (file_exists($sessionfile)) {
                    unlink($sessionfile);
                }
                App::result('success', true);
            } catch (\Exception $e) {

                App::result('last_sql', $db->last_sql);
                App::result('msg', $e->getMessage());
            }
            App::contenttype('application/json');
        }, ['get'], true,  [], self::scope());
    }
}
