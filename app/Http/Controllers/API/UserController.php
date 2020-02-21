<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;



class UserController extends Controller
{
	public $successStatus = 200;

	public function nologin(){
		return response()->json(['error'=>true , 'message'=>'Unauthorised GET method'], 401); 
	}
    public function login(){ 
		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            
			$user = Auth::user(); 
			//dd($user);
            $success['token'] =  $user->createToken('Bit68')-> accessToken; 
			//dd("succes");
			$user->api_token = $success['token'];
			$user->save();
            return response()->json(['error'=>false , 'message'=>'Login success','data' => $success], $this-> successStatus); 
        } 
        else{ 
			
            return response()->json(['error'=>true , 'message'=>'Unauthorised','data' =>[]], 401); 
        } 
    }
	public function register(Request $request){ 
		$validator = Validator::make($request->all(), [ 
			  
					'name' => 'required|max:255',
					'email'=>'required|unique:users|max:255',	
					'password'=>'required',						
					 
				]);
				//dd($request->type);
				if ($validator->fails()) { 
							return response()->json(['error'=>true , 'message'=>"Please fill all fields",'data' =>[]], 200);            
						}
				$user= new User();
				$user->name=$request->name;
				$user->email=$request->email;
				$user->password=bcrypt($request->password);
				$user->save();
				return response()->json(['error'=>false , 'message'=>'Regist success','data' => $user], $this-> successStatus); 

    }
	public function getweather(Request $request){
		$validator = Validator::make($request->all(), [ 
			  
					'city' => 'required|max:255',
					 
				]);
				//dd($request->type);
				if ($validator->fails()) { 
							return response()->json(['error'=>true , 'message'=>"enter City name  as city",'data' =>[]], 200);            
						}
				$url="api.openweathermap.org/data/2.5/weather?q=".$request->city."&appid=b2be7f6bf4261e1e8bbf999cb315535d";
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				$res = curl_exec($ch); 
				curl_close($ch);
				$res = json_decode($res);
				
				return response()->json(['error'=>false , 'message'=>'success','data' => $res], $this-> successStatus); 
	}

}
