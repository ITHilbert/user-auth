<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->default(2);

            $table->string('firstname', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('smallname', 10)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('edit_pw_token', 255)->nullable();
            $table->timestamp('edit_pw_token_end')->nullable();
            $table->bigInteger('anrede_id')->default(1)->comment('1 = Herr (Mr) 2 = Frau (Mrs)');
            $table->string('title',50)->nullable();
            $table->bigInteger('signature_rule_id')->default(1);
            $table->string('street',255)->nullable()->comment('Straße');
            $table->string('postcode',255)->nullable()->comment('PLZ');
            $table->string('city',255)->nullable()->comment('Ort');
            $table->string('country',255)->nullable()->comment('Land');
            $table->string('ustid',255)->nullable()->nullable()->comment('It is a tax id');
            $table->string('phone',255)->nullable()->comment('Telefon');
            $table->string('phone2',255)->nullable()->comment('Telefon2');
            $table->string('mobile',255)->nullable()->comment('Mobile');
            $table->string('fax',255)->nullable()->comment('Fax');
            $table->string('private_email',255)->nullable()->comment('Private E-Mail');
            $table->string('skype',255)->nullable()->comment('Skype');
            $table->double('hourly_rate', 8, 2)->nullable();
            $table->date('birthday')->nullable();
            $table->text('comment')->nullable()->comment('Kommentar');

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
