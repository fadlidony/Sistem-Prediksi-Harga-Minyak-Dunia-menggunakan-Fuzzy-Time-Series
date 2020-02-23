@extends('layouts.administrator')

@section('title')
Hasil
@endsection

@section('perhitungan')
active
@endsection

@section('content')
  <div class="page-head">
          <h2 class="page-head-title">Hasil Perhitungan</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="{{route('administrator.dashboard')}}">Administrator</a></li>
            <li><a href="{{route('administrator.dataset')}}">Dataset</a></li>
            <li class="active">Hasil Perhitungan</li>
          </ol>
        </div>
<div class="main-content container-fluid">
  <div class="row">

  <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-divider">Jumlah interval {{$k}} dan lebar Interval {{$lebar}} <span class="panel-subtitle"></span></div>
                  <div class="panel-body">
                    <div class="row">
                      <br>
                      @if (session()->has('warning'))
                        <div role="alert" class="alert alert-contrast alert-warning alert-dismissible">
                          <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                          <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Warning!</strong> {{Session::get('warning')}}
                        </div>
                      </div>
                      @endif

                      @if (session()->has('success'))
                        <div role="alert" class="alert alert-contrast alert-success alert-dismissible">
                          <div class="icon"><span class="mdi mdi-check"></span></div>
                          <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Good!</strong> {{Session::get('success')}}
                          </div>
                        </div>
                      @endif
                    </div>


                    <div class="row">
                      <table id="table1" class="table table-striped table-hover table-fw-widget">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Interval</th>
                            <th>Median</th>

                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $i=1;
                          @endphp
                          @foreach ($interval as $key)
                            <tr>
                              <td class="center">{{$i}}</td>
                              <td class="center">U{{$i}} = [{{$key['bawah']}} - {{$key['atas']}}]</td>
                              <td class="center">{{$key['median']}}</td>
                            </tr>
                            @php
                              $i++;
                            @endphp
                          @endforeach

                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-divider">Hasil Fuzzy Relationship Orde {{$orde}}.<span class="panel-subtitle"></span></div>
                  <div class="panel-body">

                    <div class="row">
                      <table id="table2" class="table table-striped table-hover table-fw-widget">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Harga</th>
                            <th>Fuzzifikasi</th>
                            <th>Relationship</th>

                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $i=1;
                          @endphp
                          @foreach ($flr as $key)
                            <tr>
                              <td class="center">{{$i}}</td>
                              <td class="center">{{$key['harga']}}</td>
                              <td class="center">A{{$key['fuzzifikasi']}}</td>
                              @if (is_null($key['orde']))
                                <td class="center">-</td>
                              @else
                                <td class="center">
                                  @foreach ($key['orde'] as $key2)
                                    A{{$key2}},
                                  @endforeach
                                  ->A{{$key['fuzzifikasi']}}</td>
                              @endif
                            </tr>
                            @php
                              $i++;
                            @endphp
                          @endforeach

                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
                          </div>


                  <div class="col-xs-12">

                  <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">FLRG Model Chen Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                    <div class="panel-body">

                      <div class="row">
                        <table id="table3" class="table table-striped table-hover table-fw-widget">
                          <thead>
                            <tr>
                              <th>Grup</th>
                              <th>Relationship</th>
                              <th>FLRG</th>

                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i=1;
                            @endphp
                            @foreach ($flrg_chen as $key)
                              <tr>
                                <td class="center">{{$i}}</td>
                                  <td class="center">
                                    @foreach ($key['relasi'] as $key2)
                                      A{{$key2}},
                                    @endforeach
                                  </td>
                                  <td class="center">
                                    @foreach ($key['hasil'] as $key2)
                                      A{{$key2}},
                                    @endforeach
                                  </td>
                              </tr>
                              @php
                                $i++;
                              @endphp
                            @endforeach

                          </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                            </div>

                  <div class="col-xs-12">

                  <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">FLRG Model Lee Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                    <div class="panel-body">

                      <div class="row">
                        <table id="table4" class="table table-striped table-hover table-fw-widget">
                          <thead>
                            <tr>
                              <th>Grup</th>
                              <th>Relationship</th>
                              <th>FLRG</th>

                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $i=1;
                            @endphp
                            @foreach ($flrg_lee as $key)
                              <tr>
                                <td class="center">{{$i}}</td>
                                  <td class="center">
                                    @foreach ($key['relasi'] as $key2)
                                      A{{$key2}},
                                    @endforeach
                                  </td>
                                  <td class="center">

                                    @foreach ($key['hasil'] as $key2=> $value)
                                      A{{$key2}}({{$value}}),
                                    @endforeach
                                  </td>
                              </tr>
                              @php
                                $i++;
                              @endphp
                            @endforeach

                          </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                            </div>


                    <div class="col-xs-12">

                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-divider">Defuzzifikasi Model Chen Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                      <div class="panel-body">

                        <div class="row">
                          <table id="table5" class="table table-striped table-hover table-fw-widget">
                            <thead>
                              <tr>
                                <th>Grup</th>
                                <th>Relasi</th>
                                <th>FLRG</th>
                                <th>Hasil Ramalan</th>

                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i=1;
                              @endphp
                              @foreach ($defuzzifikasi_chen as $key)
                                <tr>
                                  <td class="center">{{$i}}</td>
                                    <td class="center">
                                      @foreach ($key['relasi'] as $key2)
                                        A{{$key2}},
                                      @endforeach
                                    </td>
                                    <td class="center">
                                      @foreach ($key['hasil'] as $key2)
                                        A{{$key2}},
                                      @endforeach
                                    </td>
                                    <td class="center">{{$key['ramalan']}}</td>
                                </tr>
                                @php
                                  $i++;
                                @endphp
                              @endforeach

                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                              </div>

                    <div class="col-xs-12">

                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-divider">Defuzzifikasi Model Lee Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                      <div class="panel-body">

                        <div class="row">
                          <table id="table6" class="table table-striped table-hover table-fw-widget">
                            <thead>
                              <tr>
                                <th>Grup</th>
                                <th>Relasi</th>
                                <th>FLRG</th>
                                <th>Hasil Ramalan</th>

                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i=1;
                              @endphp
                              @foreach ($defuzzifikasi_lee as $key)
                                <tr>
                                  <td class="center">{{$i}}</td>
                                    <td class="center">
                                      @foreach ($key['relasi'] as $key2)
                                        A{{$key2}},
                                      @endforeach
                                    </td>
                                    <td class="center">

                                      @foreach ($key['hasil'] as $key2=> $value)
                                        A{{$key2}}({{$value}}),
                                      @endforeach
                                    </td>
                                    <td class="center">{{$key['ramalan']}}</td>
                                </tr>
                                @php
                                  $i++;
                                @endphp
                              @endforeach

                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>
                              </div>




                      <div class="col-xs-12">

                      <div class="panel panel-default">
                        <div class="panel-heading panel-heading-divider">Hasil Prediksi Model Chen Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                        <div class="panel-body">

                          <div class="row">
                            <table id="table7" class="table table-striped table-hover table-fw-widget">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Harga</th>
                                  <th>Fuzzifikasi</th>
                                  <th>Relasi</th>
                                  <th>Prediksi</th>

                                </tr>
                              </thead>
                              <tbody>
                                @php
                                  $i=1;
                                @endphp
                                @foreach ($prediksi_chen as $key)
                                  <tr>
                                    <td class="center">{{$i}}</td>
                                    <td class="center">{{$key['tanggal']}}</td>
                                    <td class="center">{{$key['harga']}}</td>
                                    <td class="center">A{{$key['fuzzifikasi']}}</td>
                                      <td class="center">
                                        @if (!is_null($key['orde']))
                                          @foreach ($key['orde'] as $key2)
                                            A{{$key2}},
                                          @endforeach
                                        @else
                                          -
                                        @endif

                                      </td>
                                      @if (!is_null($key['orde']))
                                        <td class="center">{{$key['ramalan']}}</td>
                                      @else
                                        <td class="center">-</td>
                                      @endif

                                  </tr>
                                  @php
                                    $i++;
                                  @endphp
                                @endforeach

                              </tbody>
                            </table>
                          </div>

                        </div>






                              </div>
                      </div>


                          <div class="col-xs-12">

                          <div class="panel panel-default">
                            <div class="panel-heading panel-heading-divider">Hasil Prediksi Model Lee Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                            <div class="panel-body">

                              <div class="row">
                                <table id="table8" class="table table-striped table-hover table-fw-widget">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Tanggal</th>
                                      <th>Harga</th>
                                      <th>Fuzzifikasi</th>
                                      <th>Relasi</th>
                                      <th>Prediksi</th>

                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                      $i=1;
                                    @endphp
                                    @foreach ($prediksi_lee as $key)
                                      <tr>
                                        <td class="center">{{$i}}</td>
                                        <td class="center">{{$key['tanggal']}}</td>
                                        <td class="center">{{$key['harga']}}</td>
                                        <td class="center">A{{$key['fuzzifikasi']}}</td>
                                          <td class="center">
                                            @if (!is_null($key['orde']))
                                              @foreach ($key['orde'] as $key2)
                                                A{{$key2}},
                                              @endforeach
                                            @else
                                              -
                                            @endif

                                          </td>
                                          @if (!is_null($key['orde']))
                                            <td class="center">{{$key['ramalan']}}</td>
                                          @else
                                            <td class="center">-</td>
                                          @endif

                                      </tr>
                                      @php
                                        $i++;
                                      @endphp
                                    @endforeach

                                  </tbody>
                                </table>
                              </div>

                                    </div>
                        </div>
                      </div>


                      <div class="col-xs-12">

                      <div class="panel panel-default">
                        <div class="panel-heading panel-heading-divider">Perbandingan Prediksi Model Chen dan Model Lee Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                        <div class="panel-body">

                          <div class="row">
                            <table id="table9" class="table table-striped table-hover table-fw-widget">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Tanggal</th>
                                  <th>Harga</th>
                                  <th>Fuzzifikasi</th>
                                  <th>Relasi</th>
                                  <th>Prediksi Chen</th>
                                  <th>Prediksi Lee</th>

                                </tr>
                              </thead>
                              <tbody>
                                @php
                                  $i=1;
                                @endphp
                                @foreach ($prediksi_chen as $key)
                                  <tr>
                                    <td class="center">{{$i}}</td>
                                    <td class="center">{{$key['tanggal']}}</td>
                                    <td class="center">{{$key['harga']}}</td>
                                    <td class="center">A{{$key['fuzzifikasi']}}</td>
                                      <td class="center">
                                        @if (!is_null($key['orde']))
                                          @foreach ($key['orde'] as $key2)
                                            A{{$key2}},
                                          @endforeach
                                        @else
                                          -
                                        @endif

                                      </td>
                                      @if (!is_null($key['orde']))
                                        <td class="center">{{$key['ramalan']}}</td>
                                      @else
                                        <td class="center">-</td>
                                      @endif

                                      @if (!is_null($key['orde']))
                                        <td class="center">{{$prediksi_lee[$i-1]['ramalan']}}</td>
                                      @else
                                        <td class="center">-</td>
                                      @endif

                                  </tr>
                                  @php
                                    $i++;
                                  @endphp
                                @endforeach

                              </tbody>
                            </table>
                          </div>


                                </div>
                    </div>
                  </div>


                  <div class="col-xs-12">

                  <div class="panel panel-default">
                    <div class="panel-heading panel-heading-divider">Grafik Perbandingan antara Dataset dengan Hasil perhitungan Model Chen dan Model Lee<span class="panel-subtitle"></span></div>
                    <div class="panel-body">

                      <canvas id="canvas"></canvas>


                            </div>




                          </div>
                  </div>




                    <div class="col-xs-12">

                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-divider">Kesalahan Prediksi Model Chen Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                      <div class="panel-body">

                        <div class="row">
                          <table id="table10" class="table table-striped table-hover table-fw-widget">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Harga</th>
                                <th>Hasil Ramalan</th>
                                <th>Nilai Absolute</th>
                                <th>AFER</th>
                                <th>MSE</th>

                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i=1;
                              @endphp
                              @foreach ($error_chen as $key)
                                <tr>
                                  <td class="center">{{$i}}</td>
                                  <td class="center">{{$key['tanggal']}}</td>
                                  <td class="center">{{$key['harga']}}</td>
                                  <td class="center">{{$key['ramalan']}}</td>

                                  @if (!is_null($key['absolute']))
                                    <td class="center">{{$key['absolute']}}</td>
                                    <td class="center">{{$key['afer']}}</td>
                                    <td class="center">{{$key['mse']}}</td>
                                  @else
                                    <td class="center">-</td>
                                    <td class="center">-</td>
                                    <td class="center">-</td>
                                  @endif

                                </tr>
                                @php
                                  $i++;
                                @endphp
                              @endforeach

                            </tbody>
                          </table>
                        </div>

                        <div class="row">
                          <div class="container">
                            <br>
                            <p>Rata-rata nilai AFER: {{$mean_chen['afer']*100}}%</p>
                            <p>Rata-rata nilai MSE: {{$mean_chen['mse']}}</p>
                            <p>Nilai RMSE: {{$mean_chen['rmse']}}</p>
                            <p>Tingkat ketepatan metode Chen dengan pengujian data menggunakan model AFER pada analisis fuzzy time series adalah 100% - {{round($mean_chen['afer']*100,2)}}% = {{100-(round($mean_chen['afer']*100,2))}}%</p>
                          </div>

                        </div>

                      </div>
                    </div>
                              </div>

                    <div class="col-xs-12">

                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-divider">Kesalahan Prediksi Model Lee Berdasarkan orde {{$orde}}.<span class="panel-subtitle"></span></div>
                      <div class="panel-body">

                        <div class="row">
                          <table id="table11" class="table table-striped table-hover table-fw-widget">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Harga</th>
                                <th>Hasil Ramalan</th>
                                <th>Nilai Absolute</th>
                                <th>AFER</th>
                                <th>MSE</th>

                              </tr>
                            </thead>
                            <tbody>
                              @php
                                $i=1;
                              @endphp
                              @foreach ($error_lee as $key)
                                <tr>
                                  <td class="center">{{$i}}</td>
                                  <td class="center">{{$key['tanggal']}}</td>
                                  <td class="center">{{$key['harga']}}</td>
                                  <td class="center">{{$key['ramalan']}}</td>

                                  @if (!is_null($key['absolute']))
                                    <td class="center">{{$key['absolute']}}</td>
                                    <td class="center">{{$key['afer']}}</td>
                                    <td class="center">{{$key['mse']}}</td>
                                  @else
                                    <td class="center">-</td>
                                    <td class="center">-</td>
                                    <td class="center">-</td>
                                  @endif

                                </tr>
                                @php
                                  $i++;
                                @endphp
                              @endforeach

                            </tbody>
                          </table>
                        </div>

                        <div class="row">
                          <div class="container">
                            <br>
                            <p>Rata-rata nilai AFER: {{$mean_lee['afer']*100}}%</p>
                            <p>Rata-rata nilai MSE: {{$mean_lee['mse']}}</p>
                            <p>Nilai RMSE: {{$mean_lee['rmse']}}</p>
                            <p>Tingkat ketepatan metode Lee dengan pengujian data menggunakan model AFER pada analisis fuzzy time series adalah 100% - {{round($mean_lee['afer']*100,2)}}% = {{100-(round($mean_lee['afer']*100,2))}}%</p>
                          </div>

                        </div>

                              </div>




                            </div>
                    </div>




                    <div class="col-xs-12">

                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-divider">Kesimpulan<span class="panel-subtitle"></span></div>
                      <div class="panel-body">

                        <div style="padding-left:20px;padding-right:20px;"class="row">
                            <br>
                            @if ($hasil['model']=='sama')
                              <p>Berdasarkan hasil perhitungan Prediksi Harga Minyak Dunia Menggunakan Fuzzy Time Series dengan membandingkan Model Chen dan Lee didapatkan bahwa Model Chen dan Model Lee memiliki tingkat akurasi yang sama yaitu mencapai {{$hasil['akurasi']}}%
                                </p>
                            @else
                              <p>Berdasarkan hasil perhitungan Prediksi Harga Minyak Dunia Menggunakan Fuzzy Time Series dengan membandingkan Model Chen dan Lee didapatkan bahwa Model {{$hasil['model']}} Lebih baik dengan tingkat akurasi mencapai {{$hasil['akurasi']}}%
                                </p>
                            @endif

                          </div>


                              </div>




                            </div>
                    </div>




              </div>
                </div>
@endsection


@section('js')
<script src="{{asset('lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" charset="utf8" src="{{asset('plugins/chart/chart.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('plugins/chart/util.js')}}"></script>

<script type="text/javascript">
//We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );

    $("#table1").dataTable();
    $("#table2").dataTable();
    $("#table3").dataTable();
    $("#table4").dataTable();
    $("#table5").dataTable();
    $("#table6").dataTable();
    $("#table7").dataTable();
    $("#table8").dataTable();
    $("#table9").dataTable();
    $("#table10").dataTable();
    $("#table11").dataTable();


		var config = {
			type: 'line',

			data: {
        labels: [@foreach ($dataset as $key)'{{$key->tanggal}}',@endforeach],
				datasets: [{
					label: 'Dataset awal',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
            @foreach ($dataset as $key){{(float)($key->harga)}},@endforeach
					],
					fill: false,
				},
         {
					label: 'Model Chen',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
            @foreach ($prediksi_chen as $key)
            @if (is_null($key['ramalan']))
              null,
            @else
            {{(float)($key['ramalan'])}},
            @endif
            @endforeach
					],
				},
        {
         label: 'Model Lee',
         fill: false,
         backgroundColor: window.chartColors.green,
         borderColor: window.chartColors.green,
         data: [
           @foreach ($prediksi_lee as $key)
           @if (is_null($key['ramalan']))
             null,
           @else
           {{(float)($key['ramalan'])}},
           @endif
           @endforeach
         ],
       }
     ]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Perbandingan Hasil Prediksi'
				},
        plugins: {
    datalabels: {
        display: false,
    },
},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Tanggal'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Harga'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};




    //Remove search & paging dropdown



</script>
@endsection
