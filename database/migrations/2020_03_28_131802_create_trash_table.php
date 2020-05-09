<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trash', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('state');
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->json('classrooms')->default('[]');
            $table->string('date')->nullable();
            $table->text('img')->nullable();
            $table->string('person')->nullable();
            $table->text('bio')->nullable();
            $table->text('content')->nullable();
            $table->text('text')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trash');
    }
}
