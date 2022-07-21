<?php

namespace App\Services;

use App\Models\JobCategories;
use App\Models\Vacancies;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Constants;

class Helper
{
    /**Useful var_dump
     *
     * @param $data
     */
    public static function prent($data)
    {
        $bt = debug_backtrace();
        $bt = $bt[0];
        $file = $bt["file"];
        $line = $bt["line"];

        echo "<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: $file [$line]</div>";
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }



    /**Get professionalism skill percentage
     *
     * @param $professionalism
     */
    public static function getProfessionalismSkillPercentage(string $professionalism)
    {
        $arrAvailableValues = ['NOTHING', 'THEORETICAL', 'USED_ONCE', 'USED_OFTEN', 'EXPERT'];

        if (!in_array($professionalism, $arrAvailableValues)) {
            echo 'ПЕРЕДАН НЕВЕРНЫЙ ПАРАМЕТР';
            return false;
        }

        switch ($professionalism) {
            case 'NOTHING':
                $percentage = 0;
                break;
            case 'THEORETICAL':
                $percentage = 1;
                break;
            case 'USED_ONCE':
                $percentage = 5;
                break;
            case 'USED_OFTEN':
                $percentage = 10;
                break;
            case 'EXPERT':
                $percentage = 15;
                break;
        }

        return $percentage;
    }


    /**Get experience skill percentage
     *
     * @param $experience
     */
    public static function getExperienceSkillPercentage(string $experience)
    {
        $arrAvailableValues = ['NO_EXPERIENCE', 'LESS_ONE_YEAR', 'ONE_THREE_YEARS', 'THREE_FIVE_YEARS', 'MORE_FIVE_YEARS'];

        if (!in_array($experience, $arrAvailableValues)) {
            echo 'ПЕРЕДАН НЕВЕРНЫЙ ПАРАМЕТР';
            return false;
        }

        switch ($experience) {
            case 'NO_EXPERIENCE':
                $percentage = 0;
                break;
            case 'LESS_ONE_YEAR':
                $percentage = 5;
                break;
            case 'ONE_THREE_YEARS':
                $percentage = 10;
                break;
            case 'THREE_FIVE_YEARS':
                $percentage = 15;
                break;
            case 'MORE_FIVE_YEARS':
                $percentage = 20;
                break;
        }

        return $percentage;
    }





}
