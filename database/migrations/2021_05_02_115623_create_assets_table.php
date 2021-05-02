<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_asset_id')->nullable();
            $table->integer('registered_person_id');
            $table->string('asset_code', 255);
            $table->string('asset_name', 255);
            $table->string('acquisition_date', 15);
            $table->string('model', 255);
            $table->integer('number_of_assets');
            $table->string('operational_verification', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
