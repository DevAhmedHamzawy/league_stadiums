<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Admin;
use App\Role;
use App\TeamPlayer;
use QrCode;
use Carbon\Carbon;
use App\Notifications\Join;
use App\Notifications\Invitation;
use Image;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Collection;
use File;
class UsersController extends Controller 
{

  public function store(Request $request)
  { 
    // Verify User Automatically Due To Addition By The Admins
    $request->merge(['activation_token' => 0, 'email_verified_at' => Carbon::now()]);

    // Create User 
    $user = User::create($request->except('user_id','user_add','avatar_url','image','avatar','photo','role','password_confirmation'));
    
    //$qrcode = QrCode::size(500)->format('png')->generate('localhost/league_stadiums', asset('images/users/qrcodes/'.$request->get('user_name').'.png'));
    
    // Attach User Role
    $role = Role::findOrFail($request->get('role'));
    $user->attachRole($role);

    // Attach User Image
    if($request->get('photo'))
    {
      $image = $request->get('photo');
      $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
      Image::make($request->get('photo'))->save(public_path('images/users/').$name);
    }else{
      $name = 'avatar.png';
    }

    // Update User Image Then Return Response
    return $user->updateOrCreate(['id' => $user->id], ['avatar' => $name]) ? response()->json(["status" => true]) : response()->json(["status" => false]);
  }

  public function show($id)
  {

    $user = User::findOrFail($id);

    return view('profile' , compact('$user'));
    
  }

  public function update(Request $request)
  {
      // Get User Required To Update
      $user = User::findOrFail($request->get('user_id'));

      //$qrcode = QrCode::size(500)->format('png')->generate('localhost/league_stadiums', asset('images/users/qrcodes/'.$request->get('user_name').'.png'));
      
      // Attach User Role
      $role = Role::findOrFail($request->get('role'));
      $user->roles()->sync($role);

      // Attach User Image
      if($request->get('image'))
      {
        $image = $request->get('image');
        $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/users/').$name);
      }else{
        $name = 'avatar.png';
      }
      $request->merge(['avatar' => $name]);

      // Update User Then Return Response
      return $user = $user->update($request->except('user_id','user_add','avatar_url','image','photo','role','password_confirmation')) ? response()->json(["status" => true]) : response()->json(["status" => false]); 
  }

  public function destroy($id)
  {
      $user = User::findOrfail($id); 
      $imagePath = public_path('images/users/').$user->image; 

      if(File::exists($imagePath)){
          File::delete($imagePath);
      }

      return  $user->delete() ? response()->json(["status" => true]) : response()->json(["status" => false]);
  }

  public function getAllUsers(){
    $users = User::all();
    return response()->json(["status" => true, "data" =>  UserResource::Collection($users)]);
  }

  public function getUsers(){
    $users = User::orderBy('id', 'desc')->paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($users)]);
  }

  public function getAdmins(){
    $admins = Admin::paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($admins)]);
  }

  public function getOwnerStadiums(){
    $stadium_owners = User::withRole('stadium_owner')->paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($stadium_owners)]);
  }

  public function getTeamOwners(){
    $team_owners = User::withRole('team_owner')->paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($team_owners)]);
  }

  public function getRefrees(){
    $refrees = User::withRole('refree')->paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($refrees)]);
  }

  public function getPlayers(){
    $players = User::withRole('player')->paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($players)]);
  }

  public function sendRequest($id, $clubId, $leagueId = 0){

    $user = User::findOrFail($id);
    $data = ["player" => $user->id , "club" => $clubId , "league" => $leagueId];

    $user->notify(new Join($data));

      
  }


  public function invite($id, $ref){

    $user = User::find($id);
    $user->ref = $ref;

    $user->notify(new Invitation($user));

  }


  public function join(Request $request){

    $team = User::whereRef($request->get('ref'))->first();
    $user = Auth::user();

    DB::table('team_player')->insert(['team_id' => $team->id , 'player_id' => $user->id ]);

  }


  public function getUserData($id){

    $user = User::find($id);
    return response()->json(["status" => true, "data" => new UserResource($user)]);
    

  }

  public function setRating(request $request){

    $rating = Rating::create($request->all());

    return response()->json(["status" => true, "data" => $rating ]);
  }

  public function players(){

    $players = User::withRole('player')->get();

    return response()->json(["status" => true, "data" => $players ]);

  }

  
  public function generateInvitationToken($id) {

    $player = User::FindOrFail($id);
    $player->update('invitation_token', substr(md5(rand(0, 9) . $player->email . time()), 0, 32));

    return response()->json(["status" => true, "data" => $player ]);

  }

  public function getTeamPlayers($id){
    //$team = DB::table('team_player')->where('team_id', $id)->get();
    $players = TeamPlayer::whereTeamId($id)->with('player')->get();
    return response()->json(["status" => true, "data" => $players ]);
  }

  public function setPlayStatus($player_id,$status){
    //$team = DB::table('team_player')->where('team_id', $id)->where('player_id' , $player_id)->update(["play" => "main"]);
    $player = TeamPlayer::wherePlayerId($player_id)->firstOrFail();
    $players = TeamPlayer::whereTeamId($player->team_id)->with('player')->get();
    $status == 0 ? $player->update(["play" => "main"]) : $player->update(["play" => "spare"]);
    return response()->json(["status" => true, "data" => $players ]);
  }

  public function setCaptain($player_id){
    //$team = DB::table('team_player')->where('team_id', $id)->where('player_id' , $player_id)->update(["captain" => 1]);
    $player = TeamPlayer::wherePlayerId($player_id)->firstOrFail();
    $players = TeamPlayer::whereTeamId($player->team_id)->with('player')->get();
    $player->update(["captain" => 1]);
    return response()->json(["status" => true, "data" => $players ]);
  }

}

?>