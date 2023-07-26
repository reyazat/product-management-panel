<?php

namespace App\Jobs;

use App\Http\Helpers\Helpers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class sendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Summary of text
     * @var array
     */
    public array $text;
    /**
     * Summary of to
     * @var string
     */
    public string $to;
    /**
     * Summary of bodyId
     * @var int
     */
    public int $bodyId;
    /**
     * Create a new job instance.
     */
    public function __construct($text,$to,$bodyId)
    {
        $this->text = $text;
        $this->to = $to;
        $this->bodyId = $bodyId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Helpers::sendSms($this->text, $this->to, $this->bodyId);

    }
}
