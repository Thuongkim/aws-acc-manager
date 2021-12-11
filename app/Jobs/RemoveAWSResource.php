<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveAWSResource implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $accountID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($accountID)
    {
        $this->accountID = $accountID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $logFile = 'public/' . $this->accountID . ".txt";
        shell_exec("AWS_ACCESS_KEY_ID=AKIAW5IQYZGCHRQAOZ4C  AWS_SECRET_ACCESS_KEY=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 ./cloud-nuke_darwin_amd64 aws --force 2>&1 | tee " . $logFile);
    }
}
