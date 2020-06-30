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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('sku')->nullable()->unique();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('price','15','2')->default(0); //'', 'tổng số chữ số', 'số thập phân'
            $table->boolean('featured')->default(false);
            $table->string('avatar')->nullable();
            $table->string('description')->nullable();
            $table->text('detail')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
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
