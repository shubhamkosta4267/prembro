<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'batch_id',
        'name',
        'email',
        'image',
        'date_of_birth',
        'father_name',
        'phone',
        'address',
        'demo',
        'fees',
        'status',
        'total_fees',
    ];

    public static function addStudents($data, $image){
        $student = [
            'course_id' => (isset($data['course']) ? $data['course'] : ''),
            'batch_id' => (isset($data['batch']) ? $data['batch'] : ''),
            'name' => (isset($data['name']) ? $data['name'] : ''),
            'email' => (isset($data['email']) ? $data['email'] : ''),
            'image' => (isset($image) ? $image : ''),
            'date_of_birth' => (isset($data['date_of_birth']) ? $data['date_of_birth'] : ''),
            'father_name' => (isset($data['father_name']) ? $data['father_name'] : ''),
            'phone' => (isset($data['phone']) ? $data['phone'] : ''),
            'address' => (isset($data['address']) ? $data['address'] : ''),
            'demo' => (isset($data['demo_class']) ? $data['demo_class'] : ''),
            'fees' => (isset($data['fees']) ? $data['fees'] : 0),
            'status' => 0,
        ];
        $created = Student::create($student);
        return $created ? $created : false;
    }

    public static function updateStudent($data, $image){
        $student = [
            'name' => $data['name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'father_name' => $data['father_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'demo' => (isset($data['demo_class']) ? $data['demo_class'] : 0),
            'status' => ($data['demo_class']==2 ? 1 : 0),
        ];
        if($image!=""){
            $student = [
                'image' => (isset($image) ? $image : ''),
            ];
        }
        $updated = Student::where('id', $data['id'])->update($student);
        return $updated ? $updated : false;
    }
}
