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
        Schema::table('users', function (Blueprint $table) {
            // Ubah role dari single menjadi JSON array untuk multi-role
            $table->json('roles')->nullable()->after('email_verified_at');

            // Nailist-specific fields
            $table->boolean('is_nailist_approved')->default(false)->after('roles');
            $table->string('salon_name')->nullable()->after('is_nailist_approved');
            $table->string('phone')->nullable()->after('salon_name');
            $table->text('bio')->nullable()->after('phone');
            $table->string('whatsapp')->nullable()->after('bio');
            $table->string('instagram')->nullable()->after('whatsapp');
            $table->string('address')->nullable()->after('instagram');
            $table->string('profile_photo')->nullable()->after('address');

            // Drop old role column if exists
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'roles',
                'is_nailist_approved',
                'salon_name',
                'phone',
                'bio',
                'whatsapp',
                'instagram',
                'address',
                'profile_photo'
            ]);

            // Re-add old role column
            $table->enum('role', ['user', 'admin'])->default('user');
        });
    }
};
