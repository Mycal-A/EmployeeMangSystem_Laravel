<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    protected $guarded=[];

    public function isAdmin()
    {
        return $this->email === 'mycal@gmail.com';
    }

    public function families(){

        return $this->hasMany(EmpFamily::class);
    }
    public function educations(){

        return $this->hasMany(EmpEducation::class);
    }
    public function experiences(){

        return $this->hasMany(EmpExperience::class);
    }

    public function deleteWithFamilies()
    {
        $this->families()->delete();
        $this->delete();
    }
    public function deleteWithEducations()
    {
        $this->educations()->delete();
        $this->delete();
    }

    public function deleteWithExperiences()
    {
        $this->experiences()->delete();
        $this->delete();
    }

    public function toggleAccess()
    {
        $this->update(['access' => !$this->access]);
    }
}
