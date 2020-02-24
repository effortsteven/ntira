<?php


namespace System\views;

use Config\GlobalView;
use Config\View;
use Controllers\Application;
use Controllers\Career;
use Controllers\EducationInfo;
use Controllers\JobObjective;
use Controllers\QualityAndExperience;
use Controllers\Tender;

class TenderView extends GlobalView
{
    public function get($request, $response)
    {
        $tenders = Tender::all_tenders();
        $careers = Career::all_careers();
        $career_count = Career::career_count();
        $tender_count = Tender::tender_count();
        $objectives = JobObjective::all();
        $quality_and_experiences = QualityAndExperience::all_quality_experience();
        return View::render("tenders_careers.html.twig", ["tenders" => $tenders, "tender_count" => $tender_count, "careers" => $careers, "career_count" => $career_count, "objectives" => $objectives, "quality_and_experiences" => $quality_and_experiences]);
    }

    public function post($request, $response)
    {
        try {
            $career_id = $_POST['career_id'];
            $full_name = $_POST['full_name'];
            $dob = date("Y-m-d", strtotime($_POST['dob']));
            $phone = $_POST['phone'];
            $postal_address = $_POST['postal_address'];
            $place_of_birth = $_POST['place_of_birth'];
            $nationality = $_POST['nationality'];
            $marital_status = $_POST['marital_status'];
            $others = $_POST['others'];

            if (count(Application::personal_application($career_id, $full_name)) > 0) {
                $info = [
                    "status" => false,
                    "message" => "Already Submited"
                ];
            } else {
                Application::create_application($career_id, $full_name, $dob, $postal_address, $place_of_birth, $nationality, $marital_status, $phone, $others);
                $applicant = Application::personal_application($career_id, $full_name)[0];
                foreach (json_decode($_POST['university_list'], true) as $data) {
                    EducationInfo::create_education_info($applicant['id'], 2, $data['university'], $data['university_finish_year'], $data['univesity_course'], $data['university_pass']);
                }

                foreach (json_decode($_POST['school_list'], true) as $data) {
                    EducationInfo::create_education_info($applicant['id'], 1, $data['name_of_school'], $data['finish_school_year'], $data['school_exam'], $data['school_grade']);
                }

                $info = [
                    "status" => true,
                    "message" => "Successfuly Submited"
                ];
            }
        } catch (\Exception $e) {
            $info = [
                "status" => false,
                "message" => "Failed To Register Application"
            ];
        }
        $send = $request->param("format", "json");
        $response->$send($info);
    }
}