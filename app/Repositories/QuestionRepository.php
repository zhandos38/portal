<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories
 * @version March 3, 2020, 10:15 am UTC
*/

class QuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'quiz_id',
        'question',
        'A',
        'B',
        'C',
        'D',
        'E',
        'Correct'
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
        return Question::class;
    }
}
