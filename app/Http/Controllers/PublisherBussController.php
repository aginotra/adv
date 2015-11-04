<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\PublisherBusiness;
use Illuminate\Support\Facades\Input;

class PublisherBussController extends Controller
{
    private $uploaddir;

    public function __construct()
    {
        $this->setUploadDir();
    }

    protected function setUploadDir()
    {
        return $this->uploaddir = public_path() . '/img/pub/';
    }

    public function errorMessage($msg)
    {
        return json_encode(array(
                'success' => false,
                'messages' => $msg,
                'response' => Null), 400
        );
    }

    public function successMessage($msg)
    {
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => Null), 200
        );
    }

    public function successMessageWithVar($msg, $userUpdated)
    {
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    'users' => $userUpdated)
            ), 200
        );
    }

    public function checkValidation()
    {
        return $validator = Validator::make(
            array(
                'user_id' => Input::get('user_id'),
                'cat_type' => Input::get('cat_type')
            ), array(
                'user_id' => 'required',
                'cat_type' => 'required'
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $advBuss = new PublisherBusiness();
        $data = Input::all();
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $img_hash1 = $advBuss->imageUpload($data['img_hash1'], $this->uploaddir);
        if (isset($img_hash1) and !empty($img_hash1)) {
            $data['img_hash1'] = $img_hash1;
        }
        $img_hash2 = $advBuss->imageUpload($data['img_hash2'], $this->uploaddir);
        if (isset($img_hash2) and !empty($img_hash2)) {
            $data['img_hash2'] = $img_hash2;
        }
        $img_hash3 = $advBuss->imageUpload($data['img_hash3'], $this->uploaddir);
        if (isset($img_hash3) and !empty($img_hash3)) {
            $data['img_hash3'] = $img_hash3;
        }
        $userDetail = $advBuss->getDetailByUserId($data['user_id']);
        if(empty($userDetail)){
            $advertiserProfile = $advBuss->insert($data);
            $msg[] = "Profile saved successfully.";
            return $this->successMessageWithVar($msg, $advertiserProfile);
        }else{
            $advertiserProfile = $advBuss->updateData($data);
            $msg[] = "Profile updated successfully.";
            return $this->successMessageWithVar($msg, $advertiserProfile);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
