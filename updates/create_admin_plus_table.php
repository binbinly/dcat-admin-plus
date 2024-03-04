<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationLogTable extends Migration
{

    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('admin_operation_log')) {
            Schema::create('admin_operation_log', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->bigInteger('user_id');
                $table->string('path');
                $table->string('method', 10);
                $table->string('ip');
                $table->text('input');
                $table->index('user_id');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('admin_exception_log')) {
            Schema::create('admin_exception_log', function (Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('type');
                $table->string('code');
                $table->string('message');
                $table->string('file');
                $table->integer('line');
                $table->text('trace');
                $table->string('method');
                $table->string('path');
                $table->text('query');
                $table->text('body');
                $table->text('cookies');
                $table->text('headers');
                $table->string('ip');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_operation_log');
        Schema::dropIfExists('admin_exception_log');
    }
};
