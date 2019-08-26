@extends('admin.layouts.gen')


@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-md-4 my-3">
          <div class="bg-mattBlackLight p-3">
            <h4 class="mb-2">Client</h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
      </div>

      <div class="col-md-4 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>

    <div class="col-md-4 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>

  </div>




  <div class="row">
    <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="col-md-6 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <canvas id="myChartOne" width="400" height="400"></canvas>
      </div>
    </div>

</div>




<div class="row">
    <div class="col-md-6 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <canvas id="myChartTwo" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="col-md-6 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <canvas id="myChartThree" width="400" height="400"></canvas>
      </div>
    </div>
</div>

  
<div class="row">
    <div class="col-md-7 my-3">
        <div class="bg-mattBlackLight p-3">
          <h4 class="mb-2">Client</h4>
          <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="col-md-5 my-3">
      <div class="bg-mattBlackLight p-3">
        <h4 class="mb-2">Client</h4>
        <table class="table table-striped table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
      </div>
    </div>
</div>



</div>
@endsection