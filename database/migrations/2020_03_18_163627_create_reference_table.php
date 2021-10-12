<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('charge', 19, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('identities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('fuels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index("code");
            $table->engine = 'InnoDB';
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identity_id');
            $table->string('image')->nullable();
            $table->string('id_number');
            $table->string('code');
            $table->string('name');
            $table->integer('gender')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('fax_number')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_ready')->default(0);
            $table->timestamps();
            $table->softDeletes();
            // Indexing
            $table->index("identity_id");
            $table->index("id_number");
            $table->index("code");
            // End Indexing
            $table->engine = 'InnoDB';
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identity_id');
            $table->string('image')->nullable();
            $table->string('id_number');
            $table->string('code');
            $table->string('name');
            $table->integer('gender')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('fax_number')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_banned')->default(0);
            $table->timestamps();
            $table->softDeletes();
             // Indexing
             $table->index("identity_id");
             $table->index("id_number");
             $table->index("code");
             // End Indexing
            $table->engine = 'InnoDB';
        });

        Schema::create('customers_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->text('path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
             // Indexing
             $table->index("customer_id");
             // End Indexing
            $table->engine = 'InnoDB';
        });

        Schema::create('customers_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->text('image')->nullable();
            $table->string('name');
            $table->integer('gender')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('fax_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
             // Indexing
             $table->index("customer_id");
             // End Indexing
            $table->engine = 'InnoDB';
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('model_id'); // model
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('fuel_id');
            $table->string('color')->nullable();
            $table->string('id_number');
            $table->integer('year_established')->default(0);
            $table->integer('length')->default(0);
            $table->integer('width')->default(0);
            $table->integer('height')->default(0);
            $table->integer('capacity')->default(0);
            $table->double('charge', 19, 2)->default(0);
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_rent')->default(0);
            $table->timestamps();
            $table->softDeletes();
            // Indexing
            $table->index("brand_id");
            $table->index("model_id");
            $table->index("status_id");
            $table->index("type_id");
            $table->index("fuel_id");
            $table->index("color");
            $table->index("id_number");
            $table->index("year_established");
            $table->index("is_rent");
            // End Indexing
            $table->engine = 'InnoDB';
        });

        Schema::create('cars_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_id');
            $table->text('path')->nullable();
            $table->boolean('is_primary')->default(0);
            $table->timestamps();
            // Indexing
            $table->index("car_id");
            // End Indexing
            $table->engine = 'InnoDB';
       });

       Schema::create('cars_penalties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->double('cost', 19, 2)->default(0);
            $table->timestamps();
            // Indexing
            $table->index("car_id");
            // End Indexing
            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('identities');
        Schema::dropIfExists('status');
        Schema::dropIfExists('fuels');
        Schema::dropIfExists('types');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('models');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_files');
        Schema::dropIfExists('customers_contacts');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('cars_images');
        Schema::dropIfExists('cars_penalties');
    }
}
