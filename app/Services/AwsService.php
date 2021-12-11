<?php

namespace App\Services;
use Aws\Organizations\OrganizationsClient;
use App\Repositories\SystemSettingRepository;

class AwsService
{
    private $organizationsClient;
    private $systemSettingRepository;

    public function __construct(SystemSettingRepository $systemSettingRepository)
    {
        $this->systemSettingRepository = $systemSettingRepository;
    }

    public function getAwsInstance()
    {
        $setting = $this->systemSettingRepository->all(['name' => 'aws_root_credentials'])->first();
        if (is_null($this->organizationsClient) && $setting) {
            $credential = json_decode($setting->content);
            $this->organizationsClient = new OrganizationsClient([
                'credentials' => [
                    'key' => isset($credential->key) ? $credential->key : '',
                    'secret' => isset($credential->secret) ? $credential->secret : '',
                ],
                'version' => '2016-11-28',
                'region' => 'us-east-1',
            ]);
        }
        return $this->organizationsClient;
    }
}
