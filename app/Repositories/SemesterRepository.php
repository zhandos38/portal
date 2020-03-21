<?php

namespace App\Repositories;

use App\Models\Semester;
use App\Repositories\BaseRepository;

/**
 * Class SemesterRepository
 * @package App\Repositories
 * @version February 28, 2020, 6:08 am UTC
*/

class SemesterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year_id',
        'title',
        'start',
        'end',
        'current',
        'step'
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
        return Semester::class;
    }
}
