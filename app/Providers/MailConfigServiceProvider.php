<?php

namespace App\Providers;

use App\Constant;
use App\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Constant::START_MODE){
            $settings = Setting::find(Constant::MASTER_COMPANY_ID);
            if ($settings) {
                $config = array(
                    'driver'     => $settings->driver_mail,
                    'host'       => $settings->host_mail,
                    'port'       => $settings->port_mail,
                    'username'   => $settings->username_mail,
                    'password'   => $settings->password_mail,
                    'encryption' => $settings->encryption_mail,
                    'from'       => array('address' => $settings->username_mail, 'name' => "Kim Kim Rosa Jewelry"),
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                    'markdown' => [
                        'theme' => 'default',
                        'paths' => [
                            0 => resource_path('views/vendor/mail'),
                        ],
                    ],
                    'stream' => [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        ]
                    ]
                );

                Config::set('mail', $config);
            }
        }
    }
}
