<?php

namespace App\Repositories;

use App\Models\ExamSchedule;
use App\Repositories\BaseRepository;

/**
 * Class ExamScheduleRepository
 * @package App\Repositories
 * @version March 4, 2020, 6:56 am UTC
*/

class ExamScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'subject_id',
        'group_id',
        'type_id',
        'quiz_id',
        'start',
        'end',
        'time',
        'cabinet',
        'active'
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
        return ExamSchedule::class;
    }
}
