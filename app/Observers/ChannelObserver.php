<?php

namespace App\Observers;

use App\Events\ChannelCreated;
use App\Models\Channel;

class ChannelObserver
{
    public function created(Channel $channel)
    {
        event(new ChannelCreated($channel));
    }
}
