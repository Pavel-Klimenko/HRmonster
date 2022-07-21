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
        Schema::create('responses', function (Blueprint $table) {
            $table->id('ID')->autoIncrement();
            $table->integer('VACANCY_ID')->nullable();
            $table->boolean('IMPORTANT_SKILL_1')->default(false);
            $table->boolean('IMPORTANT_SKILL_2')->default(false);
            $table->boolean('IMPORTANT_SKILL_3')->default(false);
            $table->boolean('MINOR_SKILL_1')->default(false);
            $table->boolean('MINOR_SKILL_2')->default(false);

            $table->string('NEED_PROFESSIONALISM_SKILL')->nullable();
            $table->string('NEED_EXPERIENCE_SKILL')->nullable();
            $table->boolean('EXPERIENCE_SKILL_COMMERCE')->default(false);

            $table->boolean('ADDITIONAL_SKILL_1')->default(false);
            $table->boolean('ADDITIONAL_SKILL_2')->default(false);
            $table->boolean('ADDITIONAL_SKILL_3')->default(false);
            $table->boolean('ADDITIONAL_SUPER_SKILL')->default(false);
            $table->boolean('ADDITIONAL_TEST_SKILL_1')->default(false);
            $table->boolean('ADDITIONAL_TEST_SKILL_2')->default(false);

            $table->string('NAME')->nullable();
            $table->string('SURNAME')->nullable();
            $table->string('EMAIL')->nullable();
            $table->string('CANDIDATE_CV')->nullable();
            $table->mediumText('COMMENT')->nullable();

            $table->integer('IMPORTANT_SKILLS_%')->nullable();
            $table->integer('NEED_PROFESSIONALISM_SKILL_%')->nullable();
            $table->integer('NEED_EXPERIENCE_SKILL_%')->nullable();
            $table->integer('ADDITIONAL_SKILLS_%')->nullable();
            $table->integer('CANDIDATE_TOTAL_PERCENTAGE')->nullable();

            $table->string('CANDIDATE_CATEGORY')->nullable();
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
        Schema::dropIfExists('responses');
    }
};
