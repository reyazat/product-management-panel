<?php

namespace App\Listeners;

use App\Events\Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PruneOldTokens
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
    public function handle(\Laravel\Passport\Events\RefreshTokenCreated $event): void
    {
        //
    }
}
