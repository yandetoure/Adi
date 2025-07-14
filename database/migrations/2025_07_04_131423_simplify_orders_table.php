<?php declare(strict_types=1);

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
            // Make subtotal nullable and add default value
            $table->decimal('subtotal', 10, 2)->nullable()->change();
            
            // Make billing address fields nullable
            $table->string('billing_first_name')->nullable()->change();
            $table->string('billing_last_name')->nullable()->change();
            $table->string('billing_email')->nullable()->change();
            $table->string('billing_phone')->nullable()->change();
            $table->string('billing_address')->nullable()->change();
            $table->string('billing_city')->nullable()->change();
            $table->string('billing_state')->nullable()->change();
            $table->string('billing_postal_code')->nullable()->change();
            $table->string('billing_country')->nullable()->change();
            
            // Make shipping address fields nullable
            $table->string('shipping_first_name')->nullable()->change();
            $table->string('shipping_last_name')->nullable()->change();
            $table->string('shipping_email')->nullable()->change();
            $table->string('shipping_phone')->nullable()->change();
            $table->string('shipping_city')->nullable()->change();
            $table->string('shipping_state')->nullable()->change();
            $table->string('shipping_postal_code')->nullable()->change();
            $table->string('shipping_country')->nullable()->change();
            
            // Add phone field if it doesn't exist
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert changes
            $table->decimal('subtotal', 10, 2)->nullable(false)->change();
            
            $table->string('billing_first_name')->nullable(false)->change();
            $table->string('billing_last_name')->nullable(false)->change();
            $table->string('billing_email')->nullable(false)->change();
            $table->string('billing_phone')->nullable(false)->change();
            $table->string('billing_address')->nullable(false)->change();
            $table->string('billing_city')->nullable(false)->change();
            $table->string('billing_state')->nullable(false)->change();
            $table->string('billing_postal_code')->nullable(false)->change();
            $table->string('billing_country')->nullable(false)->change();
            
            $table->string('shipping_first_name')->nullable(false)->change();
            $table->string('shipping_last_name')->nullable(false)->change();
            $table->string('shipping_email')->nullable(false)->change();
            $table->string('shipping_phone')->nullable(false)->change();
            $table->string('shipping_city')->nullable(false)->change();
            $table->string('shipping_state')->nullable(false)->change();
            $table->string('shipping_postal_code')->nullable(false)->change();
            $table->string('shipping_country')->nullable(false)->change();
            
            if (Schema::hasColumn('orders', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
