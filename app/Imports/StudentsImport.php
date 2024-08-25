<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.student_id' => 'required',
            '*.batch_id' => 'required|integer',
            '*.program_id' => 'required|integer',
            '*.admission_date' => 'required|date',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.email' => 'required|email',
            '*.phone' => 'required',
            '*.present_province' => 'required|integer',
            '*.present_district' => 'required|integer',
            '*.permanent_province' => 'required|integer',
            '*.permanent_district' => 'required|integer',
            '*.gender' => 'required|integer',
            '*.dob' => 'required|date',
            '*.marital_status' => 'nullable|integer',
            '*.blood_group' => 'nullable|integer',
            '*.school_exam_id' => 'nullable|numeric',
            '*.school_graduation_year' => 'nullable|numeric',
            '*.collage_exam_id' => 'nullable|numeric',
            '*.collage_graduation_year' => 'nullable|numeric',
            '*.login' => 'required|integer',
            '*.status' => 'required|integer',
            '*.is_transfer' => 'required|integer',
        ])->validate();
  

        foreach ($rows as $row) {
            Student::updateOrCreate(
                [
                'student_id'     => $row['student_id'],
                'email'    => $row['email'],
                ],[
                'student_id'     => $row['student_id'],
                'batch_id'     => $row['batch_id'],
                'program_id'     => $row['program_id'],
                'admission_date'     => $row['admission_date'],
                'first_name'     => $row['first_name'],
                'last_name'     => $row['last_name'],
                'father_name'     => $row['father_name'],
                'mother_name'     => $row['mother_name'],
                'email'     => $row['email'],
                'password'      => Hash::make($row['student_id']),
                'password_text'     => Crypt::encryptString($row['student_id']),
                'phone'     => $row['phone'],
                'present_province'     => $row['present_province'],
                'present_district'     => $row['present_district'],
                'present_village'     => $row['present_village'],
                'present_address'     => $row['present_address'],
                'permanent_province'     => $row['permanent_province'],
                'permanent_district'     => $row['permanent_district'],
                'permanent_village'     => $row['permanent_village'],
                'permanent_address'     => $row['permanent_address'],
                'gender'     => $row['gender'],
                'dob'     => $row['dob'],
                'marital_status'     => $row['marital_status'],
                'blood_group'     => $row['blood_group'],
                'national_id'     => $row['national_id'],
                'passport_no'     => $row['passport_no'],
                'school_name'     => $row['school_name'],
                'school_exam_id'     => $row['school_exam_id'],
                'school_graduation_year'     => $row['school_graduation_year'],
                'school_graduation_point'     => $row['school_graduation_point'],
                'collage_name'     => $row['collage_name'],
                'collage_exam_id'     => $row['collage_exam_id'],
                'collage_graduation_year'     => $row['collage_graduation_year'],
                'collage_graduation_point'     => $row['collage_graduation_point'],
                'login'     => $row['login'],
                'status'     => $row['status'],
                'is_transfer'     => $row['is_transfer'],
            ]);
        }
    }
}
