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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['transaction_code', 'customer_name', 'total_price']);
            $table->decimal('total', 15, 2)->after('id');
            $table->decimal('discount', 5, 2)->after('total');
            $table->string('payment_method')->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_code')->unique()->after('id');
            $table->string('customer_name')->after('transaction_code');
            $table->integer('total_price')->after('customer_name');
            $table->dropColumn(['total', 'discount', 'payment_method']);
        });
    }
};
