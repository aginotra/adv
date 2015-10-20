<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;
use URL;
use App;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getUserIdAttachedWithTpId($id, $type)
    {
        $userId = DB::table('users')->where('tp_id', $id)->where('id_type', $type)->pluck('id');
        return $userId;
    }

    public function imageUpload($imageBase64Data, $uploadDir)
    {
        $base_url = URL::to('/');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $image_data = base64_decode($imageBase64Data);
        $time = md5(microtime());
        $file = $uploadDir . $time . '.png';
        file_put_contents($file, $image_data);
        $img_hash = $base_url . '/img/profile/' . $time . '.png';
        return $img_hash;
    }

    public function insert($data)
    {
        $user = new User();
        if (isset($data['user_id'])) {
            $user = App\User::find($data['user_id']);
        }
        if (isset($data['tp_id'])) {
            $user->tp_id = $data['tp_id'];
        }
        if (isset($data['id_type'])) {
            $user->id_type = $data['id_type'];
        }
        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['img_hash'])) {
            $user->img_hash = $data['img_hash'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        $user->save();
        return $user;
    }

}
