<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacancies;
use App\Models\Responses;

use App\Services\Helper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**Creating company
     *
     * @param Request $request
     */
    public function showOrCreateCompany(Request $request)
    {
        //это POST массив из формы
        $arrParams = [
            'COMPANY_NAME' => 'TestCompany',
            'YOUTUBE_VIDEO' => 'https://youtu.be/6PNz143qu5c',
            'COMPANY_DESCRIPTION' => ' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularis',
        ];

        $company = Company::firstOrCreate($arrParams);

        if ($company) {
            $company = $company->toArray();
            Helper::prent($company);
        }
    }




    /**Creating vacancy by HR
     *
     * @param Request $request
     */
    public function createVacancy(Request $request)
    {
        $company = Helper::getCompany();

        //это POST массив из формы
        $arrParams = [
            'COMPANY_NAME' => $company["COMPANY_NAME"],
            'VACANCY_NAME' => 'TestDeveloper',

            'IMPORTANT_SKILL_1' => 'PHP',
            'IMPORTANT_SKILL_2' => 'JS',
            'IMPORTANT_SKILL_3' => 'SQL',
            'MINOR_SKILL_1' => 'YII-2',
            'MINOR_SKILL_2' => 'Bitrix',

            'NEED_PROFESSIONALISM_SKILL' => 'PHP',
            'NEED_EXPERIENCE_SKILL' => 'SQL',

            'ADDITIONAL_SKILL_1' => 'MICROSERVICES',
            'ADDITIONAL_SKILL_2' => 'LINUX',
            'ADDITIONAL_SKILL_3' => 'ENGLISH',
            'ADDITIONAL_SUPER_SKILL' => 'BIG_DATA',
            'ADDITIONAL_TEST_SKILL_1' => 'WORD',
            'ADDITIONAL_TEST_SKILL_2' => 'EXEL',


            'BEST_CANDIDATES_RESPONSE' => 'BEST It was popularised in the 1960s with the release
                                  of Letraset sheets containing Lorem Ipsum passages,
                                  and more recently with desktop publishing software
                                  like Aldus PageMaker including versions of Lorem Ipsum.',

            'RESERVE_CANDIDATES_RESPONSE' => 'RESERVE It was popularised in the 1960s with the release
                                  of Letraset sheets containing Lorem Ipsum passages,
                                  and more recently with desktop publishing software
                                  like Aldus PageMaker including versions of Lorem Ipsum.',

            'WEAK_CANDIDATES_RESPONSE' => 'WEAK It was popularised in the 1960s with the release
                                  of Letraset sheets containing Lorem Ipsum passages,
                                  and more recently with desktop publishing software
                                  like Aldus PageMaker including versions of Lorem Ipsum.',

        ];

        Vacancies::create($arrParams);
    }


    /**Candidate is responding to a vacancy
     *
     * @param Request $request
     */
    public function respondToVacancy(Request $request)
    {

        $vacancyId = 1;

        //это POST массив из формы, которую заполняет кандидат

        $arrParams = [
            'VACANCY_ID' => $vacancyId, //передается с Фронт-енд

            //знание 5 навыков (определены HR)
            'IMPORTANT_SKILL_1' => true,
            'IMPORTANT_SKILL_2' => true,
            'IMPORTANT_SKILL_3' => false,
            'MINOR_SKILL_1' => false,
            'MINOR_SKILL_2' => true,

            //уровни владения навыком 1 навыком (выбран HR) варианты:
            // NOTHING, THEORETICAL, USED_ONCE, USED_OFTEN, EXPERT
            'NEED_PROFESSIONALISM_SKILL' => 'EXPERT',

            //опыт с одним 1 навыком (выбран HR) варианты:
            //NO_EXPERIENCE, LESS_ONE_YEAR, ONE_THREE_YEARS, THREE_FIVE_YEARS, MORE_FIVE_YEARS
            'NEED_EXPERIENCE_SKILL' => 'THREE_FIVE_YEARS',
            'EXPERIENCE_SKILL_COMMERCE' => true,

            //знание 6 доп. навыков (определены HR)
            'ADDITIONAL_SKILL_1' => true,
            'ADDITIONAL_SKILL_2' => true,
            'ADDITIONAL_SKILL_3' => false,
            'ADDITIONAL_SUPER_SKILL' => true,
            'ADDITIONAL_TEST_SKILL_1' => true,
            'ADDITIONAL_TEST_SKILL_2' => false,

            'NAME' => 'Alex',
            'SURNAME' => 'Fogalov',
            'EMAIL' => 'Fogalov@mail.ru',
            'CANDIDATE_CV' => 'LINK_TO_FILE', //TODO принять файл
            'COMMENT' => 'the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop pu',
        ];


        //Расчет процентов и определение кандидата в категорию

        $arrImportantSkills = [
            $arrParams['IMPORTANT_SKILL_1'],
            $arrParams['IMPORTANT_SKILL_2'],
            $arrParams['IMPORTANT_SKILL_3'],
        ];

        //Important skills
        $importantSkillsPercentage = 0;
        foreach ($arrImportantSkills as $skill) {
            if ($skill) $importantSkillsPercentage += 15;
        }

        $arrParams['IMPORTANT_SKILLS_%'] = $importantSkillsPercentage;


        //Helper::prent($arrParams['IMPORTANT_SKILLS_%']);

        $arrParams['NEED_PROFESSIONALISM_SKILL_%'] = Helper::getProfessionalismSkillPercentage($arrParams['NEED_PROFESSIONALISM_SKILL']);
        $arrParams['NEED_EXPERIENCE_SKILL_%'] = Helper::getExperienceSkillPercentage($arrParams['NEED_EXPERIENCE_SKILL']);

        //Helper::prent($arrParams['NEED_PROFESSIONALISM_SKILL_%']);
        //Helper::prent($arrParams['NEED_EXPERIENCE_SKILL_%']);

        $arrAdditionalSkills = [
            $arrParams['ADDITIONAL_SKILL_1'],
            $arrParams['ADDITIONAL_SKILL_2'],
            $arrParams['ADDITIONAL_SKILL_3'],
            $arrParams['ADDITIONAL_SUPER_SKILL'],
        ];

        //Additional skills
        $additionalSkillsPercentage = 0;
        foreach ($arrAdditionalSkills as $skill) {
            if ($skill) $additionalSkillsPercentage += 5;
        }

        $arrParams['ADDITIONAL_SKILLS_%'] = $additionalSkillsPercentage;

        //Helper::prent($arrParams['ADDITIONAL_SKILLS_%']);

        $arrAllValuableSkills = [
            $arrParams['IMPORTANT_SKILLS_%'],
            $arrParams['NEED_PROFESSIONALISM_SKILL_%'],
            $arrParams['NEED_EXPERIENCE_SKILL_%'],
            $arrParams['ADDITIONAL_SKILLS_%']
        ];

        $arrParams['CANDIDATE_TOTAL_PERCENTAGE'] = array_sum($arrAllValuableSkills);
        $arrParams['CANDIDATE_CATEGORY'] = Helper::getCandidateCategory($arrParams['CANDIDATE_TOTAL_PERCENTAGE']);



        Helper::prent($arrParams);


//        $arrReviewFields = [
//            'NAME' => $request->NAME,
//            'REVIEW' => $request->REVIEW,
//            'PHOTO' => $linkToImage,
//        ];

        $newCandidateResponse = Responses::create($arrParams);
        //Helper::prent($newCandidateResponse);
    }

    /**Get all company vacancies
     *
     * @param $companyName
     */
    public function getVacancies($companyName)
    {
        $companyVacancies = Vacancies::where('COMPANY_NAME', $companyName)
            ->get()
            ->toArray();

        Helper::prent($companyVacancies);

    }


}
