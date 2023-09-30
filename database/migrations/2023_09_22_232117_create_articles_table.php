<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->text('description')->index();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_approved')->default(0)->index();
            $table->integer('views_count')->default(0);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE articles ADD FULLTEXT search(title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
