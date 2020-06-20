@extends('admin.layouts.gen')


@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight p-3">
            <h4 class="mb-2">عدد الملاعب</h4>
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $stadiums }}%" aria-valuenow="{{ $stadiums }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
      </div>

      <div class="col-md-4 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">عدد الدوريات</h4>
          <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: {{ $leagues }}%" aria-valuenow="{{ $leagues }}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>

    <div class="col-md-4 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">عدد المستخدمين</h4>
        <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ $users }}%" aria-valuenow="{{ $users }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>



    <div class="col-md-3">
        <div class="card-counter primary">
        <i class="material-icons icon">person</i>
        <span class="count-numbers">{{ $usersToday }}</span>
        <span class="count-name">المستخدمين المسجلين اليوم</span>
        </div>
        </div>
        <div class="col-md-3">
        <div class="card-counter danger">
        <i class="material-icons icon">track_changes</i>
        <span class="count-numbers">{{ $stadiumsToday }}</span>
        <span class="count-name">الملاعب المضافة اليوم</span>
        </div>
        </div>
        <div class="col-md-3">
        <div class="card-counter info">
        <i class="material-icons icon">collections</i>
        <span class="count-numbers">{{ $leaguesToday }}</span>
        <span class="count-name">الدوريات المضافة اليوم</span>
        </div>
        </div>
        
        <div class="col-md-3">
        <div class="card-counter success">
        <i class="material-icons icon">content_copy</i>
        <span class="count-numbers">{{ $articlesToday }}</span>
        <span class="count-name">المقالات المضافة اليوم</span>
        </div>
        </div>

  </div>


  <div class="row">
    <div class="col-md-12 my-3">
    <div class="bg-mattBlackLight p-3">
            <h2 class="mt-4 mb-5 text-center">الإحصائيات الكلية لدورى الملاعب</h2>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المستخدمين
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $team_owner }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            أصحاب الملاعب
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $stadiums_owner }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            اللاعبين
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $players }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المعلقين
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $commentators }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المسئولين عن الملاعب
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $stadiums_responsible }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                           المسئولين عن الفرق
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $teams_responsible }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المسئولين عن الدوريات 
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $leagues_responsible }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المسئولين عن الشكاوى
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $complaints_responsible }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المحررين 
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $editors }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            المقالات
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $articles }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            الوسوم 
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $tags }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="circle-tile">
                                                    <a href="#">
                                                        <div class="circle-tile-heading green">
                                                            <i class="fa fa-money fa-fw fa-3x"></i>
                                                        </div>
                                                    </a>
                                                    <div class="circle-tile-content green">
                                                        <div class="circle-tile-description text-faded">
                                                            رسائل الزوار 
                                                        </div>
                                                        <div class="circle-tile-number text-faded">
                                                            {{ $contacts }}
                                                        </div>
                                                        <a href="#" class="circle-tile-footer">عرض التفاصيل <i class="fa fa-chevron-circle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
    </div>
  </div>

  {{--<div class="row">
    <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <div id="stadium_owner_year" class="col-md-6 content noscroll" style="height: 300px;" ></div>
          </div>
    </div>

    <div class="col-md-6 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <div id="leagues_stadiums_year" class="col-md-6 content noscroll" style="height: 300px;" ></div>

      </div>
    </div>

</div>




<div class="row">
    <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <div id="teams_owner_year" class="col-md-6 content noscroll" style="height: 300px;" ></div>
          </div>
    </div>

    <div class="col-md-6 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <div id="top_stadium_leagues" class="col-md-6 content noscroll" style="height: 300px;" ></div>

      </div>
    </div>
</div>
--}}
<div class="row">

        <div class="col-md-6 my-3">
                <div class="bg-mattBlackLight p-3">

                <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img class="card-img-top" src="{{ Auth::user()->avatar }}" alt="Card image cap">
                        </div>
                        <div class="card-body pt-0">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <p class="card-text">{{ Auth::user()->description }}</p>
                        <a href="#" class="btn btn-primary">مشاهدة البروفايل</a>
                        </div>
                    </div>

                </div>
              </div>

              <div class="col-md-6 my-3">
                            <div class="card profile-card-3">
                                    <div class="background-block">
                                        <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background"/>
                                    </div>
                                    <div class="profile-thumb-block">
                                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                                    </div>
                                    <div class="card-content">
                                    <h2>دورى الملاعب<small>{!! $settings->about !!}</small></h3>
                                    <div class="icon-block"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="{{ $settings->facebook }}"> <i class="fab fa-twitter"></i></a><a href="{{ $settings->twitter }}"> <i class="fab fa-google-plus"></i></a></div>
                                    </div>
                                </div>
                  </div>

</div>


<div class="row">
        <div class="col-md-12">
            <div class="card">
                    <h5 class="card-header">
                            <div class="col-md-12 text-center title">إحصائيات شهر {{ \Carbon\Carbon::now()->month }}</div>
                    </h5>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                            <h3 class="bars">الدوريات</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $leagues_month }}" aria-valuemin="0" aria-valuemax="100">{{ $leagues_month }}</div>
                                            </div>
                                            <h3 class="bars">الملاعب</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $stadiums_month }}" aria-valuemin="0" aria-valuemax="100">{{ $stadiums_month }}</div>
                                            </div>
                                            <h3 class="bars">أصحاب الفرق</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $team_owner_month }}" aria-valuemin="0" aria-valuemax="100">{{ $team_owner_month }}</div>
                                            </div>
                                            <h3 class="bars">أصحاب الملاعب</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $stadiums_owner_month }}" aria-valuemin="0" aria-valuemax="100">{{ $stadiums_owner_month }}</div>
                                            </div>
                                            <h3 class="bars">المقالات</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $articles_month }}" aria-valuemin="0" aria-valuemax="100">{{ $articles_month }}</div>
                                            </div>
                                            <h3 class="bars">الوسوم</h3>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $tags_month }}" aria-valuemin="0" aria-valuemax="100">{{ $tags_month }}</div>
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  
<div class="row">
    <div class="col-md-7 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">اخر الدوريات المضافة</h4>
          <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الإسم</th>
                    <th scope="col">صاحب الدورى</th>
                    <th scope="col">نوع التنظيم</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach ($leagues as $league)
                    <tr>
                        <th scope="row">{{ $league->id }}</th>
                        <td>{{ $league->name  }}</td>
                        <td>s</td>
                        <td>s</td>
                    </tr>    
                  @endforeach  
                  
                </tbody>
              </table>
        </div>
    </div>

    <div class="col-md-5 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">اخر الملاعب المضافة</h4>
        <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الإسم</th>
                    <th scope="col">صاحب الملعب</th>
                    <th scope="col">السعر بالساعة / بالدورى</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($stadiums as $stadium)
                        <tr>
                            <th scope="row">{{ $stadium->id }}</th>
                            <td>{{ $stadium->name  }}</td>
                            <td>s</td>
                            <td>s</td>
                        </tr>    
                    @endforeach  
                </tbody>
              </table>
      </div>
    </div>
</div>



</div>
@endsection