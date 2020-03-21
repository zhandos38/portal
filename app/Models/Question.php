<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 * @package App\Models
 * @version March 3, 2020, 10:15 am UTC
 *
 * @property string quiz_id
 * @property string question
 * @property string A
 * @property string B
 * @property string C
 * @property string D
 * @property string E
 * @property string Correct
 */
class Question extends Model
{
//    use SoftDeletes;

    public $table = 'questions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function quizzes()
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }

    public $fillable = [
        'quiz_id',
        'question',
        'A',
        'B',
        'C',
        'D',
        'E',
        'correct'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'quiz_id' => 'string',
        'question' => 'string',
        'A' => 'string',
        'B' => 'string',
        'C' => 'string',
        'D' => 'string',
        'E' => 'string',
        'correct' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'quiz_id' => 'required',
        'question' => 'required',
        'A' => 'required',
        'B' => 'required',
        'C' => 'required',
        'D' => 'required',
        'E' => 'required',
        'correct' => 'required'
    ];

    public static function checkAnswer($answers){
        if(count($answers)>0 || $answers){
            $results = [];
            $count = 0;
            foreach ($answers["answers"] as $key => $answer){
                foreach ($answer as $item){
                    $questions = Question::where("id",$key)->first();
                    $correct = $questions[$questions["correct"]];
                    if($item == $correct){
                        $count++;
                    }
                    $results[$key]["question"] = $questions["question"];
                    $results[$key]["answer"] = $item;
                    $results[$key]["correct"] = $correct;
                }
            }
            $results["total"] = $count;
            return $results;
        }
        else{
            $count = 0;
        }
    }

}
