<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->boolean('is_purchased')->default(0);
            $table->boolean('is_saved')->default(0);
            $table->string('creditcard_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('invoice_number')->unique();
            $table->integer('type')->default(0);
            $table->integer('day_duration')->default(0);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_back')->nullable();
            $table->double('deposit', 19, 2)->default(0);
            $table->double('bill', 19, 2)->default(0);
            $table->double('subtotal', 19, 2)->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('discount')->default(0);
            $table->double('grandtotal', 19, 2)->default(0);
            $table->double('cash', 19, 2)->default(0);
            $table->double('change', 19, 2)->default(0);
            $table->text('notes')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index("bank_id");
            $table->index("user_id");
            $table->index("customer_id");
            $table->index("driver_id");
            $table->index("is_purchased");
            $table->engine = 'InnoDB';
        });

        Schema::create('transactions_cars', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('car_id');
            $table->double('charge', 19, 2)->default(0);
            $table->index(['transaction_id','car_id']);
            $table->primary(['transaction_id','car_id']);
        });

        Schema::create('transactions_services', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('service_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->double('charge', 19, 2)->default(0);
            $table->index(['transaction_id','service_id']);
            $table->primary(['transaction_id','service_id']);
        });

        Schema::create('transactions_penalties', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('penalty_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->double('charge', 19, 2)->default(0);
            $table->index(['transaction_id','penalty_id']);
            $table->primary(['transaction_id','penalty_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transactions_cars');
        Schema::dropIfExists('transactions_services');
        Schema::dropIfExists('transactions_penalties');
    }
}
