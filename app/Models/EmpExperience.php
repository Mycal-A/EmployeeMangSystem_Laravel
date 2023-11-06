<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpExperience extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $primaryKey='id';

    public function employee(){

        return $this->belongsTo(Employee::class,'employee_id');
    }
}
