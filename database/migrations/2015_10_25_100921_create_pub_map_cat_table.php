<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubMapCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_buss_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('cat_type', array('body', 'vehicle', 'house', 'hooding', 'event', 'other'));
            $table->string('img_hash1')->nullable();
            $table->string('img_hash2')->nullable();
            $table->string('img_hash3')->nullable();
            $table->string('min_amt')->nullable();
            $table->string('max_amt')->nullable();
            $table->string('avg_space')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pub_buss_detail');
    }
}
