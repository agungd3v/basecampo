<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssignTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('task_assign', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('assign_to')->index();
      $table->unsignedBigInteger('task_id')->index();
      $table->timestamps();

      $table->foreign('assign_to')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
      $table->foreign('task_id')->references('id')->on('tasks')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('task_assign');
  }
}
