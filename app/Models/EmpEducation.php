<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpEducation extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey='education_id';

    public function employee(){

        return $this->belongsTo(Employee::class,'employee_id');
    }
}
