<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DummyDataUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $password = app("hash")->make('penulistest');

        DB::statement("
                INSERT INTO users (
                    name, email, password
                ) VALUES (
                    'Penulis Test', 'test@penulis.id', '$password'
                );        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DELETE FROM users");
    }
}
