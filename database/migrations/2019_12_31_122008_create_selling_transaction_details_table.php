<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('qty')->default(0);
            $table->float('price',10,0);

            $table->uuid('good_id')->nullable();
            $table->foreign('good_id')
            ->references('id')->on('goods')
            ->onDelete('cascade');
            $table->uuid('purchase_transaction_id')->nullable();
            $table->foreign('purchase_transaction_id')
            ->references('id')->on('purchase_transactions')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selling_transaction_details');
    }
}
