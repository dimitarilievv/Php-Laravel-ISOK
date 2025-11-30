<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('mechanic_first_name');
            $table->string('mechanic_last_name');

            $table->string('client_first_name');
            $table->string('client_last_name');

            $table->string('brand');
            $table->string('model');

            $table->string('licence_number');
            $table->text('description');

            $table->decimal('price', 10, 2);
            $table->date('received_at');
            $table->date('finished_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
