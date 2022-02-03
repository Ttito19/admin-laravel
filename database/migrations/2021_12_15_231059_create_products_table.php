<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("sku");
            $table->string("name");
            $table->text("description");
            $table->decimal('price', 8, 2);
            $table->integer("stock");
            $table->string("image");
            $table->foreignId("categorie_id")
            ->nullable()
            ->constrained("categories")
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId("brand_id")
            ->nullable()
            ->constrained("brands")
            ->cascadeOnUpdate()
            ->nullOnDelete();


            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
