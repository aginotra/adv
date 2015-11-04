<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use URL;
use App;

class PublisherBusiness extends Model
{
    protected $table = "pub_buss_detail";

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
        $img_hash = $base_url . '/img/pub/' . $time . '.png';
        return $img_hash;
    }

    public function getDetailByUserId($userId)
    {
        $userId = DB::table('pub_buss_detail')->where('user_id', $userId)->get();
        return $userId;
    }

    public function insert($data)
    {
        $user = new PublisherBusiness();
        if (isset($data['user_id'])) {
            $user->user_id = $data['user_id'];
        }
        if (isset($data['cat_type'])) {
            $user->cat_type = $data['cat_type'];
        }
        if (isset($data['img_hash1']) ) {
            $user->img_hash1 = $data['img_hash1'];
        }
        if (isset($data['img_hash2'])) {
            $user->img_hash2 = $data['img_hash2'];
        }
        if (isset($data['img_hash3'])) {
            $user->img_hash3 = $data['img_hash3'];
        }
        if (isset($data['min_amt'])) {
            $user->min_amt = $data['min_amt'];
        }
        if (isset($data['max_amt'])) {
            $user->max_amt = $data['max_amt'];
        }
        if (isset($data['avg_space'])) {
            $user->avg_space = $data['avg_space'];
        }
        if (isset($data['desc'])) {
            $user->desc = $data['desc'];
        }
        $user->save();
        return $user;
    }

    public function updateData($data)
    {
        DB::table('pub_buss_detail')
            ->where('user_id', $data['user_id'])
            ->update(['cat_type' => $data['cat_type'],'img_hash1' => $data['img_hash1'],'img_hash2' => $data['img_hash2'],'img_hash3' => $data['img_hash3'],'min_amt' => $data['min_amt'],'max_amt' => $data['max_amt'],'avg_space' => $data['avg_space'],'desc' => $data['desc']]);
    }
}

