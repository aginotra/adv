<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use URL;
use App;

class Advertiser extends Model
{
    protected $table = "adv_details";

    public function insert($data)
    {
        $user = new Advertiser();
        if (isset($data['user_id'])) {
            $user->user_id = $data['user_id'];
        }
        if (isset($data['comp_name'])) {
            $user->comp_name = $data['comp_name'];
        }
        if (isset($data['address']) ) {
            $user->address = $data['address'];
        }
        if (isset($data['city'])) {
            $user->city = $data['city'];
        }
        if (isset($data['state'])) {
            $user->state = $data['state'];
        }
        if (isset($data['zip'])) {
            $user->zip = $data['zip'];
        }
        if (isset($data['lat'])) {
            $user->lat = $data['lat'];
        }
        if (isset($data['lng'])) {
            $user->lng = $data['lng'];
        }
        if (isset($data['phone'])) {
        $user->phone = $data['phone'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        $user->save();
        return $user;
    }

    public function getDetailByUserId($userId)
    {
        $userId = DB::table('adv_details')->where('user_id', $userId)->get();
        return $userId;
    }

    public function updateData($data)
    {
        DB::table('adv_details')
            ->where('user_id', $data['user_id'])
            ->update(['comp_name' => $data['comp_name'],'address' => $data['address'],'city' => $data['city'],'state' => $data['state'],'zip' => $data['zip'],'lat' => $data['lat'],'lng' => $data['lng'],'phone' => $data['phone'],'email' => $data['email']]);
    }
}
