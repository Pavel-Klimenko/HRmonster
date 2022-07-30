<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\Responses;

use App\Services\Helper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createCandidateResponse(Request $request)
    {

        $arrParams = [
            'VACANCY_ID' => $request->VACANCY_ID, //передается с Фронт-енд

            //знание 5 навыков (определены HR)
            'IMPORTANT_SKILL_1' => $request->IMPORTANT_SKILL_1,
            'IMPORTANT_SKILL_2' => $request->IMPORTANT_SKILL_2,
            'IMPORTANT_SKILL_3' => $request->IMPORTANT_SKILL_3,
            'MINOR_SKILL_1' => $request->MINOR_SKILL_1,
            'MINOR_SKILL_2' => $request->MINOR_SKILL_2,

            //уровни владения навыком 1 навыком (выбран HR) варианты:
            // NOTHING, THEORETICAL, USED_ONCE, USED_OFTEN, EXPERT
            'NEED_PROFESSIONALISM_SKILL' => $request->NEED_PROFESSIONALISM_SKILL,

            //опыт с одним 1 навыком (выбран HR) варианты:
            //NO_EXPERIENCE, LESS_ONE_YEAR, ONE_THREE_YEARS, THREE_FIVE_YEARS, MORE_FIVE_YEARS
            'NEED_EXPERIENCE_SKILL' => $request->NEED_EXPERIENCE_SKILL,
            'EXPERIENCE_SKILL_COMMERCE' => $request->EXPERIENCE_SKILL_COMMERCE,

            //знание 6 доп. навыков (определены HR)
            'ADDITIONAL_SKILL_1' => $request->ADDITIONAL_SKILL_1,
            'ADDITIONAL_SKILL_2' => $request->ADDITIONAL_SKILL_2,
            'ADDITIONAL_SKILL_3' => $request->ADDITIONAL_SKILL_3,
            'ADDITIONAL_SUPER_SKILL' => $request->ADDITIONAL_SUPER_SKILL,
            'ADDITIONAL_TEST_SKILL_1' => $request->ADDITIONAL_TEST_SKILL_1,
            'ADDITIONAL_TEST_SKILL_2' => $request->ADDITIONAL_TEST_SKILL_2,

            'NAME' => $request->NAME,
            'SURNAME' => $request->SURNAME,
            'EMAIL' => $request->EMAIL,
            //'CANDIDATE_CV' => Helper::saveCandidateCV("CANDIDATE_CV"),
            'COMMENT' => $request->COMMENT,   
        ];


/*        $arrParams['NAME'] = encrypt($arrParams['NAME']);
        $arrParams['SURNAME'] = encrypt($arrParams['SURNAME']);
        $arrParams['EMAIL'] = encrypt($arrParams['EMAIL']);


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


        $arrParams['NEED_PROFESSIONALISM_SKILL_%'] = Helper::getProfessionalismSkillPercentage($arrParams['NEED_PROFESSIONALISM_SKILL']);
        $arrParams['NEED_EXPERIENCE_SKILL_%'] = Helper::getExperienceSkillPercentage($arrParams['NEED_EXPERIENCE_SKILL']);


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


        $arrAllValuableSkills = [
            $arrParams['IMPORTANT_SKILLS_%'],
            $arrParams['NEED_PROFESSIONALISM_SKILL_%'],
            $arrParams['NEED_EXPERIENCE_SKILL_%'],
            $arrParams['ADDITIONAL_SKILLS_%']
        ];

        $arrParams['CANDIDATE_TOTAL_PERCENTAGE'] = array_sum($arrAllValuableSkills);
        $arrParams['CANDIDATE_CATEGORY'] = Helper::getCandidateCategory($arrParams['CANDIDATE_TOTAL_PERCENTAGE']);

        $finalMessageForCandidate = Helper::showFinalMessageForCandidate($arrParams['CANDIDATE_CATEGORY'], $arrParams['VACANCY_ID']);

        $newCandidateRespondId = Responses::create($arrParams)->ID;

        Helper::saveCandidateFile($newCandidateRespondId);*/

        $newCandidateRespondId = Responses::create($arrParams);

    }

    /**Creating company
     *
     * @param Request $request
     */
    public function CreateCompany(Request $request)
    {
        //это POST массив из формы
        $arrParams = [
            'COMPANY_NAME' => $request->COMPANY_NAME,
            'YOUTUBE_VIDEO' => $request->YOUTUBE_VIDEO,
            'COMPANY_DESCRIPTION' => $request->COMPANY_DESCRIPTION,
        ];

        $company = Company::create($arrParams);

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
        //это POST массив из формы
        $arrParams = [
            'COMPANY_ID' => $request->COMPANY_ID,
            'COMPANY_NAME' => $request->COMPANY_NAME,
            'VACANCY_NAME' => $request->VACANCY_NAME,

            'IMPORTANT_SKILL_1' => $request->IMPORTANT_SKILL_1,
            'IMPORTANT_SKILL_2' => $request->IMPORTANT_SKILL_2,
            'IMPORTANT_SKILL_3' => $request->IMPORTANT_SKILL_3,
            'MINOR_SKILL_1' => $request->MINOR_SKILL_1,
            'MINOR_SKILL_2' => $request->MINOR_SKILL_2,

            'NEED_PROFESSIONALISM_SKILL' => $request->NEED_PROFESSIONALISM_SKILL,
            'NEED_EXPERIENCE_SKILL' => $request->NEED_EXPERIENCE_SKILL,

            'ADDITIONAL_SKILL_1' => $request->ADDITIONAL_SKILL_1,
            'ADDITIONAL_SKILL_2' => $request->ADDITIONAL_SKILL_2,
            'ADDITIONAL_SKILL_3' => $request->ADDITIONAL_SKILL_3,
            'ADDITIONAL_SUPER_SKILL' => $request->ADDITIONAL_SUPER_SKILL,
            'ADDITIONAL_TEST_SKILL_1' => $request->ADDITIONAL_TEST_SKILL_1,
            'ADDITIONAL_TEST_SKILL_2' => $request->ADDITIONAL_TEST_SKILL_2,


            'BEST_CANDIDATES_RESPONSE' => $request->ADDITIONAL_TEST_SKILL_2,

            'RESERVE_CANDIDATES_RESPONSE' => $request->RESERVE_CANDIDATES_RESPONSE,

            'WEAK_CANDIDATES_RESPONSE' => $request->WEAK_CANDIDATES_RESPONSE,
        ];

        Vacancies::create($arrParams);
    }


    /**Candidate is responding to a vacancy
     *
     * @param Request $request
     */
    public function respondToVacancy(Request $request)
    {

        $vacancyId = $request->VACANCY_ID;
        $vacancy = Vacancies::find($vacancyId)->toJson();

        //это POST массив из формы, которую заполняет кандидат

        $arrParams = [
            'VACANCY_ID' => $vacancyId, //передается с Фронт-енд

            //знание 5 навыков (определены HR)
            'IMPORTANT_SKILL_1' => $request->IMPORTANT_SKILL_1,
            'IMPORTANT_SKILL_2' => $request->IMPORTANT_SKILL_2,
            'IMPORTANT_SKILL_3' => $request->IMPORTANT_SKILL_3,
            'MINOR_SKILL_1' => $request->MINOR_SKILL_1,
            'MINOR_SKILL_2' => $request->MINOR_SKILL_2,

            //уровни владения навыком 1 навыком (выбран HR) варианты:
            // NOTHING, THEORETICAL, USED_ONCE, USED_OFTEN, EXPERT
            'NEED_PROFESSIONALISM_SKILL' => $request->NEED_PROFESSIONALISM_SKILL,

            //опыт с одним 1 навыком (выбран HR) варианты:
            //NO_EXPERIENCE, LESS_ONE_YEAR, ONE_THREE_YEARS, THREE_FIVE_YEARS, MORE_FIVE_YEARS
            'NEED_EXPERIENCE_SKILL' => $request->NEED_EXPERIENCE_SKILL,
            'EXPERIENCE_SKILL_COMMERCE' => $request->EXPERIENCE_SKILL_COMMERCE,

            //знание 6 доп. навыков (определены HR)
            'ADDITIONAL_SKILL_1' => $request->ADDITIONAL_SKILL_1,
            'ADDITIONAL_SKILL_2' => $request->ADDITIONAL_SKILL_2,
            'ADDITIONAL_SKILL_3' => $request->ADDITIONAL_SKILL_3,
            'ADDITIONAL_SUPER_SKILL' => $request->ADDITIONAL_SUPER_SKILL,
            'ADDITIONAL_TEST_SKILL_1' => $request->ADDITIONAL_TEST_SKILL_1,
            'ADDITIONAL_TEST_SKILL_2' => $request->ADDITIONAL_TEST_SKILL_2,

            'NAME' => $request->NAME,
            'SURNAME' => $request->SURNAME,
            'EMAIL' => $request->EMAIL,
            //'CANDIDATE_CV' => Helper::saveCandidateCV("CANDIDATE_CV"),
            'CANDIDATE_CV' => $request->CANDIDATE_CV,
            'COMMENT' => $request->COMMENT,
        ];


        //Расчет процентов и определение кандидата в категорию
/*        $arrImportantSkills = [
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


        $arrParams['NEED_PROFESSIONALISM_SKILL_%'] = Helper::getProfessionalismSkillPercentage($arrParams['NEED_PROFESSIONALISM_SKILL']);
        $arrParams['NEED_EXPERIENCE_SKILL_%'] = Helper::getExperienceSkillPercentage($arrParams['NEED_EXPERIENCE_SKILL']);


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

        $arrAllValuableSkills = [
            $arrParams['IMPORTANT_SKILLS_%'],
            $arrParams['NEED_PROFESSIONALISM_SKILL_%'],
            $arrParams['NEED_EXPERIENCE_SKILL_%'],
            $arrParams['ADDITIONAL_SKILLS_%']
        ];

        $arrParams['CANDIDATE_TOTAL_PERCENTAGE'] = array_sum($arrAllValuableSkills);
        $arrParams['CANDIDATE_CATEGORY'] = Helper::getCandidateCategory($arrParams['CANDIDATE_TOTAL_PERCENTAGE']);

        $finalMessageForCandidate = Helper::showFinalMessageForCandidate($arrParams['CANDIDATE_CATEGORY'], $vacancyId);
        $newCandidateResponse = Responses::create($arrParams);*/

        $newCandidateResponse = Responses::create($arrParams);



    }


    /**Get all company vacancies
     *
     * @param $companyId
     */
    public function showCompanies()
    {
        $companies = Company::all()->toArray();

        return $companies;
    }


    /**Get all company vacancies
     *
     * @param $companyId
     */
    public function showCompanyVacancies($companyId)
    {
        $companyVacancies = Vacancies::where('COMPANY_ID', $companyId)
            ->get()
            ->toArray();

        return $companyVacancies;
    }

    /**Save candidate to the file
     *
     * @param $vacancyId
     */
    public function saveCandidateFile($candidateRespondId)
    {
        $candidateRespondObject = Responses::find($candidateRespondId)->toArray();
        $vacancyObject = Vacancies::find($candidateRespondObject['VACANCY_ID'])->toArray();

        //Helper::prent($vacancy);

        $fileName = Helper::generateFileName($candidateRespondObject);

        Helper::prent($fileName);
        $vacancyPath = "/storage/candidates_categories/vacancy_".$candidateRespondObject['VACANCY_ID'];
        $categoryPath = "/storage/candidates_categories/vacancy_".$candidateRespondObject['VACANCY_ID']."/".$candidateRespondObject['CANDIDATE_CATEGORY']."/";
        //Helper::createStorageFolder($vacancyPath);

        //Helper::prent($vacancyPath);
        //Helper::prent($categoryPath);
        $fileName = $_SERVER['DOCUMENT_ROOT'].$categoryPath.$fileName;

        Helper::createStorageFolder($vacancyPath);
        Helper::createStorageFolder($categoryPath);


        //Helper::prent($fileName);

        if (!file_exists($fileName)) {
            Helper::generateUserFile($fileName, $vacancyObject, $candidateRespondObject);
        }

    }






}
