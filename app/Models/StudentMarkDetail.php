<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMarkDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'subject_id', 'term', 'mark'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['student', 'subject'];

    public function studentName()
    {
        return $this->hasOne(Student::class, 'id', 'student_id')->latest();
    }

    /**
     * Get course preview vide vimeo full URL
     *
     * @return string - Video URL
     */
    public function getStudentAttribute()
    {
        return $this->student_id ? ucwords(strtolower($this->studentName()->first()->name)) : '-';
    }

    public function subjectName()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id')->latest();
    }

    /**
     * Get course preview vide vimeo full URL
     *
     * @return string - Video URL
     */
    public function getSubjectAttribute()
    {
        return $this->student_id ? ucwords(strtolower($this->subjectName()->first()->subject_name)) : '-';
    }
}
