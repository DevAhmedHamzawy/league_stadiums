<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Stadium;
use App\User;
use App\Setting;
use Carbon\Carbon;
use DB;
use Khill\Lavacharts\Lavacharts;
use App\Article;
use App\Admin;
use App\Contact;

class AdminController extends Controller
{
    public function dashboard(){

        $lava = new Lavacharts;


        $leaguesStadiumsYear = $lava->DataTable();
        $leaguesStadiumsYear->addNumberColumn('الدوريات');
        $leaguesStadiumsYear->addNumberColumn('الملاعب');

        for($i = 1; $i <= 12; $i++){
            $leaguesStadiumsYear->addRow([  League::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $i)->count(), Stadium::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $i)->count() ]);
        }
        

        $chart1 = $lava->LineChart('leaguesStadiumsYear' , $leaguesStadiumsYear, [
            'title' => 'الدوريات والملاعب المضافة لسنة '.Carbon::now()->year
        ]);
       

        $stadiumsOwnerYear = $lava->DataTable();
        $stadiumsOwnerYear->addNumberColumn('أصحاب الملاعب');
        $stadiumsOwnerYear->addNumberColumn('أصحاب الملاعب');

        for($i = 1; $i <= 12; $i++){
            $stadiumsOwnerYear->addRow([  User::whereYear('created_at' , Carbon::now()->year)->withRole('stadium_owner')->whereMonth('created_at' , $i)->count() ]);
        } 
        
        $chart2 = $lava->LineChart('stadiumsOwnerYear' , $stadiumsOwnerYear, [
            'title' => 'أصحاب الملاعب المسجلين فى سنة '.Carbon::now()->year
        ]);


        $teamsOwnerYear = $lava->DataTable();
        $teamsOwnerYear->addNumberColumn('أصحاب الفرق');
        $teamsOwnerYear->addNumberColumn('أصحاب الفرق');

        for($i = 1; $i <= 12; $i++){
            $teamsOwnerYear->addRow([ User::whereYear('created_at' , Carbon::now()->year)->whereMonth('created_at' , $i)->withRole('team_owner')->count() ]);
        }        

        $chart3 = $lava->LineChart('teamsOwnerYear' , $teamsOwnerYear, [
            'title' => 'أصحاب الفرق المسجلين فى سنة '.Carbon::now()->year
        ]);

        

        $topStadiumLeagues = $lava->DataTable();
        $topStadiumLeagues->addStringColumn('أكثر الملاعب مضافة');
        $topStadiumLeagues->addNumberColumn('أكثر الملاعب مضافة');




        $topStadiumLeaguesByMonth = DB::table('leagues')
        ->select('stadium_id', DB::raw('COUNT(stadium_id) as leagues'))
        ->whereMonth('created_at' , Carbon::now()->month)
        ->groupBy('stadium_id')
        ->orderBy(DB::raw('COUNT(stadium_id)'), 'DESC')
        ->take(5)
        ->get();

        $tslnames = [];
        $tslleagues = [];

        foreach($topStadiumLeaguesByMonth as $thsl){
            //$thsl->stadium_id
            $topStadiumLeagues->addRow(['ssss', $thsl->leagues]);
        }

        $chart4 = $lava->PieChart('topStadiumLeagues' , $topStadiumLeagues, [
            'title' => 'أصحاب الفرق المسجلين فى سنة '.Carbon::now()->year
        ]);


        $topStadiumLeaguesByMonth = DB::table('leagues')
        ->select('stadium_id', DB::raw('COUNT(stadium_id) as leagues'))
        ->whereMonth('created_at' , Carbon::now()->month)
        ->groupBy('stadium_id')
        ->orderBy(DB::raw('COUNT(stadium_id)'), 'DESC')
        ->take(5)
        ->get();

        $tslnames = [];
        $tslleagues = [];

        foreach($topStadiumLeaguesByMonth as $thsl){
            //$thsl->stadium_id
            $topStadiumLeagues->addRow(['ssss', $thsl->leagues]);
        }

        $chart4 = $lava->PieChart('topStadiumLeagues' , $topStadiumLeagues, [
            'title' => 'أصحاب الفرق المسجلين فى سنة '.Carbon::now()->year
        ]);

        $stadiums = Stadium::count();
        $leagues = League::count();
        $users = User::count();



        $usersToday = User::whereDay('created_at', Carbon::now()->day)->count();
        $stadiumsToday = Stadium::whereDay('created_at', Carbon::now()->day)->count();
        $leaguesToday = League::whereDay('created_at', Carbon::now()->day)->count();
        $articlesToday = Article::whereDay('created_at', Carbon::now()->day)->count();


        $team_owner = User::withRole('team_owner')->count();
        $stadiums_owner = User::withRole('stadium_owner')->count();
        $players = User::withRole('player')->count();
        $refrees = User::withRole('refree')->count();
        $commentators = User::withRole('commentator')->count();
        $stadiums_responsible = User::withRole('stadiums_responsible')->count();
        $teams_responsible = User::withRole('teams_responsible')->count();
        $leagues_responsible = User::withRole('leagues_responsible')->count();
        $complaints_responsible = User::withRole('complaints_responsible')->count();
        $editors = User::withRole('editor')->count();
        $articles = Article::count();
        $tags = DB::table('tags')->count();
        $contacts = Contact::count();


        $leagues_month = League::whereDay('created_at', Carbon::now()->month)->count();
        $stadiums_month = Stadium::whereDay('created_at', Carbon::now()->month)->count();
        $team_owner_month = User::withRole('team_owner')->whereDay('created_at', Carbon::now()->month)->count();
        $stadiums_owner_month = User::withRole('stadium_owner')->whereDay('created_at', Carbon::now()->month)->count();
        $articles_month = Article::whereDay('created_at', Carbon::now()->month)->count();
        $tags_month = DB::table('tags')->whereDay('created_at', Carbon::now()->month)->count();

        
        $leagues = League::latest()->take(5)->get();
        $stadiums = Stadium::latest()->take(5)->get();

        $settings = Setting::findOrFail(1);


        return view('admin.dashboard', compact('lava','stadiums','leagues','users','usersToday','stadiumsToday','leaguesToday','articlesToday' , 'team_owner' , 'stadiums_owner' , 'players' , 'refrees' , 'commentators' ,  'stadiums_responsible' , 'teams_responsible' ,  'leagues_responsible'  , 'complaints_responsible' , 'editors' , 'articles' , 'tags' , 'contacts' , 'admins',
        'leagues_month', 'stadiums_month', 'team_owner_month', 'stadiums_owner_month', 'articles_month', 'tags_month' , 'leagues' , 'stadiums', 'settings'));
    }


    public function leagues(){

        return view('admin.leagues');
    }

    public function stadiums(){

        return view('admin.stadiums');
    }

    public function widgets(){

        return view('admin.widgets');
    }

    public function teamowners(){

        return view('admin.teamowners');
    }

    public function players(){

        return view('admin.players');
    }

    public function refrees(){

        return view('admin.refrees');
    }

    public function blogsadd(){

        return view('admin.blogs.add');
    }

    public function users(){

        return view('admin.users');
    }

    public function admins(){

        return view('admin.admins');
    }

    public function articles(){

        return view('admin.articles');
    }

    public function tags(){

        return view('admin.tags');
    }

    public function settings(){

        $settings = Setting::findOrFail(1);

        return view('admin.settings', compact('settings'));
    }
}
