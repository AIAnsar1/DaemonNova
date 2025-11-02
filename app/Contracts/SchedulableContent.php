<?php

namespace App\Contracts;

use Carbon\Carbon;

interface SchedulableContent
{
    public function getPublishTime(): ?Carbon;

    public function isScheduled(): bool;

    public function publish(): void;
}