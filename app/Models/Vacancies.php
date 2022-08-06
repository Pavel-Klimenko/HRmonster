<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    protected $guarded = [];
    protected $table = 'vacancies';
    protected $primaryKey = 'ID';
}
