<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->date('birth_date');
            $table->string('address');
            $table->integer('contact')->nullable();
            $table->string('email')->nullable();
            $table->date('joined_date')->default(Carbon::now());
            $table->boolean('is_approved')->default(0);
            $table->unsignedBigInteger('atoll_id');
            $table->foreign('atoll_id')->references('id')->on('atolls')->onDelete('cascade');
            $table->unsignedBigInteger('island_id');
            $table->foreign('island_id')->references('id')->on('islands')->onDelete('cascade');
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
