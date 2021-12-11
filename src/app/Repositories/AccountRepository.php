<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\BaseRepository;

/**
 * Class AccountRepository
 * @package App\Repositories
 * @version December 11, 2021, 9:56 am UTC
*/

class AccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'aws_id',
        'arn',
        'email',
        'name',
        'status',
        'joined_method',
        'joined_at',
        'aws_access_key_id',
        'aws_secret_access_key'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Account::class;
    }

    public function upsertAccounts($data)
    {
        return $this->model->upsert($data, 'aws_id');
    }
}
