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
        Schema::create('hrDevice', function (Blueprint $table) {
            $table->increments('hrDevice_id');
            $table->unsignedInteger('device_id')->index();
            $table->integer('hrDeviceIndex');
            $table->text('hrDeviceDescr');
            $table->text('hrDeviceType');
            $table->integer('hrDeviceErrors')->default(0);
            $table->text('hrDeviceStatus');
            $table->tinyInteger('hrProcessorLoad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('hrDevice');
    }
};
