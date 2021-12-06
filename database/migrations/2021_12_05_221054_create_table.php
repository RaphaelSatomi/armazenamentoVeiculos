<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nome_veiculo');
            $table->string('link');
            $table->string('ano');
            $table->string('combustivel');
            $table->string('portas');
            $table->string('quilometragem');
            $table->string('cambio');
            $table->string('cor');
            $table->string('img');
            $table->string('preco');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('password');
        });

        DB::table('users')->insert(
            array(
                'user' => 'admin@admin.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT)
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
        Schema::dropIfExists('users');
    }
}
