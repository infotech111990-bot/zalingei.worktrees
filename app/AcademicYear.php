<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class AcademicYear extends Model
{
    protected $guarded = [];
    protected $casts = ['is_current' => 'boolean'];
    public function semesters() { return $this->hasMany(Semester::class); }
}
