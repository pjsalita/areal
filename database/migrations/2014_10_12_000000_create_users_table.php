<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('position')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('account_type', ['architect', 'client', 'admin'])->default('client');
            $table->json('address')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active_status')->default(0);
            $table->string('avatar')->nullable();
            $table->boolean('dark_mode')->default(0);
            $table->string('messenger_color')->default('#6b969d');
            $table->json('google_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
