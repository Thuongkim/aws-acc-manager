<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Account
 * @package App\Models
 * @version December 11, 2021, 9:56 am UTC
 *
 * @property string $aws_id
 * @property string $arn
 * @property string $email
 * @property string $name
 * @property string $status
 * @property string $joined_method
 * @property string|\Carbon\Carbon $joined_at
 * @property string $aws_access_key_id
 * @property string $aws_secret_access_key
 */
class Account extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'accounts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'aws_id' => 'string',
        'arn' => 'string',
        'email' => 'string',
        'name' => 'string',
        'status' => 'string',
        'joined_method' => 'string',
        'joined_at' => 'datetime',
        'aws_access_key_id' => 'string',
        'aws_secret_access_key' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'aws_id' => 'required|string|max:255',
        'arn' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'joined_method' => 'required|string|max:255',
        'joined_at' => 'required',
        'aws_access_key_id' => 'nullable|string|max:255',
        'aws_secret_access_key' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
