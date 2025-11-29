<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'category_id' => 3,
                'name' => 'Wool Knit Sweater',
                'description' => '暖かいニット・フワフワ・肌心地良い',
                'price' => 7800,
                'stock' => 100,
                'image_url' => '/images/shohin/sweater.jpg',
                'created_at' => now()->subDays(7),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'name' => 'Leather Mini Bag',
                'description' => '20代超人気・軽い',
                'price' => 12000,
                'stock' => 150,
                'image_url' => '/images/shohin/leatherbag.webp',
                'created_at' => now()->subDays(7),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'name' => 'iPhone Case',
                'description' => '可愛い・iphone13・14・15用',
                'price' => 1300,
                'stock' => 1550,
                'image_url' => '/images/shohin/iphonecase.jpg',
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
            ],
            [
                'category_id' => 7,
                'name' => 'Wireless Earbuds',
                'description' => '可愛いデザイン',
                'price' => 17800,
                'stock' => 44,
                'image_url' => '/images/shohin/earbuds.avif',
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
