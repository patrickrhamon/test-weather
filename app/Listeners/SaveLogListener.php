<?php

namespace App\Listeners;

use App\Services\LogEventService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected LogEventService $log_event_service)
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
        $data['user'] = $event->user->id ?? null;
        $data['type'] = $event->type;
        $data['weather'] = $event->weather;

        $this->log_event_service->create($data);
    }
}
