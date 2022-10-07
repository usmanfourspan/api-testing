<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{

    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class);
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
