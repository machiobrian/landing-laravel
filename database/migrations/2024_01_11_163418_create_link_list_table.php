<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // up method - called with `artisan migrate'
    {
        Schema::create('link_list', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 60);
            $table->string('slug', 60)->unique();
            $table->text('decsriptiom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // down method - `artisan rollback` - drop/revert structure
    {
        Schema::dropIfExists('link_list');
    }
}
