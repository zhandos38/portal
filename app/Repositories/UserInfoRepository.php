<?php

namespace App\Repositories;

use App\Models\UserInfo;
use App\Repositories\BaseRepository;

/**
 * Class UserInfoRepository
 * @package App\Repositories
 * @version February 27, 2020, 2:11 pm UTC
*/

class UserInfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'firstName',
        'lastName',
        'middleName',
        'address',
        'phone',
        'email',
        'birthDay',
        'gender',
        'nationality',
        'idCard',
        'iin',
        'cardNumber',
        'citizen'
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
        return UserInfo::class;
    }
}
