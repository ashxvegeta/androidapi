<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('image')->nullable(); // product image filename
            $table->string('status')->default('available'); // e.g. available, out_of_stock
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('pricediscount', 10, 2)->default(0); // discounted price
            $table->integer('stock')->default(0); // product stock
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
};
