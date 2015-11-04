<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Publisher;
use Illuminate\Support\Facades\Input;

class PublisherController extends Controller
{
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
                'address' => Input::get('address'),
                'city' => Input::get('city'),
                'state' => Input::get('state'),
                'zip' => Input::get('zip'),
                'lat' => Input::get('lat'),
                'lng' => Input::get('lng'),
                'phone' => Input::get('phone')
            ), array(
                'user_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'phone' => 'required'
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
        $publisher = new Publisher();
        $data = Input::all();
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $userDetail = $publisher->getDetailByUserId($data['user_id']);
        if(empty($userDetail)){
            $advertiserProfile = $publisher->insert($data);
            $msg[] = "Profile saved successfully.";
            return $this->successMessageWithVar($msg, $advertiserProfile);
        }else{
            $advertiserProfile = $publisher->updateData($data);
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
