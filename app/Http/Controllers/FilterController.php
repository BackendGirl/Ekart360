<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Session;
use App\Models\Program;
use App\Models\Subject;
use App\Models\Section;
use Carbon\Carbon;
use DB;

class FilterController extends Controller
{
    public function filterBatch(Request $request)
    {
        $data=$request->all();

        $rows = Program::where('status', 1);
        $rows->with('batches')->whereHas('batches', function ($query) use ($data){
            $query->where('batch_id', $data['batch']);
        });
        $departments = $rows->orderBy('title', 'asc')->get();

        return response()->json($departments);
    }
    
    public function filterProgram(Request $request)
    {
        //
        $data=$request->all();

        $departments = Program::where('faculty_id', $data['faculty'])->where('status', 1)->orderBy('title', 'asc')->get();

        return response()->json($departments);
    }

    public function filterSession(Request $request)
    {
        //
        $data=$request->all();

        $rows = Session::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $sessions = $rows->orderBy('id', 'desc')->get();

        return response()->json($sessions);
    }

    public function filterSemester(Request $request)
    {
        //
        $data=$request->all();

        $rows = Semester::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $semesters = $rows->orderBy('id', 'asc')->get();

        return response()->json($semesters);
    }

    public function filterSection(Request $request)
    {
        //
        $data=$request->all();

        $rows = Section::where('status', 1);
        $rows->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($data){
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
        });
        $sections = $rows->orderBy('title', 'asc')->get();

        return response()->json($sections);
    }

    public function filterSubject(Request $request)
    {
        //
        $data=$request->all();

        $rows = Subject::where('status', 1);
        $rows->with('programs')->whereHas('programs', function ($query) use ($data){
            $query->where('program_id', $data['program']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterEnrollSubject(Request $request)
    {
        //
        $data=$request->all();

        $rows = Subject::where('status', 1);
        $rows->with('subjectEnrolls')->whereHas('subjectEnrolls', function ($query) use ($data){
            $query->where('program_id', $data['program']);
            $query->where('semester_id', $data['semester']);
            $query->where('section_id', $data['section']);
        });
        $subjects = $rows->orderBy('code', 'asc')->get();

        return response()->json($subjects);
    }

    public function filterStudentSubject(Request $request)
    {
        //
        $data=$request->all();

        $subjects = DB::table('subjects')->select('subjects.*')->join('student_enroll_subject', 'student_enroll_subject.subject_id', 'subjects.id')->join('student_enrolls', 'student_enrolls.id', 'student_enroll_subject.student_enroll_id')->where('student_enrolls.program_id', $data['program'])->where('student_enrolls.session_id', $data['session'])->where('student_enrolls.semester_id', $data['semester'])->where('student_enrolls.section_id', $data['section'])->where('student_enrolls.status', '1')->where('subjects.status', '1')->orderBy('subjects.code', 'asc')->get();

        return response()->json($subjects);
    }
}
