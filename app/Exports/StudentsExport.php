<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::get(['student_id', 'batch_id', 'program_id', 'admission_date', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'present_province', 'present_district', 'present_village', 'present_address', 'permanent_province', 'permanent_district', 'permanent_village', 'permanent_address', 'gender', 'dob', 'phone', 'marital_status', 'blood_group', 'national_id', 'passport_no', 'school_name', 'school_exam_id', 'school_graduation_year', 'school_graduation_point', 'collage_name', 'collage_exam_id', 'collage_graduation_year', 'collage_graduation_point', 'login', 'status', 'is_transfer']);
    }


    public function headings(): array
    {
        return ['student_id', 'batch_id', 'program_id', 'admission_date', 'first_name', 'last_name', 'father_name', 'mother_name', 'email', 'present_province', 'present_district', 'present_village', 'present_address', 'permanent_province', 'permanent_district', 'permanent_village', 'permanent_address', 'gender', 'dob', 'phone', 'marital_status', 'blood_group', 'national_id', 'passport_no', 'school_name', 'school_exam_id', 'school_graduation_year', 'school_graduation_point', 'collage_name', 'collage_exam_id', 'collage_graduation_year', 'collage_graduation_point', 'login', 'status', 'is_transfer'];
    }
}
