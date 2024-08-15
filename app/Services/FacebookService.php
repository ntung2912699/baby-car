<?php

namespace App\Services;

use Facebook\Facebook;

class FacebookService
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v14.0',
        ]);
    }

    public function getFb()
    {
        return $this->fb;
    }
}
