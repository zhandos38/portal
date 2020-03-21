<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pns extends Model
{
    protected $table = 'pns';

    protected $fillable = ['user_id', 'pns'];

    public function users()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }


    public static function add($id, $pns)
    {
        $str = new self();
        if ($test = Pns::where('user_id', $id)->first()){
            $test->pns = $pns;
            $test->save();
        }else {
            $str->user_id = $id;
            $str->pns = $pns;
            $str->save();
        }
    }

}
