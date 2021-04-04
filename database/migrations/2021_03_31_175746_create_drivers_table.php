<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');            
            $table->string('contact_number',15);
            $table->string('profile_image');            
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->text('address');
            $table->integer('vehicle_type')->nullable();
            $table->double('driver_commission')->nullable();
            $table->string('account_holder_name');
            $table->string('account_number',50);
            $table->string('bank_name');
            $table->string('bank_location');
            $table->string('bic_swift_code',50);
            $table->string('payment_email');
            $table->integer('status');
            $table->integer('is_online');
            $table->integer('created_by');
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
        Schema::dropIfExists('drivers');
    }
}
