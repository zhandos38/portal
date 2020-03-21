<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Quiz
 * @package App\Models
 * @version March 3, 2020, 10:14 am UTC
 *
 * @property string title
 */
class Quiz extends Model
{
//    use SoftDeletes;

    public $table = 'quizzes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public $fillable = [
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];


    public static function getQuestions($id){
        $quiz = Quiz::find($id);
        if($quiz){
            if(count($quiz->questions)>40){
                $questions = $quiz->questions->toArray();
                $keys = array_rand($questions,40);
                $tests = [];
                foreach ($questions as $key => $question){
                    if(in_array($key,$keys)){
                        $tests[$question["id"]]["question"] = $question["question"];
                        $tests[$question["id"]]["answers"][] = $question["A"];
                        $tests[$question["id"]]["answers"][] = $question["B"];
                        $tests[$question["id"]]["answers"][] = $question["C"];
                        $tests[$question["id"]]["answers"][] = $question["D"];
                        $tests[$question["id"]]["answers"][] = $question["E"];
                    }
                }
                $newTests = [];
                foreach ($tests as $key => $test){
                    $newTests[$key]["question"] = $test["question"];
                    shuffle($test["answers"]);
                    $newTests[$key]["answers"] = $test["answers"];
                }
                return $newTests;
            }
            else{
                return false;
            }
        }
        return false;

    }
}
