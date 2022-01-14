@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{-- <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div> --}}
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  % Representatividad del Nivel de Plagas
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content mb-3">
                  <div class="d-flex">
                      <div class="col-md-6">
                          <label for="">Mes</label>
                          <select name="filter_plaga_nivel_mes" id="filter_plaga_nivel_mes" class="form-control">
                              <option value="">-- Seleccione Mes--</option>
                              <option value="1" {{$mesNivelPlaga == '1' ? 'selected' : ''}}>Enero</option>
                              <option value="2" {{$mesNivelPlaga == '2' ? 'selected' : ''}}>Febrero</option>
                              <option value="3" {{$mesNivelPlaga == '3' ? 'selected' : ''}}>Marzo</option>
                              <option value="4" {{$mesNivelPlaga == '4' ? 'selected' : ''}}>Abril</option>
                              <option value="5" {{$mesNivelPlaga == '5' ? 'selected' : ''}}>Mayo</option>
                              <option value="6" {{$mesNivelPlaga == '6' ? 'selected' : ''}}>Junio</option>
                              <option value="7" {{$mesNivelPlaga == '7' ? 'selected' : ''}}>Julio</option>
                              <option value="8" {{$mesNivelPlaga == '8' ? 'selected' : ''}}>Agosto</option>
                              <option value="9" {{$mesNivelPlaga == '9' ? 'selected' : ''}}>Setiembre</option>
                              <option value="10" {{$mesNivelPlaga == '10' ? 'selected' : ''}}>Octubre</option>
                              <option value="11" {{$mesNivelPlaga == '11' ? 'selected' : ''}}>Noviembre</option>
                              <option value="12" {{$mesNivelPlaga == '12' ? 'selected' : ''}}>Diciembre</option>
                          </select>
                      </div>
                    </div>
                </div>
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                    <canvas id="myChartPlagasNivel" width="400" height="400"></canvas>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  % Plagas mas presentadas
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content mb-3">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <label for="">Mes</label>
                            <select name="filter_plaga_presente_mes" id="filter_plaga_presente_mes" class="form-control">
                                <option value="">-- Seleccione Mes--</option>
                                <option value="1" {{$mesPlagaPresente == '1' ? 'selected' : ''}}>Enero</option>
                                <option value="2" {{$mesPlagaPresente == '2' ? 'selected' : ''}}>Febrero</option>
                                <option value="3" {{$mesPlagaPresente == '3' ? 'selected' : ''}}>Marzo</option>
                                <option value="4" {{$mesPlagaPresente == '4' ? 'selected' : ''}}>Abril</option>
                                <option value="5" {{$mesPlagaPresente == '5' ? 'selected' : ''}}>Mayo</option>
                                <option value="6" {{$mesPlagaPresente == '6' ? 'selected' : ''}}>Junio</option>
                                <option value="7" {{$mesPlagaPresente == '7' ? 'selected' : ''}}>Julio</option>
                                <option value="8" {{$mesPlagaPresente == '8' ? 'selected' : ''}}>Agosto</option>
                                <option value="9" {{$mesPlagaPresente == '9' ? 'selected' : ''}}>Setiembre</option>
                                <option value="10" {{$mesPlagaPresente == '10' ? 'selected' : ''}}>Octubre</option>
                                <option value="11" {{$mesPlagaPresente == '11' ? 'selected' : ''}}>Noviembre</option>
                                <option value="12" {{$mesPlagaPresente == '12' ? 'selected' : ''}}>Diciembre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Orden</label>
                            <select name="filter_plaga_presente_orden" id="filter_plaga_presente_orden" class="form-control">
                                <option value="asc" {{$ordenPlagaPresente == 'asc' ? 'selected' : ''}}>Menor a Mayor</option>
                                <option value="desc" {{$ordenPlagaPresente == 'desc' ? 'selected' : ''}}>Mayor a Menor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                    <canvas id="myChartPlagasPresentadas" width="400" height="400"></canvas>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <div class="row">
            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-chart-pie mr-1"></i>
                        % Cumplimiento de parámetros dentro del umbral
                    </h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">

                    <div class="tab-content p-0">
                      <!-- Morris chart - Sales -->
                        <canvas id="myChartPlantas" width="400" height="400"></canvas>
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-chart-pie mr-1"></i>
                      % Satisfaccion de Muestras
                    </h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content mb-3">
                        <div class="d-flex">
                            <div class="col-md-6">
                                <label for="">Mes</label>
                                <select name="filter_satisfaccion_mes" id="filter_satisfaccion_mes" class="form-control">
                                    <option value="">-- Seleccione Mes--</option>
                                    <option value="1" {{$mesSatisfaccion == '1' ? 'selected' : ''}}>Enero</option>
                                    <option value="2" {{$mesSatisfaccion == '2' ? 'selected' : ''}}>Febrero</option>
                                    <option value="3" {{$mesSatisfaccion == '3' ? 'selected' : ''}}>Marzo</option>
                                    <option value="4" {{$mesSatisfaccion == '4' ? 'selected' : ''}}>Abril</option>
                                    <option value="5" {{$mesSatisfaccion == '5' ? 'selected' : ''}}>Mayo</option>
                                    <option value="6" {{$mesSatisfaccion == '6' ? 'selected' : ''}}>Junio</option>
                                    <option value="7" {{$mesSatisfaccion == '7' ? 'selected' : ''}}>Julio</option>
                                    <option value="8" {{$mesSatisfaccion == '8' ? 'selected' : ''}}>Agosto</option>
                                    <option value="9" {{$mesSatisfaccion == '9' ? 'selected' : ''}}>Setiembre</option>
                                    <option value="10" {{$mesSatisfaccion == '10' ? 'selected' : ''}}>Octubre</option>
                                    <option value="11" {{$mesSatisfaccion == '11' ? 'selected' : ''}}>Noviembre</option>
                                    <option value="12" {{$mesSatisfaccion == '12' ? 'selected' : ''}}>Diciembre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-0">
                      <!-- Morris chart - Sales -->
                        <canvas id="myChartSatisfaccion" width="400" height="400"></canvas>
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop
@section('javascripts')
    <script>
        $('#filter_plaga_nivel_mes,#filter_plaga_presente_mes,#filter_plaga_presente_orden,#filter_satisfaccion_mes').change(function (e) {
            e.preventDefault();

            var filter_plaga_nivel_mes = $('#filter_plaga_nivel_mes').val();
            var filter_plaga_presente_mes = $('#filter_plaga_presente_mes').val();
            var filter_plaga_presente_orden = $('#filter_plaga_presente_orden').val();
            var filter_satisfaccion_mes = $('#filter_satisfaccion_mes').val();
            window.location.href ="{{route('home')}}/?plaga_nivel_mes=" + filter_plaga_nivel_mes +'&plaga_presente_mes='+ filter_plaga_presente_mes
            + '&orden_plaga_presente='+filter_plaga_presente_orden + '&filter_satisfaccion_mes='+filter_satisfaccion_mes;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChartPlagasNivel').getContext('2d');
        // Por nivel de plagas
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Bajo', 'Medio', 'Alto'],
                datasets: [{
                    label: '# de plagas por nivel',
                    data: @json($array_nivel),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // Plagas mas presentadas
        var ctx1 = document.getElementById('myChartPlagasPresentadas').getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($array_plagas),
                datasets: [{
                    label: '% de plagas',
                    data: @json($array_plagaPresente),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Plantas fuera del umbral
        var ctx2 = document.getElementById('myChartPlantas').getContext('2d');
        var myChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ["SI","no"],
                datasets: [{
                    label: 'Plantas dentro del umbral',
                    data: @json($array_umbral),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Porcentaje satisfaccion
        var ctx3 = document.getElementById('myChartSatisfaccion').getContext('2d');
        var myChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: ['Satisfactorio','No satisfactorio'],
                datasets: [{
                    label: '% Satisfacción',
                    data: @json($satisfaccion),
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

