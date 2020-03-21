<?php

namespace App\Repositories;

use App\Models\Quiz;
use App\Repositories\BaseRepository;

/**
 * Class QuizRepository
 * @package App\Repositories
 * @version March 3, 2020, 10:14 am UTC
*/

class QuizRepository extends BaseRepository
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
        return Quiz::class;
    }
}
