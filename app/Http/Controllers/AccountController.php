<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

class AccountController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $provider = CredentialProvider::defaultProvider();
        $organizationsClient = new OrganizationsClient([
            'credentials' => $provider,
            'version' => '2016-11-28',
            'region' => 'us-east-1',
        ]);
        $accounts = $organizationsClient->listAccounts()->toArray();

        return view('accounts.index')
            ->with('accounts', $accounts['Accounts']);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = [
            'Email' => $request->email,
            'AccountName' => $request->name,
        ];

        $provider = CredentialProvider::defaultProvider();
        $organizationsClient = new OrganizationsClient([
            'credentials' => $provider,
            'version' => '2016-11-28',
            'region' => 'us-east-1',
        ]);
       $organizationsClient->createAccount($data);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function removeAWSResource($id) {
        $logFile = $id .'.txt';
        $stream = fopen($logFile, 'w');
        fwrite($stream, 'Starting ...'.PHP_EOL);
        fclose($stream);
        RemoveAWSResource::dispatch($id);
        return view('accounts.remove_aws_resource', ['id' => $id, 'logFile' => $logFile]);
    }

    public function removeAWSResourceStream($id) {

        $response = new StreamedResponse();
        $response->setCallback(function () use ($id) {
            $content = file_get_contents($id .'.txt');
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
