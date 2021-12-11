<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\Jobs\RemoveAWSResource;
use Illuminate\Http\Request;
use Flash;
use Response;
use Aws\Organizations\OrganizationsClient;
use Aws\Credentials\CredentialProvider;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;
use App\Services\AwsService;
use Exception;

use function PHPSTORM_META\map;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    /**
     * @var AwsService
     */
    private $awsService;

    public function __construct(
        AccountRepository $accountRepo,
        AwsService $awsService
    )
    {
        $this->accountRepository = $accountRepo;
        $this->awsService = $awsService;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $organizationsClient = $this->awsService->getAwsInstance();
        // $accounts = $organizationsClient->listAccounts()->toArray();
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = [
            'Email' => $request->email,
            'AccountName' => $request->name,
        ];

        $organizationsClient = $this->awsService->getAwsInstance();
        $organizationsClient->createAccount($data);

        Flash::success('Request in progress.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }

    public function sync()
    {
        try {

        $organizationsClient = $this->awsService->getAwsInstance();
        $res = $organizationsClient->listAccounts()->toArray();

        $resAccounts = $res['Accounts'];
        $accounts = [];
        foreach ($resAccounts as $account) {
            $acc = [
                'aws_id' => $account['Id'],
                'arn' => $account['Arn'],
                'email' => $account['Email'],
                'name' => $account['Name'],
                'status' => $account['Status'],
                'joined_method' => $account['JoinedMethod'],
                'joined_at' => $account['JoinedTimestamp']->format('Y-m-d H:i:s')
            ];
            array_push($accounts, $acc);
        }

        $this->accountRepository->upsertAccounts($accounts);
        }
        catch(Exception $e){
            Flash::error('Error');
        }

        Flash::success('Sync successfully.');

        return redirect(route('accounts.index'));
    }

    public function removeAWSResource($id) {
        $account = $this->accountRepository->find($id);
        if (empty($account)) {
            Flash::error('Account not found');
            return redirect(route('accounts.index'));
        }

        $logFile = $account->aws_id .'.txt';
        $stream = fopen($logFile, 'w');
        fwrite($stream, 'Starting ...' . PHP_EOL);
        fclose($stream);
        RemoveAWSResource::dispatch($id, $this->accountRepository);
        return view('accounts.remove_aws_resource', ['id' => $id, 'account' => $account, 'logFile' => $logFile]);
    }

    public function removeAWSResourceStream($id) {
        $account = $this->accountRepository->find($id);
        if (empty($account)) {
            return;
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($account) {
            $content = file_get_contents($account->aws_id .'.txt');
            $data = explode(PHP_EOL, $content);
            echo 'data: ' . json_encode($data) . "\n\n";
            flush();
            ob_flush();
            usleep(200000);
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        $response->send();
    }
}
