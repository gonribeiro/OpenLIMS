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
        Schema::create('subsamples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id');
            $table->string('internalId')->nullable();
            $table->decimal('value_unit');
            $table->enum('unit', UnitMeasurement::getValues());
            $table->text('description')->nullable();
            $table->text('reason')->nullable();
            $table->dateTime('discarded_date')->nullable();
            $table->foreignId('discarded_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subsamples');
    }
};
