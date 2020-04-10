<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_code');
            $table->float('total',10,0);

            $table->uuid('customer_id')->nullable();
            $table->foreign('customer_id')
            ->references('id')->on('customers')
            ->onDelete('cascade');
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
        Schema::dropIfExists('selling_transactions');
    }
}
