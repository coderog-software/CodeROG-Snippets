<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnippetsTable extends Migration
{
    public function up()
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('snippet_type_id')->constrained('snippet_types')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('uid', 15)->unique();
            $table->string('name'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('snippets');
    }
}