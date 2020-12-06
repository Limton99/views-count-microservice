<?php
namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Миграция для таблицы NbViews
 */
class CreateNbViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_views', function (Blueprint $table) {
            $table->id();
            $table->string('projectId');
            $table->string('entityId');
            $table->string('objectId');
            $table->integer('nb_views');
            $table->integer('nb_phone_views');
            $table->integer('return_counters');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nb_views');
    }
}
