<?php

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
        Schema::create('main_files_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_folder_file_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->string('answer')->nullable();
            $table->boolean('status');
            $table->boolean('type')->default(1);
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
        Schema::dropIfExists('main_files_contents');
    }
};
