<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade') // Updates if id is modified in users
            ->onDelete('restrict'); // Stays if id is destroyed in users
            $table->string('title');
            $table->string('description');
            $table->string('url');
            $table->enum('category', ['Node', 'React', 'Angular', 'JavaScript', 'Java', 'Fullstack PHP', 'Data Science', 'BBDD']);
            //$table->set('tags', ['Components', 'UseState & UseEffect', 'Eventos' , 'Renderizado condicional', 'Listas', 'Estilos', 'Debugging', 'React Router'])->nullable();
            $table->json('tags')->nullable(); // Options are defined in Form Request
            $table->enum('type', ['Video', 'Cursos', 'Blog']);
            $table->integer('bookmark_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
