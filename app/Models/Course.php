<?php

namespace App\Models;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'fees'];

    public static function addCourse($data, $image){
        $course = Course::create([
            'name'=> (isset($data['name']) ? $data['name'] : ''),
            'fees'=> (isset($data['fee']) ? $data['fee'] : 0),
            'image'=> (isset($image) ? $image : ''),
        ]);

        return $course ? true : false;
    }

    public function batch(){
        return $this->hasMany(Batch::class, 'course_id');
    }
}
