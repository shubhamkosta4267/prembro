<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $result['courses'] = Course::orderBy('id', 'desc')->with('batch')->paginate(5);
        return view('courses.courses-list')->with($result);
    }

    public function create(){
        return view('courses.add-courses');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'fee' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = '';
        if($request->has('image')){
            $imageName = time().'_'.$request->image->extension();
            $request->image->move(public_path('images/course'), $imageName);
            $image = $imageName;
        }

        if($image!=""){
            $course = Course::addCourse($request->all(),$image);
            if($course){
                return redirect()->route('courses_list')->withSuccess('Course added successfully!');
            }else{
                return redirect()->back()->withFail('Unable to Process try again!');
            }
        }else{
            return redirect()->back()->withFail('Unable to Process try again!');
        }
    }

    public function show(Course $course, Request $request){
        $result['course'] = Course::where('id', $request->id)->with('batch')->first();
        return view('courses.course')->with($result);
    }

    public function edit(Course $course, Request $request){
        $result['course'] = Course::where('id', $request->id)->first();
        return view('courses.edit-course')->with($result);
    }

    public function update(Request $request, Course $course){
        $request->validate([
            'name' => 'required|max:255',
            'fee' => 'required'
        ]);

        $image = '';
        if($request->has('image') == true){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageName = time().'_'.$request->image->extension();
            $request->image->move(public_path('images/course'), $imageName);
            $image = $imageName;
        }

        if($image!=""){
            $updated = Course::where('id', $request->id)->update([
                'name' => $request->name,
                'fees' => (isset($request->fee) ? $request->fee : 0),
                'image' => $image
            ]);
            if($updated){
                return redirect()->route('courses_list')->withSuccess('Course added successfully!');
            }else{
                return redirect()->back()->withFail('Unable to Process try again!');
            }
        }else{
            $updated = Course::where('id', $request->id)->update([
                'name' => $request->name,
                'fees' => (isset($request->fee) ? $request->fee : 0),
            ]);
            if($updated){
                return redirect()->route('courses_list')->withSuccess('Course updated successfully!');
            }else{
                return redirect()->back()->withFail('Unable to Process try again!');
            }
        }
    }

    public function destroy(Course $course, Request $request){
        $course = Course::where('id', $request->id)->first();
        if($course){
            Batch::where('course_id', $request->id)->delete();
            $deleted = Course::where('id', $request->id)->delete();
            if($deleted){
                return response()->json(['sts' => true, 'msg' => 'Course deleted successfully!']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'Unable to process, try again!']);
            }
        }else{
            return response()->json(['sts' => false, 'msg' => 'Course does not exist!']);  
        }
    }

    public function addBatch(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'name' => 'required|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
        }else{
            $batch = Batch::saveBatch($request->all());
            if($batch){
                return response()->json(['sts' => true, 'msg' => 'Batch added successfully!']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'Unable to process, please try again!']);
            }
        }
    }

    public function editBatch(Request $request){
        $batch = Batch::where('id', $request->id)->first();
        if($batch){
            return response()->json(['sts' => true, 'data' => $batch]);
        }else{
            return response()->json(['sts' => false, 'msg' => 'batch does not exist']);
        }
    }
    
    public function updateBatch(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'name' => 'required|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['sts' => false, 'msg' => $validator->getMessageBag()->first()]);
        }else{
            $batch = Batch::updateBatch($request->all());
            if($batch){
                return response()->json(['sts' => true, 'msg' => 'Batch updated successfully']);
            }else{
                return response()->json(['sts' => false, 'msg' => 'Unable to process, Pleae try again!']);
            }
        }
    }

    public function deleteBatch(Request $request){
        $batch = Batch::where('id', $request->id)->first();
        if($batch){
            Batch::where('id', $request->id)->delete();
            return response()->json(['sts' => true, 'msg' => 'Batch updated successfully']);
        }else{
            return response()->json(['sts' => false, 'msg' => 'Unable to process, Pleae try again!']);
        }
    }
    
    public function courseBatch(Request $request){
        $batch = Batch::where('course_id', $request->id)->get();
        if(count($batch)> 0){
            return response()->json(['sts' => true, 'batch' => $batch]);
        }else{
            return response()->json(['sts' => false, 'msg' => 'No batch found in this course!']);
        }
    }

}
