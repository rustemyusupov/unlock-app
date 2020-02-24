<?php

namespace App\Events;

use Laravel\Passport\Scope;

class UnlockEvent extends Event
{
    public array $scopes;

    /**
     * Create a new event instance.
     *
     * @param Scope[] $scopes
     *
     * @return void
     */
    public function __construct(Scope ...$scopes)
    {
        $this->scopes = $scopes;
    }
}
