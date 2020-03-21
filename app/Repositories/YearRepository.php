<?php

namespace App\Repositories;

use App\Models\Year;
use App\Repositories\BaseRepository;

/**
 * Class YearRepository
 * @package App\Repositories
 * @version February 28, 2020, 5:39 am UTC
*/

class YearRepository extends BaseRepository
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
        return Year::class;
    }
}
