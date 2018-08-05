<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $input = $request->all();
        $http = new Client;
        try {
            $response = $http->post('http://localhost/lumen/public/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '1',
                    'client_secret' => 'lZlFLx8hAy3aQcy70lqcQjVhIcMvCabH7VTve1ll',
                    'username' => $input['email'],
                    'password' => $input['password'],
                    'scope' => '',
                ],
            ]);
            $status = $response->getStatusCode();
            return $response->getBody();//json_decode((string) $response->getBody(), true);
            
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // This is will catch all connection timeouts
            return $e->getResponse();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // This will catch all 400 level errors.
            return $e->getResponse();
        }
        
        
    
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            //'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|unique:users,mobile_no',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()]);            
        }


        $input = $request->all();
        
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 'user';
        $user = User::create($input);
        //dd($input, $user);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['role'] =  $user->role;


        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function allUsers()
    {
        $user = User::all();
        return response()->json(['data' => $user], $this->successStatus);
    }

    public function isAuthenticate(Request $request)
    {
        //dd($request->headers);
        //dd($request);
    }

    
}
