<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Notifications\SignupActivate;
use Avatar;
use QrCode;
use Storage;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'birthdate' => 'required|date',
            'mobile' => 'required|numeric|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        //$qrcode = QrCode::size(500)->format('png')->generate('localhost/league_stadiums', public_path('images/users/qrcodes/'.$request->get('user_name').'.png'));

        $user = User::create($request->except('role', 'password_confirmation') + ['activation_token' => str_random(60) , 'qrcode' => '1']);
       
        if($request->file('image') == null){
            $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
            Storage::disk('user')->put($user->id.'.png', (string) $avatar);
            $user->avatar = $user->id.'.png';

        }else{
            $photo = $request->file('image')->getClientOriginalName();
            $destination = base_path().'/public/images/users';
            $request->file('image')->move($destination, $photo);
            $user->avatar = asset('images/users/'.$photo);
        }        
    
        User::whereId($user->id)->update(['avatar' => $user->avatar]);
        

        $role = Role::findOrFail($request->get('role'));
        $user->attachRole($role);

        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $token = $user->activation_token;
        $user->activation_token = '';
        $user->save();
        return redirect('/login?token='.$token);
    }
  
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => $user,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }



}