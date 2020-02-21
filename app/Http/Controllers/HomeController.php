<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	public function getweather(Request $request){
		
		$url="api.openweathermap.org/data/2.5/weather?q=".$request->city."&appid=b2be7f6bf4261e1e8bbf999cb315535d";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				$res = curl_exec($ch); 
				curl_close($ch);
				$res = json_decode($res);
				//dd($res);
		
		$view = view("item",compact("res"))->render();
		return response()->json(['html'=>$view]);
		
	}
}
