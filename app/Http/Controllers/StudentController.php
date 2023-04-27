<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use Illuminate\Validation\Rule;
use App\Models\StudentInstallment;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $result['students'] = Student::orderBy('students.id', 'desc')
        ->join('courses', 'courses.id','=','students.course_id')
        ->join('batches', 'batches.id', '=', 'students.batch_id')
        ->select('students.*', 'courses.name as course_name', 'batches.name as batch_name')
        ->paginate(5);
        return view('students.students-list')->with($result);
    }

    public function create(){
        $result['courses'] = Course::orderBy('id', 'desc')->get();
        return view('students.add-students')->with($result);   
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'email' => 'required|unique:students|max:255',
            'phone' => 'required|unique:students|max:10',
            'course' => 'required',
            'batch' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/students'), $filename);
            $request->image = $filename;
        }

        $student = Student::addStudents($request->all(), $request->image);
        if($student){
            return redirect()->route('students_list')->withSuccess('Student added successfully!');
        }else{
            return redirect()->back()->withFail('Unable to Process try again!');
        }
    }

    public function show(Student $student, Request $request){
        $result['installments'] = StudentInstallment::where('student_id', $request->id)->get();
        $result['courses_list'] = Course::orderBy('id', 'desc')->get();
        $result['courses'] = StudentCourse::orderBy('id', 'desc')->where('student_id', $request->id)->get();
        $result['student'] = Student::where('id', $request->id)->first();
        return view('students.view-student')->with($result);
    }

    public function edit(Student $student, Request $request){
        $result['student'] = Student::where('id', $request->id)->first();
        $result['courses'] = Course::orderBy('id', 'desc')->get();
        return view('students.edit-student')->with($result);
    }

    public function update(Request $request, Student $student){
        $request->validate([
            'name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'email' => ['required','max:255',
                        Rule::unique('students')->ignore($request->id),
                    ],
            'phone' => ['required','max:10',
                        Rule::unique('students')->ignore($request->id)
                    ],
            'address' => 'required',
            'date_of_birth' => 'required',
        ]);

        if ($request->hasFile('image') != "") {
            $request->validate(['image' => 'required|mimes:jpeg,png,jpg']);
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/students'), $filename);
            $request->image = $filename;
        }

        $student = Student::updateStudent($request->all(), $request->image);
        if($student){
            return redirect()->route('students_list')->withSuccess('Student updated successfully!');
        }else{
            return redirect()->back()->withFail('Unable to Process try again!');
        }
    }

    public function destroy(Student $student){
        //
    }

    public function updatePayment(Request $request){
        $validator = Validator::make($request->all(), [
            'fees' => 'required',
            'total_fees' => 'required',
            'payment_status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
        }else{
            $student = Student::where('id', $request->student_id)->first();
            $updated = Student::where('id', $request->student_id)->update([
                'fees' => $request->fees + $student->fees,
                'total_fees' => $request->total_fees,
                'payment_status' => $request->payment_status
            ]);
            if($updated){
                return response()->json(['sts' => true, 'msg' => 'Student information updated successfully !']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'Unable to process, please try again!']);
            }   
        }        
    }

    public function makeInstallment(Request $request){
        $validator = Validator::make($request->all(), [
            'select_installment' => 'required',
            'permonth_instalment' => 'required',
            'installment_date' => 'required',
            'payment_mode' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
        }

        if($request->select_installment == 2){
            $validator = Validator::make($request->all(), [
                'second_installment_date' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
            }
        }

        if ($request->hasFile('image') != "") {
            $request->validate(['image' => 'required|mimes:jpeg,png,jpg']);
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/students/installment/'), $filename);
            $request->image = $filename;
        }

        $payment = [];
        $payment[] = $request->installment_date;
        if($request->second_installment_date){
            $payment[] = $request->second_installment_date;
        }

        for($i = 0; $i < $request->select_installment; $i++){
            StudentInstallment::create([
                'student_id' => $request->student_id,
                'installment_date' => $payment[$i],
                'payment' => $request->permonth_instalment,
                'screenshot' => $request->image,
                'remark' => $request->installment_remark,
                'status' => 0,
            ]);
        }

        return response()->json(['sts' => true, 'msg' => 'Installment added successfully !']);
    }  
    
    public function updateInstallment(Request $request){
        $installment = StudentInstallment::where(['id' => $request->id, 'status' => 0])->first();
        if($installment){
            $updatedInstallment = StudentInstallment::where('id', $request->id)->update(['status' => 1]);
            if($updatedInstallment){
                $student = Student::where('id', $installment->student_id)->first();
                $updatedstudent = Student::where('id', $student->id)->update([
                    'fees' => $student->fees + (int)$installment->payment
                ]);
                
                if($updatedstudent->fees == $updatedstudent->total_fees){
                    Student::where('id', $installment->student_id)->update([
                        'payment_status' => 1
                    ]);
                }
                return response()->json(['sts' => true, 'msg' => 'Installment paid successfully!']);
            }
        }else{
            $installment = StudentInstallment::where(['id' => $request->id, 'status' => 1])->first();
            if($installment){
                return response()->json(['sts' => true, 'msg' => 'This installment already paid!']);
            }else{
                return response()->json(['sts' => true, 'msg' => 'This installment does not exist!']);
            }
        }
    }

    public function assignCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'course' => 'required',
            'batch' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
        }else{
            $course = StudentCourse::create([
                'student_id' => $request->student_id,
                'course_id' => $request->course,
                'batch_id' => $request->batch,
                'status' => 0,
            ]);

            if($course){
                Student::where('id', $request->student_id)->update([
                    'course_id' => $request->course,
                    'batch_id' => $request->batch,
                ]);
                return response()->json(['sts' => true, 'msg' => 'Course assigned successfully!']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'Unable to process, Try again!']);
            }
        }
    }

    public function studentCourseUpdate(Request $request){
        $course = StudentCourse::where(['id' => $request->id, 'status' => 0])->first();
        $updatedCourse = StudentCourse::where(['id' => $request->id, 'status' => 1])->first();
        if($course){
            StudentCourse::where(['id' => $course->id])->update([
                'status' => 1
            ]);
            Student::where('id', $course->student_id)->update([
                'course_id' => NULL,
                'batch_id' => NULL,
            ]);
            return response()->json(['sts' => true, 'msg' => 'Course status updated successfully!']);
        }else{
            if($updatedCourse){
                return response()->json(['sts' => false, 'msg' => 'This course already updated!']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'This course does not exists!']);
            }
        }
    }
}
