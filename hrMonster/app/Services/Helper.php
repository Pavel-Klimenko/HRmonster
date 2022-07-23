<?php

namespace App\Services;

use App\Models\Company;


class Helper
{
    CONST CANDIDATES_CV_PATH = '/storage/candidatesCV/';


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

    /**Get candidate category
     *
     * @param $experience
     */
    public static function getCandidateCategory(int $totalCandidatePercentage)
    {
        if ($totalCandidatePercentage < 0 || $totalCandidatePercentage > 100) {
            echo 'ПЕРЕДАН НЕВЕРНЫЙ %';
            return false;
        }

        if ($totalCandidatePercentage >= 60) {
            $category = 'GOOD_CANDIDATES';
        } elseif ($totalCandidatePercentage >= 30 && $totalCandidatePercentage < 60) {
            $category = 'RESERVE';
        } elseif ($totalCandidatePercentage < 30) {
            $category = 'WEAK';
        }

        return $category;
    }

    /**Get company
     * only one company (Alfa version of application)
     *
     * @return mixed
     */
    public static function getCompany($companyID) {
        return Company::find($companyID)->toArray();
    }

    public static function saveCandidateCV($paramName)
    {
        $fullCVPath = $_SERVER['DOCUMENT_ROOT'] . self::CANDIDATES_CV_PATH;
        $file = $_FILES[$paramName];
        $filename = uniqid() . '_' . $file["name"];
        move_uploaded_file($file["tmp_name"], $fullCVPath . $filename);
        return self::CANDIDATES_CV_PATH . $filename;
    }

    public static function generateFileName($candidateRespondObject) {
        $name = decrypt($candidateRespondObject["NAME"]);
        $surname = decrypt($candidateRespondObject["SURNAME"]);

        $fileName = $name.'_'.$surname;
        $fileName .= '_('.$candidateRespondObject["CANDIDATE_TOTAL_PERCENTAGE"].'%).txt';
        return $fileName;
    }

    public static function createStorageFolder($relativePath) {
        $directory = $_SERVER['DOCUMENT_ROOT'] . $relativePath;
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        return $directory;
    }


    public static function generateUserFile($fileName, $vacancyObject, $candidateRespondObject) {

            $textFile = fopen($fileName, 'w') or die("не удалось создать файл");

            fwrite($textFile, 'Компания: ' . $vacancyObject["COMPANY_NAME"] . PHP_EOL);
            fwrite($textFile, 'Вакансия: ' . $vacancyObject["VACANCY_NAME"] . PHP_EOL . PHP_EOL);

            fwrite($textFile,  'ФИО кандидата: ' . decrypt($candidateRespondObject["NAME"]).' '.decrypt($candidateRespondObject["SURNAME"]).PHP_EOL);
            fwrite($textFile, 'Email кандидата: ' . decrypt($candidateRespondObject["EMAIL"]) . PHP_EOL);
            fwrite($textFile, 'Комментарий кандидата: ' . $candidateRespondObject["COMMENT"] . PHP_EOL);

            fwrite($textFile, PHP_EOL);
            fwrite($textFile, 'Результат автоматического анализа кандидата:'.PHP_EOL.PHP_EOL);

            fwrite($textFile, 'Процент по важным навыкам: '.$candidateRespondObject["IMPORTANT_SKILLS_%"].'%'.PHP_EOL);
            fwrite($textFile, 'Уровень владения '.$vacancyObject["NEED_PROFESSIONALISM_SKILL"].': ');
            fwrite($textFile, $candidateRespondObject["NEED_PROFESSIONALISM_SKILL"]);
            fwrite($textFile, ' (+'.$candidateRespondObject["NEED_PROFESSIONALISM_SKILL_%"].'%'.')'.PHP_EOL.PHP_EOL);

            fwrite($textFile, 'Опыт владения '.$vacancyObject["NEED_EXPERIENCE_SKILL"].': ');
            fwrite($textFile, $candidateRespondObject["NEED_EXPERIENCE_SKILL"]);
            fwrite($textFile, ' (+'.$candidateRespondObject["NEED_EXPERIENCE_SKILL_%"].'%'.')'.PHP_EOL);

            if ($candidateRespondObject["EXPERIENCE_SKILL_COMMERCE"]) {
                fwrite($textFile, '(Коммерческий опыт)'.PHP_EOL.PHP_EOL);
            }

            fwrite($textFile, 'Процент по дополнительным навыкам: '.$candidateRespondObject["ADDITIONAL_SKILLS_%"].'%'.PHP_EOL);

            if ($candidateRespondObject["ADDITIONAL_SUPER_SKILL"]) {
                fwrite($textFile, 'Владеет супернавыком: ' . $vacancyObject["ADDITIONAL_SUPER_SKILL"].' *');
            }

            fwrite($textFile, PHP_EOL.PHP_EOL);
            fwrite($textFile, 'Суммарный процент кандидата: '.$candidateRespondObject["CANDIDATE_TOTAL_PERCENTAGE"].'%'.PHP_EOL);
            fwrite($textFile, 'Категория кандидата: '.$candidateRespondObject["CANDIDATE_CATEGORY"]);
            fclose($textFile);

        }

}
