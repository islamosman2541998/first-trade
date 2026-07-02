<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();

            $table->string('subject')->nullable();
            $table->text('message');

            $table->string('preferred_contact_method')->nullable();

            $table->string('status')->default('new');
            $table->text('admin_notes')->nullable();

            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('preferred_contact_method');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};