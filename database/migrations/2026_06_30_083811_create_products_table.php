<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();

            $table->string('main_image')->nullable();

            $table->string('country_of_origin')->nullable();
            $table->string('season')->nullable();
            $table->string('packaging')->nullable();
            $table->string('size')->nullable();
            $table->string('grade')->nullable();
            $table->string('availability')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index('category_id');
            $table->index('slug');
            $table->index('sku');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};