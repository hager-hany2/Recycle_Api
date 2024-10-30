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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', ['admin', 'user','مستخدم','ادمن'])->default('user');
            $table->enum('category_user', ['restaurant', 'home', 'school','مطعم','منزل','مدرسة'])->nullable(); // يملأ فقط للمستخدم العادي
            $table->string('api_token', 80)->unique()->nullable(); // حقل لتخزين API Token
            //$table->string('address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
