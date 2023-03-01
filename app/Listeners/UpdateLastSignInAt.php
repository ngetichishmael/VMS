<?php

namespace App\Listeners;

use Carbon\Carbon;

class UpdateLastSignInAt
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
        // $event->user->last_sign_in_at = $event->user->last_sign_in_at = Carbon::now();
        // $event->user->save();
    }
}