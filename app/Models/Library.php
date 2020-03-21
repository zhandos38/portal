<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Library
 * @package App\Models
 * @version March 5, 2020, 2:26 pm UTC
 *
 * @property \App\Models\User user
 * @property string title
 * @property string description
 * @property string src
 * @property integer user_id
 */
class Library extends Model
{
    //use SoftDeletes;

    public $table = 'libraries';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    //protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'description',
        'src',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'src' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'src' => 'required',
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public static function makeDate($request){
        $input["title"] = $request->get("title");
        $input["description"] = $request->get("description");
        $file = $request->file("src");
        $filepath = "/upload/library/" . Str::slug($request->title) . Auth::id() . Str::random(10) ."." . $file->getClientOriginalExtension();
        $file->storeAs("",$filepath);
        $input["src"] = $filepath;
        $input["user_id"] = Auth::id();
        if(Library::create($input)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function updateData($request,$library){
        if($request->hasFile("src")){
          if(Storage::disk("local")->exists($library->src)){
              Storage::delete($library->src);
          }
            $library->title = $request->get("title");
            $file = $request->file("src");
            $filepath = "/upload/library/" . Str::slug($request->title) . Auth::id() . Str::random(10) ."." . $file->getClientOriginalExtension();
            $file->storeAs("",$filepath);
            $library->src = $filepath;

        }
        else{
            if($request->get("title") != $library->title ){
                $infoPath = pathinfo(public_path($library->src));
                $extension = $infoPath['extension'];
                $filepath = "/upload/library/" . Str::slug($request->title) . Auth::id() . Str::random(10) ."." . $extension;
                Storage::move($library->src,$filepath);
                $library->title = $request->get("title");
                $library->src = $filepath;
            }
        }
        $library->description = $request->get("description");
        $library->user_id = Auth::id();
        return $library->save();
    }

    public static function deleteFile($library){
        Storage::delete($library->src);
    }




}
