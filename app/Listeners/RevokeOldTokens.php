<?php

namespace App\Listeners;

use App\Events\Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevokeOldTokens
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(\Laravel\Passport\Events\AccessTokenCreated $event): void
    {
        //
    }
}
