<?php

namespace App\Repositories;

use App\Models\Nationality;
use App\Repositories\BaseRepository;

/**
 * Class NationalityRepository
 * @package App\Repositories
 * @version March 12, 2020, 6:16 am UTC
*/

class NationalityRepository extends BaseRepository
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
        return Nationality::class;
    }
}
