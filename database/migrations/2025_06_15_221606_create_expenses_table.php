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
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->json('names');     // أسماء الأشخاص
        $table->json('amounts');   // المبالغ المدفوعة
        $table->float('total');
        $table->float('share');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
