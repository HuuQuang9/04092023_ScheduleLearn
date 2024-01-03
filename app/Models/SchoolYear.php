<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolYear extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name'          ,
        'delete'        ,
    ];

    protected $modelClass = SchoolYear::class;

    protected $table = 'school_years';

    public function classrooms(){
        return $this->hasMany(Classroom::class)->where('delete', false);
    }
}
