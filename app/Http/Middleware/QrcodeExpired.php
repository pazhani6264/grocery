<?php 
	namespace App\Http\Middleware;
	use DB;
	use Closure;
	use Auth;
	use Session;

	class QrcodeExpired
	{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

    	if(!empty(session('table_qrcode'))){
            return $next($request);
        }else{
            return redirect('qrcodeexpired');
        }       
    }
}

?>