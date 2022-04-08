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
            $table->timestamps();
            $table->uuid('uuid')->nullable();
            $table->string('name')->nullable();
            $table->float('price')->nullable();
            $table->boolean('is_publish')->nullable(false);
            $table->boolean('is_deleted')->default(false);

            $table->index('uuid');
            $table->index('name');
            $table->index('is_publish');
            $table->index('is_deleted');
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
