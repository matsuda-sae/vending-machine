<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @ return void
     */
public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // 👈 IDを作る命令はこれ1行だけにします！
            $table->integer('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @ return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}