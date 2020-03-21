<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\BaseRepository;

/**
 * Class MaterialRepository
 * @package App\Repositories
 * @version March 6, 2020, 6:21 am UTC
*/

class MaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'semester_id',
        'group_id',
        'teacher_id',
        'subject_id',
        'library_id',
        'title',
        'description'
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
        return Material::class;
    }
}
