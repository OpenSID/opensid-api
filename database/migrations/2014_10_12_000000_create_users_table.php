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
        Schema::table('tweb_penduduk_mandiri', function (Blueprint $table) {
            $table->decimal('nik', 16, 0)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweb_penduduk_mandiri', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'email',
                'email_verified_at',
                'password',
                'remember_token',
                'updated_at']);
        });
    }
}
