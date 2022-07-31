<?php

namespace App\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'gender', 'reporting_tchr_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['reporting_teacher'];

    /**
     * The relationship with  teachers table to get detail.
     */
    public function reportingTeacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'reporting_tchr_id')->latest();
    }

    /**
     * Get course preview vide vimeo full URL
     *
     * @return string - Video URL
     */
    public function getReportingTeacherAttribute()
    {
        return $this->reporting_tchr_id ? ucwords(strtolower($this->reportingTeacher()->first()->name)) : '-';
    }

}
