<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $primaryKey = "article_id";
    public $table = "article";
    public $timestamps = false;
}
