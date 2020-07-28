<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('staff_id');
            $table->string('invoice_number');
            $table->string('customer_id');
            $table->boolean('is_done');
            $table->date('due_date')->nullable();
            $table->integer('needs')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            $table->foreign('staff_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_headers');
    }
}
