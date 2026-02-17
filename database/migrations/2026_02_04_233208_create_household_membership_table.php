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
        Schema::create('household_membership', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('role')->default(HouseholdRole::MEMBER->label());
            $table->string('status')->default(MembershipStatus::INVITED->label());
            $table->string('invite_token')->nullable()->unique();

            // $table->timestamp('invited_at')->nullable();
            // $table->timestamp('accepted_at')->nullable();
            // $table->timestamp('declined_at')->nullable();
            // $table->timestamp('removed_at')->nullable();

            $table->timestamps();

            $table->unique(['household_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_membership');
    }
};
