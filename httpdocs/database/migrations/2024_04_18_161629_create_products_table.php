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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // Створює стовпці 'created_at' та 'updated_at'
            $table->string('name');  // Стовпець для назви товару
            $table->text('description')->nullable();  // Стовпець для опису товару, який може бути порожнім
            $table->decimal('price', 8, 2);  // Стовпець для ціни товару
            $table->unsignedInteger('stock');  // Стовпець для кількості товару на складі
            $table->string('image')->nullable();  // Стовпець для збереження шляху до зображення товару
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
