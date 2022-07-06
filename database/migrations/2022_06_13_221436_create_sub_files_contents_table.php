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
        Schema::create('sub_files_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_folder_file_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->string('answer')->nullable();
            $table->boolean('status');
            $table->boolean('type')->default(0);
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
        Schema::dropIfExists('sub_files_contents');
    }
};
