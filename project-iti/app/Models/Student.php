<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Auth\Auth;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'student_id','password'];

    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class);
    }
}

