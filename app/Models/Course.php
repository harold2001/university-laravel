<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "link","career_id", "semester_id"];

    public function semester()
    {
        return $this->belongsTo(Semester::class, "semester_id", "id");
    }

    public function career()
    {
        return $this->belongsTo(Career::class, "career_id", "id");
    }
}
