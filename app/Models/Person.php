<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'person'; 

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'registration_no'; 

    // Allow mass assignment for these fields
    protected $fillable = [
        'registration_no',
        'company_name',
        'client_id',
        'person_name',
        'fathers_name',
        'national_id',
        'birth_date',
        'present_address',
        'permanent_address',
    ];
}
