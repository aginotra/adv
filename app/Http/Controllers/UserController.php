<?php

namespace App\Http\Controllers;

use App\DeviceDetails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    private $uploaddir;

    public function __construct()
    {
        $this->setUploadDir();
    }

    protected function setUploadDir()
    {
        return $this->uploaddir = public_path() . '/img/profile/';
    }

    public function checkValidation()
    {
        return $validator = Validator::make(
            array(
                'tp_id' => Input::get('tp_id'),
                'img_hash' => Input::get('img_hash'),
                'id_type' => Input::get('id_type'),
                'name' => Input::get('name')
            ), array(
                'tp_id' => 'required',
                'img_hash' => 'required',
                'id_type' => 'required',
                'name' => 'required'
            )
        );
    }

    public function checkValidationForProfileUpdate()
    {
        return $validator = Validator::make(
            array(
                'fb_id' => Input::get('fb_id')
            ), array(
            'fb_id' => 'required'
        ));
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
                'response' => Null), 400
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
        $user = new User();
        $deviceDetail = new DeviceDetails();
        $data = Input::all();
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $userId = $user->getUserIdAttachedWithTpId($data['tp_id'],$data['id_type']);
        if ($userId) {
            $data['user_id'] = $userId;
        }
        $img_hash = $user->imageUpload($data['img_hash'], $this->uploaddir);
        if (isset($img_hash) and !empty($img_hash)) {
            $data['img_hash'] = $img_hash;
        }
        $userProfile = $user->insert($data);
        $userProfile->lat = $data['lat'];
        $userProfile->lng = $data['lng'];
        $data['user_id'] = $userProfile->id;
        $deviceDetail->insert($data);
        $msg = "Profile saved successfully.";
        return $this->successMessageWithVar($msg, $userProfile);
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
