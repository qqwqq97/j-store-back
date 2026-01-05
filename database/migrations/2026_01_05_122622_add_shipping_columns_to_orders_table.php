<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_zip', 20)->after('user_id');
            $table->string('shipping_address1')->after('shipping_zip');
            $table->string('shipping_address2')->nullable()->after('shipping_address1');
            $table->string('shipping_phone', 30)->after('shipping_address2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_zip',
                'shipping_address1',
                'shipping_address2',
                'shipping_phone',
            ]);
        });
    }
};
