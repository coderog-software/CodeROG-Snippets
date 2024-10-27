<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnippetTypesTable extends Migration
{
    public function up()
    {
        Schema::create('snippet_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Unique name for the snippet type
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('snippet_types');
    }
}
