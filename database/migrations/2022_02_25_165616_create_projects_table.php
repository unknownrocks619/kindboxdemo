<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("organiser_id");
            $table->string("category_id");
            $table->string("project_title");
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('country');
            $table->string('address')->nullable();
            $table->string("featured_image")->nullable();
            $table->string("city")->nullable();
            $table->string('total_budget')->nullable();
            $table->string('deduct_amount')->nullable();
            $table->string("total_collected")->defualt(0);
            $table->boolean("completed")->default(false);
            $table->longText('map_link')->nullable();
            $table->longText("map_embed")->nullable();
            $table->string('school_name')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
