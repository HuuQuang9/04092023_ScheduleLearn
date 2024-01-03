<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialized extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name'          ,
        'delete'        ,
    ];

    protected $modelClass = Specialized::class;

    protected $table = 'specializeds';


    public function classrooms(){
        return $this->hasMany(Classroom::class)->where('delete', false);
    }
}
