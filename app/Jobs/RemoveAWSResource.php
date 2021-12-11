<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\AccountRepository;

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
    public function handle(AccountRepository $accountRepository)
    {
        $account = $accountRepository->find($this->accountID);
        if (empty($account)) {
            return;
        }

        $awsID = $account->aws_id;
        $accessKey = $account->aws_access_key_id;
        $secretKey = $account->aws_secret_access_key;
        $logFile = 'public/' . $awsID . ".txt";
        shell_exec("AWS_ACCESS_KEY_ID={$accessKey}  AWS_SECRET_ACCESS_KEY={$secretKey} ./cloud-nuke_darwin_amd64 aws --force 2>&1 | tee " . $logFile);
    }
}
