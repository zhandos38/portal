<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Repositories\BaseRepository;

/**
 * Class AssignmentRepository
 * @package App\Repositories
 * @version February 29, 2020, 7:16 am UTC
*/

class AssignmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'group_id',
        'subject_id',
        'teacher_id',
        'student_id',
        'first_rating',
        'second_rating',
        'exam_rating',
        'total_rating'
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
        return Assignment::class;
    }
}
