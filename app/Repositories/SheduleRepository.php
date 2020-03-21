<?php

namespace App\Repositories;

use App\Models\Shedule;
use App\Repositories\BaseRepository;

/**
 * Class SheduleRepository
 * @package App\Repositories
 * @version February 28, 2020, 8:36 am UTC
*/

class SheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'group_id',
        'teacher_id',
        'subject_id',
        'lesson_id',
        'day_id',
        'start',
        'end',
        'cabinet'
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
        return Shedule::class;
    }
}
