<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class PersonSearchExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        return [
            'Registration No', 'Company Name', 'Client ID',
            'Person Name', "Father's Name", 'National ID',
            'Birth Date', 'Present Address', 'Permanent Address'
        ];
    }
}
