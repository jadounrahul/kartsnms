<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('mefinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id')->index();
            $table->integer('mefID')->index();
            $table->string('mefType', 128);
            $table->string('mefIdent', 128);
            $table->integer('mefMTU')->default(1500);
            $table->string('mefAdmState', 128);
            $table->string('mefRowState', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('mefinfo');
    }
};
