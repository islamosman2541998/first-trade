<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Product::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('country')->nullable();

            $table->string('product_name')->nullable();
            $table->string('quantity')->nullable();

            $table->text('message')->nullable();
            $table->string('attachment')->nullable();

            $table->string('status')->default('new');
            $table->text('admin_notes')->nullable();

            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index('product_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};