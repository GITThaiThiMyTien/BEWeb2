<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class search_company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $per_page = $request->input('per_page');

        //is null
        if (empty($per_page)) {
            $per_page = 10;
        }

        //is string
        if (!is_numeric($per_page)) {
            return redirect('error');
        }

        //
        $numbers = array(10,30,50);
        if(!in_array($per_page,$numbers)){
            if($per_page<10){
                $per_page = 10;
            }
            else if($per_page<30){
                $per_page = 30;
            }
            else {
                $per_page = 50;
            }
        }

        if(isset($_GET['company_name'])){
            $name = $request->get('name');
        }

//        luu gia tri per_page de gui qua controller
        $request->merge([ 'per_page' => $per_page]);

        return $next($request);
    }
}
