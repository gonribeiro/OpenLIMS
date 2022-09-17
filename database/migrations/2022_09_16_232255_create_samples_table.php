<?php

use App\Enums\Status;
use App\Enums\UnitMeasurement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_type_id');
            $table->string('internal_id')->nullable();
            $table->string('external_id')->nullable();
            $table->foreignId('customer_id');
            $table->decimal('value_unit');
            $table->enum('status', Status::getValues())->nullable();
            $table->enum('unit', UnitMeasurement::getValues());
            $table->dateTime('collected_date');
            $table->foreignId('collected_by_id');
            $table->dateTime('received_date');
            $table->foreignId('received_by_id');
            $table->text('description')->nullable();
            $table->dateTime('discarded_date')->nullable();
            $table->foreignId('discarded_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('collected_by_id')->references('id')->on('users');
            $table->foreign('received_by_id')->references('id')->on('users');
            $table->foreign('discarded_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samples');
    }
};
