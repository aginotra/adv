<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class DeviceDetails extends Model
{
    protected $table = "users_device_details";

    public function insert($data)
    {
        $userId = $data['user_id'];
        $token = $data['token'];
        $type = $data['type'];
        $lat = $data['lat'];
        $lng = $data['lng'];

        $user_id = DB::table('users_device_details')->where('token', $token)->pluck('user_id');

        if (!empty($user_id)) {
            $update = DB::table('users_device_details')->where('token', $token)->update(array('type' => $type, 'lat' => $lat, 'lng' => $lng, 'user_id' => $userId));
            return $update;
        } else {
            $this->user_id = $userId;
            $this->type = $type;
            $this->lat = $lat;
            $this->lng = $lng;
            $this->token = $token;
            $this->save();
            return $this;
        }
    }

    public function deleteDetail($userId, $token)
    {
        return DB::table('users_device_details')->where('user_id', '=', $userId)->where('token', '=', $token)->delete();
    }
}
