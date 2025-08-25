<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonSearchDudok extends Model
{
    use HasFactory;

    protected $table = 'person_search_dudok';
    // protected $primaryKey = 'id';
    protected $primaryKey = 'registration_no';


    protected $fillable = [
        'REGISTRATION_NO',
        'COMPANY_NAME',
        'CLIENT_ID',
        'PERSON_NAME',
        'FATHERS_NAME',
        'NATIONAL_ID',
        'BIRTH_DATE',
        'PRESENT_ADDRESS',
        'PERMANENT_ADDRESS'
    ];


    protected $casts = [
        'BIRTH_DATE' => 'date'
    ];
}
