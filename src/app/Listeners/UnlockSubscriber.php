<?php

namespace App\Listeners;

use App\Events\UnlockEvent;

/**
 * Class UnlockSubscriber
 * @package App\Listeners
 */
class UnlockSubscriber
{
    /**
     * Handle unlock events.
     *
     * @param UnlockEvent $event
     */
    public function handleUnlock(UnlockEvent $event)
    {
        activity()->withProperties($event->scopes)
            ->log('Successful unlock.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UnlockEvent::class,
            'App\Listeners\UnlockSubscriber@handleUnlock'
        );
    }
}
