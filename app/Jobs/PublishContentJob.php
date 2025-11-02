<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Contracts\SchedulableContent;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};


class PublishContentJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public SchedulableContent $content)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->content->publish();

            // можно логировать успех
            Log::info('✅ Контент опубликован', [
                'model' => get_class($this->content),
                'id' => $this->content->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('❌ Ошибка публикации контента', [
                'model' => get_class($this->content),
                'id' => $this->content->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
