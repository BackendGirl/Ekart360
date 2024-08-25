<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('driver')->nullable();
            $table->text('host')->nullable();
            $table->text('port')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->text('encryption')->nullable();
            $table->text('sender_email')->nullable();
            $table->text('sender_name')->nullable();
            $table->text('reply_email')->nullable();
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('mail_settings');
    }
}
