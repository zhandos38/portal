<?php

namespace App\Repositories;

use App\Models\Library;
use App\Repositories\BaseRepository;

/**
 * Class LibraryRepository
 * @package App\Repositories
 * @version March 6, 2020, 6:12 am UTC
*/

class LibraryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'src',
        'user_id'
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
        return Library::class;
    }
}
