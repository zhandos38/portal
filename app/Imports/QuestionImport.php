<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;

    }


    public function model(array $row)
    {
        if(count($row) == 8){
            if($row[0]!="Номер вопроса"){
                return new Question([
                    "quiz_id"=>$this->id,
                    "question"=>$row[1],
                    "A"=>$row[2],
                    "B"=>$row[3],
                    "C"=>$row[4],
                    "D"=>$row[5],
                    "E"=>$row[6],
                    "correct"=>$row[7],
                ]);
            }
        }


    }

}
