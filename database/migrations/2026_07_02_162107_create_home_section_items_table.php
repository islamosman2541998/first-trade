<?php

use App\Models\HomeSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_section_items', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(HomeSection::class)->constrained()->cascadeOnDelete();

            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_nl')->nullable();

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_nl')->nullable();

            $table->string('icon')->nullable();
            $table->string('image')->nullable();

            $table->string('button_text_en')->nullable();
            $table->string('button_text_ar')->nullable();
            $table->string('button_text_nl')->nullable();

            $table->string('button_link')->nullable();
            $table->string('button_target')->default('_self');

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->json('settings')->nullable();

            $table->timestamps();

            $table->index('home_section_id');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_section_items');
    }
};