<?php
namespace App\Models\Core;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Ordersproducts extends Model
{
	use Sortable;
	protected $table = 'orders_products';
	public $sortable =['products_name'];
}
?>