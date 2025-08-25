<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('person_search_dudok', function (Blueprint $table) {
            $table->id();
            $table->string('REGISTRATION_NO')->unique();
            $table->string('COMPANY_NAME');
            $table->string('CLIENT_ID')->unique();
            $table->string('PERSON_NAME');
            $table->string('FATHERS_NAME');
            $table->string('NATIONAL_ID')->unique(); // Bangladeshi NID length
            $table->date('BIRTH_DATE');
            $table->text('PRESENT_ADDRESS');
            $table->text('PERMANENT_ADDRESS');
            $table->timestamps();

            // Add indexes for searchable fields
            $table->index('PERSON_NAME');
            $table->index('FATHERS_NAME');
            $table->index('NATIONAL_ID');
            $table->index('COMPANY_NAME');
        });
    }

    public function down()
    {
        Schema::dropIfExists('person_search_dudok');
    }
};
