<?php

namespace App\Services;

use Facebook\Facebook;

class FacebookService
{

    private $service;

    public function __construct()
    {
        $this->service = new Facebook([
            'app_id' => env('FACEBOOK_CLIENT_ID'),
            'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'default_graph_version' => 'v2.5',
        ]);
    }

    public function getFriendsList($user)
    {
        $response = $this->service->get('/' . $user->facebook_user_id . '/friends', $user->fb_token);
        $body = json_decode($response->getBody());
        return $body->data;
    }

    public function getMe($accessToken)
    {
        return $this->service->get('/me', $accessToken);
    }
}
