<?php
namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    protected function guard()
{
    return Auth::guard('api');
}

    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('active', 'username', 'password','id_role');
        $validator = Validator::make($data, [
            'active' => 'required|boolean',
            'username' => 'required|unique:users',
            'password' => 'required|string|min:6|max:50',
            'id_role' => 'required|integer'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
        	'active' => $request->active,
        	'id_role' => $request->id_role,
        	'username' => $request->username,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
 
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'username' => 'required',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        $email = request(['username']);
        $user = (User::whereIn('username', $email)->get());
        $idr =$user[0]->id_role;
        if($idr===1){$role='AdminStructure';}
        elseif($idr===2){$role='Coach';
        }elseif($idr===3){$role='AdminClient';}
	elseif($idr===4){$role='Partenaire';};
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day
          
        return response([
            'authToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'id'=> $user[0]->id,
            'username'=> $user[0]->username,
            'active'=> $user[0]->active,
            'role'=>$role
        ])->withCookie($cookie);
        /*
         $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'message' => $token
        ])->withCookie($cookie); */
    }
 
 public function logout()
    {
        $cookie = Cookie::forget('jwt');
                auth()->logout();
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
 public function me()
    {
        return response()->json(auth()->user());
    }
  
}
