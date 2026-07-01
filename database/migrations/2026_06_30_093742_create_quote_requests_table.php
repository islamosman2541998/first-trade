<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Product::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(User::class, 'assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('name');
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('email');
            $table->string('phone');

            $table->string('quantity')->nullable();
            $table->text('message')->nullable();

            $table->string('status')->default('new');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('product_id');
            $table->index('assigned_to');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};