<?php

namespace App\Repositories;

use App\Models\SubjectList;
use App\Repositories\BaseRepository;

/**
 * Class SubjectListRepository
 * @package App\Repositories
 * @version March 11, 2020, 8:25 am UTC
*/

class SubjectListRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'group_id',
        'subject_id',
        'student_id',
        'credits',
        'ECTS'
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
        return SubjectList::class;
    }
}
