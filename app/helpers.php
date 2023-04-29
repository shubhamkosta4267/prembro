<?php

use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentInstallment;

function countCourseStudent($id){
    $total = Student::where('course_id', $id)->get();
    return count($total);
}

function countBatchStudent($id){
    $total = Student::where('batch_id', $id)->get();
    return count($total);
}

function courseInfo($id){
    $course = Course::where('id', $id)->select('name', 'image')->first();
    return $course ? $course : false;
}

function batchInfo($id){
    $batch = Batch::where('id', $id)->select('name')->first();
    return $batch ? $batch : false;
}

function getHeaderNotification(){
    $notification = StudentInstallment::orderBy('student_installments.created_at', 'desc')
    ->join('students', 'students.id', '=', 'student_installments.student_id')
    ->select('student_installments.*', 'students.name', 'students.image')
    ->limit(5)->get();
    return count($notification) > 0 ? $notification : false;
}

?>