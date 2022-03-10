<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('divisions', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('company_id');
      $table->string('name');
      $table->string('slug');
      $table->timestamps();

      $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('divisions');
  }
}
