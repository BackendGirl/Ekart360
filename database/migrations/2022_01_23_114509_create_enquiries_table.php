<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('reference_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->integer('program_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('purpose')->nullable();
            $table->text('note')->nullable();
            $table->date('date');
            $table->date('follow_up_date')->nullable();
            $table->string('assigned')->nullable();
            $table->integer('number_of_students')->default('1');
            $table->boolean('status')->default('1');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('reference_id')
                    ->references('id')->on('enquiry_references');
            $table->foreign('source_id')
                    ->references('id')->on('enquiry_sources');
            $table->foreign('program_id')
                    ->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}
