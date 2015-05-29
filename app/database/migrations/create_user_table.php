<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('users', function(Blueprint $table)
      {
          $table->increments('user_id');
          $table->string('user_name', 100);
          $table->string('password', 255);
          $table->string('email', 255);
		  $table->integer('zip_id',1);

          // required for Laravel 4.1.26
          $table->string('remember_token', 100)->nullable();
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
      Schema::drop('users');
  }

}