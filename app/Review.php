<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    public function insert($data)
    {
        $this->review_provider_id = $data['review_provider_id'];
        $this->review_accepter_id = $data['review_accepter_id'];
        $this->rating = $data['rating'];
        $this->review_msg = $data['review_msg'];
        $this->save();
        return $this;
    }
}
