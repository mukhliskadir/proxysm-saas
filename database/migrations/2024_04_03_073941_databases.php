<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
       
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('duration_days');
            $table->timestamps();
        });

        Schema::create('user_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->dateTime('payment_date');
            $table->string('payment_method');
            $table->timestamps();
        });

        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('expiry_date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('tokens');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('user_packages');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('products');    }
};
