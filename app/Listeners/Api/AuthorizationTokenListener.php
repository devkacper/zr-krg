<?php

namespace App\Listeners\Api;

use Illuminate\Support\Str;

class AuthorizationTokenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $token = Str::random(60);

        auth()->user()->update([
            'api_token' => hash('sha256', $token)
        ]);

        request()->token = $token;
    }
}
