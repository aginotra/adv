<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Review;

class ReviewController extends Controller
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

    public function successMessageWithVar($msg, $msgData)
    {
        return json_encode(array(
                'success' => true,
                'messages' => $msg,
                'response' => array(
                    'reviews_details' => $msgData)
            ), 200
        );
    }

    public function checkValidation()
    {
        return $validator = Validator::make(
            array(
                'review_provider_id' => Input::get('review_provider_id'),
                'review_accepter_id' => Input::get('review_accepter_id'),
                'rating' => Input::get('rating'),
                'review_msg' => Input::get('review_msg')
            ), array(
                'review_provider_id' => 'required',
                'review_accepter_id' => 'required',
                'rating' => 'required',
                'review_msg' => 'required'
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $review = new Review();
        $input = Input::all();
        $validator = $this->checkValidation();
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                $msg[] = $message;
            }
            return $this->errorMessage($msg);
        }
        $saveReview = $review->insert($input);
        $msg = "Review saved successfully.";
        return $this->successMessageWithVar($msg, $saveReview);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
