<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'name',
        'from',
        'to',
    ];

    public static function saveBatch($data){
        $batch = Batch::create([
            'course_id' => (isset($data['course_id']) ? $data['course_id'] : ''),
            'name' => (isset($data['name']) ? $data['name'] : ''),
            'from' => (isset($data['start_time']) ? $data['start_time'] : ''),
            'to' => (isset($data['end_time']) ? $data['end_time'] : ''),
        ]);

        return $batch ? true : false;
    }
    
    public static function updateBatch($data){
        $batch = Batch::where('id', $data['id'])->update([
            'course_id' => (isset($data['course_id']) ? $data['course_id'] : ''),
            'name' => (isset($data['name']) ? $data['name'] : ''),
            'from' => (isset($data['start_time']) ? $data['start_time'] : ''),
            'to' => (isset($data['end_time']) ? $data['end_time'] : ''),
        ]);

        return $batch ? true : false;
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

}
