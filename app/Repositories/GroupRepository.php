<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\BaseRepository;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version February 27, 2020, 9:35 am UTC
*/

class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_id',
        'title',
        'language_id',
        'education_id'
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
        return Group::class;
    }
}
