<?php

use App\Enums\SampleType;
use App\Enums\Status;
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
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analysis_type_id');
            $table->string('name')->unique();
            $table->enum('sample_type', SampleType::getValues())->nullable();
            $table->enum('status', Status::getValues())->nullable();
            $table->text('description')->nullable();
            $table->json('attributes');
            $table->foreignId('created_by_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyses');
    }
};
