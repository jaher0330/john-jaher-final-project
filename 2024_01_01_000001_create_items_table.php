<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->string('category')->default('others');
            $table->enum('type', ['lost', 'found']);
            $table->text('description');
            $table->string('location');
            $table->date('date_reported');
           $table->enum('status', ['on_hand', 'turned_over', 'claimed', 'missing'])->default('on_hand');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
