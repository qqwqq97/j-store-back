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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('img')->nullable();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });

        DB::table('categories')->insert([
            [
                'name' => 'ALL',
                'img' => null,
                'path' => '/products/all',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NEW', 
                'img' => null,
                'path' => '/products/new',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'CLOTHING', 
                'img' => '/images/categories/cat-clothing.jpg',
                'path' => '/products/clothing',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'COSMETICS', 
                'img' => '/images/categories/cat-cosmetics.jpg',
                'path' => '/products/cosmetics',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ACCESSORIES', 
                'img' => '/images/categories/cat-accessories.jpg',
                'path' => '/products/accessories',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'GROCERY', 
                'img' => null,
                'path' => '/products/grocery',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $electronicsId = DB::table('categories')->insertGetId([
            'name' => 'ELECTRONICS',
            'img' => '/images/categories/cat-electronics.jpeg',
            'path' => '/products/electronics',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
            [
                'name' => 'PHONE',
                'img' => null,
                'path' => '/products/electronics/phone',
                'parent_id' => $electronicsId,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'COMPUTERS',
                'img' => null,
                'path' => '/products/electronics/computer',
                'parent_id' => $electronicsId,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
