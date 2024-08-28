<?php

use App\Models\Runner;
use App\Models\Registration;
use App\Models\Trail;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trail::class)->constrained('trails')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->timestamp('registration_date')->useCurrent();
            $table->unsignedInteger('price')->nullable();
            $table->timestamps();
        });
        Schema::create('registration_runner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Registration::class)->constrained('registrations')->cascadeOnDelete();
            $table->foreignIdFor(Runner::class)->constrained('runners')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['registration_id', 'runner_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('registration_runner');
    }
};
