<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (\Illuminate\Support\Facades\DB::getDriverName() === 'pgsql') {
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE igniter_coupons_history ALTER COLUMN coupon_id TYPE bigint USING coupon_id::bigint');
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE igniter_coupons_history ALTER COLUMN order_id TYPE bigint USING order_id::bigint, ALTER COLUMN order_id DROP NOT NULL');
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE igniter_coupons_history ALTER COLUMN customer_id TYPE bigint USING customer_id::bigint, ALTER COLUMN customer_id DROP NOT NULL');
        } else {
            Schema::table('igniter_coupons_history', function(Blueprint $table): void {
                $table->unsignedBigInteger('coupon_id')->change();
                $table->unsignedBigInteger('order_id')->nullable()->change();
                $table->unsignedBigInteger('customer_id')->nullable()->change();
            });
        }
    }

    public function down(): void {}
};
