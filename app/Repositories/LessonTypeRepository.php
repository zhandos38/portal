<?php

namespace App\Repositories;

use App\Models\LessonType;
use App\Repositories\BaseRepository;

/**
 * Class LessonTypeRepository
 * @package App\Repositories
 * @version February 28, 2020, 8:21 am UTC
*/

class LessonTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
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
        return LessonType::class;
    }
}
