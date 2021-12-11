<?php

namespace App\Services;
use Aws\Organizations\OrganizationsClient;
use Aws\Credentials\CredentialProvider;

class AwsService
{
    private $organizationsClient;
    public function getAwsInstance()
    {
        $provider = CredentialProvider::defaultProvider();
        if (is_null($this->organizationsClient)) {
            $this->organizationsClient = new OrganizationsClient([
                'credentials' => $provider,
                'version' => '2016-11-28',
                'region' => 'us-east-1',
            ]);
        }
        return $this->organizationsClient;
    }
}
