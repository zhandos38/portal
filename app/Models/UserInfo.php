<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserInfo
 * @package App\Models
 * @version February 27, 2020, 2:11 pm UTC
 *
 * @property string user_id
 * @property string firstName
 * @property string lastName
 * @property string middleName
 * @property string address
 * @property string phone
 * @property string email
 * @property string birthDay
 * @property string gender
 * @property string nationality
 * @property string idCard
 * @property string iin
 * @property string cardNumber
 * @property string citizen
 */
class UserInfo extends Model
{
//    use SoftDeletes;

    public $table = 'user_infos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;


    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'middleName',
        'address',
        'phone',
        'email',
        'birthDay',
        'gender_id',
        'date',
        'nationality_id',
        'idCard',
        'iin',
        'cardNumber',
        'country_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'middleName' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'birthDay' => 'string',
        'gender_id' => 'integer',
        'nationality_id' => 'integer',
        'idCard' => 'string',
        'iin' => 'string',
        'cardNumber' => 'string',
        'country_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'firstName' => 'required',
        'lastName' => 'required',
        'middleName' => 'required',
//        'address' => 'required',
        'birthDay' => 'required',
        'gender_id' => 'required',
        'nationality_id' => 'required',
        'country_id' => 'required'
    ];

    public static function makeData($request,$id){
        $userInfo = UserInfo::where("user_id",$id)->first();
        if($userInfo){
            $userInfo->firstName = $request->get("firstName");
            $userInfo->lastName =  $request->get("lastName");
            $userInfo->middleName = $request->get("middleName");
            $userInfo->date = $request->get("date");
            $userInfo->address = $request->get("address");
            $userInfo->phone= $request->get('phone');
            $userInfo->email = $request->get('email');
            $userInfo->birthDay = $request->get("birthDay");
            $userInfo->gender_id = $request->get("gender_id");
            $userInfo->nationality_id = $request->get("nationality_id");
            $userInfo->idCard = $request->get('idCard');
            $userInfo->iin = $request->get("iin");
            $userInfo->cardNumber = $request->get('cardNumber');
            $userInfo->country_id = $request->get("country_id");
            $userInfo->save();
        }
        else{
            $input['user_id'] = $id;
            $input['firstName'] =  $request->get("firstName");
            $input['lastName'] =  $request->get("lastName");
            $input['middleName'] =  $request->get("middleName");
            $input['date'] =  $request->get("date");
            $input['address'] =  $request->get("address");
            $input["phone"]= $request->get('phone');
            $input["email"] = $request->get('email');
            $input['birthDay'] =  $request->get("birthDay");
            $input['gender_id'] =  $request->get("gender_id");
            $input['nationality_id'] =  $request->get("nationality_id");
            $input['idCard']= $request->get('idCard');
            $input["iin"] = $request->get("iin");
            $input["cardNumber"] = $request->get('cardNumber');
            $input['country_id'] = $request->get("country_id");
            UserInfo::create($input);

        }


    }
}
