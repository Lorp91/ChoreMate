<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
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
        Schema::create('household_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')
                ->constrained('households')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('role')->default(HouseholdRole::MEMBER->label());
            $table->string('status')->default(MembershipStatus::INVITED->label());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_memberships');
    }
};
