<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Database\Seeder;

class DashboardDemoSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::query()->get();
        $categories = Category::query()->get();

        $names = [
            'Ahmed Hassan',
            'Mohamed Ali',
            'Sara Mostafa',
            'Omar Khaled',
            'Youssef Ibrahim',
            'Nour Mohamed',
            'Maya Export',
            'Green Market BV',
            'Fresh Supply Co',
            'Delta Foods',
            'Global Fruits',
            'Euro Fresh Trade',
        ];

        $subjects = [
            'Product inquiry',
            'Export cooperation',
            'Wholesale request',
            'Packing details',
            'Shipping information',
            'Season availability',
        ];

        /*
        |--------------------------------------------------------------------------
        | Contact Messages Demo Data - Last 6 Months
        |--------------------------------------------------------------------------
        */
        foreach (range(5, 0) as $monthIndex) {
            $date = now()->subMonths($monthIndex);

            foreach (range(1, rand(3, 8)) as $i) {
                ContactMessage::create([
                    'name' => fake()->randomElement($names),
                    'email' => fake()->safeEmail(),
                    'phone' => '+20 10' . rand(10000000, 99999999),
                    'company' => fake()->company(),
                    'subject' => fake()->randomElement($subjects),
                    'message' => 'We are interested in your fresh produce and would like to know more about availability, packing options, and export process.',
                    'preferred_contact_method' => fake()->randomElement(['phone', 'email', 'whatsapp']),
                    'status' => fake()->randomElement(['new', 'read', 'replied', 'closed']),
                    'created_at' => $date->copy()->day(rand(1, 25))->hour(rand(9, 18)),
                    'updated_at' => $date->copy()->day(rand(1, 25))->hour(rand(9, 18)),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Quote Requests Demo Data - Last 6 Months
        |--------------------------------------------------------------------------
        */
        foreach (range(5, 0) as $monthIndex) {
            $date = now()->subMonths($monthIndex);

            foreach (range(1, rand(2, 7)) as $i) {
                $product = $products->random();
                $category = $product->category ?: $categories->random();

                QuoteRequest::create([
                    'product_id' => $product?->id,
                    'category_id' => $category?->id,
                    'name' => fake()->randomElement($names),
                    'email' => fake()->safeEmail(),
                    'phone' => '+20 10' . rand(10000000, 99999999),
                    'company' => fake()->company(),
                    'country' => fake()->randomElement(['Egypt', 'Netherlands', 'Germany', 'UAE', 'Saudi Arabia', 'Italy']),
                    'product_name' => $product?->name,
                    'quantity' => fake()->randomElement(['1 Container', '5 Tons', '10 Tons', '100 Cartons', 'As Available']),
                    'message' => 'Please send us your best quotation including packing options, availability, and delivery terms.',
                    'status' => fake()->randomElement(['new', 'contacted', 'in_progress', 'closed']),
                    'created_at' => $date->copy()->day(rand(1, 25))->hour(rand(9, 18)),
                    'updated_at' => $date->copy()->day(rand(1, 25))->hour(rand(9, 18)),
                ]);
            }
        }
    }
}