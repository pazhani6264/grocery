<?php
namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
	public function get_wallet(){
		$wallet = DB::table('wallet')->orderBy('id', 'DESC')
            ->whereIn('status', [1, 2])->paginate(20);
        return $wallet;
	}

	public function get_wallet_new(){
		$wallet = DB::table('wallet')->join('users', 'users.id' ,'=', 'wallet.user_id')->orderBy('wallet.id', 'DESC')->whereIn('wallet.status', [1, 2])->paginate(20);
        return $wallet;
	}

	public function get_banktransfer(){
		$wallet = DB::table('wallet')->orderBy('id', 'DESC')
			 //->where('payment_method', '=', 'banktransfer')
            ->whereIn('status', [4])->get();
        return $wallet;
	}

	public function get_banktransfer_new(){
		$wallet = DB::table('wallet')->select('wallet.*','users.first_name','users.last_name')->join('users', 'users.id' ,'=', 'wallet.user_id')->orderBy('wallet.id', 'DESC')->whereIn('wallet.status', [4])->get();
        return $wallet;
	}

	public function get_banktransfer_image($id){
		$wallet = DB::table('wallet')
			 ->where('id', '=', $id)
            ->first();
        return $wallet;
	}
}
?>