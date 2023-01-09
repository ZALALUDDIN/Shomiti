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
        Schema::create('receives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MemberName');
            $table->string('paymentName');
            $table->string('month');
            $table->string('year');
            $table->string('amount');
            $table->date('paymentDate');
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('receives');
    }
};
