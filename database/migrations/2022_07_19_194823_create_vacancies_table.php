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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id('ID')->autoIncrement();
            $table->string('COMPANY_ID')->nullable();
            $table->string('COMPANY_NAME')->nullable();
            $table->string('VACANCY_NAME')->nullable();
            $table->string('IMPORTANT_SKILL_1')->nullable();
            $table->string('IMPORTANT_SKILL_2')->nullable();
            $table->string('IMPORTANT_SKILL_3')->nullable();
            $table->string('MINOR_SKILL_1')->nullable();
            $table->string('MINOR_SKILL_2')->nullable();
            $table->string('NEED_PROFESSIONALISM_SKILL')->nullable();
            $table->string('NEED_EXPERIENCE_SKILL')->nullable();
            $table->string('ADDITIONAL_SKILL_1')->nullable();
            $table->string('ADDITIONAL_SKILL_2')->nullable();
            $table->string('ADDITIONAL_SKILL_3')->nullable();
            $table->string('ADDITIONAL_SUPER_SKILL')->nullable();
            $table->string('ADDITIONAL_TEST_SKILL_1')->nullable();
            $table->string('ADDITIONAL_TEST_SKILL_2')->nullable();
            $table->mediumText('BEST_CANDIDATES_RESPONSE')->nullable();
            $table->mediumText('RESERVE_CANDIDATES_RESPONSE')->nullable();
            $table->mediumText('WEAK_CANDIDATES_RESPONSE')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
};
