<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('permission_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id')->index();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['permission_id', 'locale']);
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_translations');
    }
}
