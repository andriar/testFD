<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refractions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('od_vsc', 10, 2)->default(0);
            $table->float('od_sph', 10, 2)->default(0);
            $table->float('od_cyl', 10, 2)->default(0);
            $table->float('od_axis', 10, 2)->default(0);
            $table->float('od_add', 10, 2)->default(0);
            $table->float('od_sh', 10, 2)->default(0);
            $table->float('od_pd', 10, 2)->default(0);
            $table->float('os_sph', 10, 2)->default(0);
            $table->float('os_cyl', 10, 2)->default(0);
            $table->float('os_axis', 10, 2)->default(0);
            $table->float('os_add', 10, 2)->default(0);
            $table->float('os_sh', 10, 2)->default(0);
            $table->float('os_pd', 10, 2)->default(0);

            $table->uuid('selling_transaction_id')->nullable();
            $table->foreign('selling_transaction_id')
            ->references('id')->on('selling_transactions')
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
        Schema::dropIfExists('refractions');
    }
}
