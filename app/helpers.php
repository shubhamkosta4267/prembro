<?php

use App\Models\Course;
use App\Models\Student;
use App\Models\Batch;

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

?>