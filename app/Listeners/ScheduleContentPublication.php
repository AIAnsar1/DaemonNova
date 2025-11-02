<?php

namespace App\Listeners;

use App\Events\ContentScheduled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\PublishContentJob;


class ScheduleContentPublication
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
    public function handle(ContentScheduled $event): void
    {
        $content = $event->content;

        if ($content->isScheduled()) 
        {
            PublishContentJob::dispatch($content)->delay($content->getPublishTime());
        }
    }
}
