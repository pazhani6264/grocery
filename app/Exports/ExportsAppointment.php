<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsAppointment implements FromCollection,WithHeadings
{
    protected $appointment;

    public function __construct($appointment = null)
    {
        $this->appointment = $appointment;
    }

    public function headings():array{
        return[
            'Order ID',
            'Order Date',
            'Price',
            'Status'
        ];
    } 

    public function collection()
     {
         //return orders::all();
         return collect($this->appointment);
     }

}