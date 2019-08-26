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
use App\Notifications\Join;
use App\Notifications\Invitation;
use Image;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller 
{

  public function getAllUsers(){
    $users = User::all();
    return response()->json(["status" => true, "data" =>  UserResource::Collection($users)]);
  }

  public function getUsers(){
    $users = User::paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($users)]);
  }

  public function getAdmins(){
    $admins = Admin::paginate(10);
    return response()->json(["status" => true, "data" =>  UserResource::Collection($admins)]);
  }

  public function update(Request $request, $id)
  {
      $user = User::findOrFail($id);
      //$qrcode = QrCode::size(500)->format('png')->generate('localhost/league_stadiums', asset('images/users/qrcodes/'.$request->get('user_name').'.png'));
      $role = Role::findOrFail($request->get('role'));
      //$user->attachRole($role);
      $user->roles()->sync($role);

      if($request->get('image'))
      {
        $image = $request->get('image');
        $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/users/').$name);
      }

      $user->avatar = $name;

      return $user = $user->update($request->except('user_id','avatar_url','image','role','password_confirmation')) ? response()->json(["status" => true]) : response()->json(["status" => false]); 

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    $user = User::findOrFail($id);

    return view('profile' , compact('$user'));
    
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