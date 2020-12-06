<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
    protected $primaryKey = "topic_id";
    public $table = "topic";
    public $timestamps = false;
}
