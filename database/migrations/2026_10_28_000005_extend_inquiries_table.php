<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->date('preferred_date')->nullable()->after('reference');
            $table->string('preferred_time', 50)->nullable()->after('preferred_date');
            $table->text('internal_notes')->nullable()->after('message');
            $table->boolean('is_read')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['preferred_date', 'preferred_time', 'internal_notes', 'is_read']);
        });
    }
};
