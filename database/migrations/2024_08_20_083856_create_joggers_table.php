<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Uid\Uuid;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('joggers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('last_name');
            $table->string('first_name');
            $table->uuid()->default(Uuid::v7());
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('display_name')->default(false);
            $table->boolean('gdpr_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joggers');
    }
};
