<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsOrders implements FromCollection,WithHeadings
{
    protected $orders;

    public function __construct($orders = null)
    {
        $this->orders = $orders;
    }

    public function headings():array{
        return[
            'Order ID',
            'Order Date',
            'Items Count',
            'Price',
            'Status'
        ];
    } 

    public function collection()
     {
         //return orders::all();
         return collect($this->orders);
     }

}