@extends('layouts.administrator')

@section('title')
Dataset
@endsection

@section('perhitungan')
active
@endsection

@section('content')
  <div class="page-head">
          <h2 class="page-head-title">Dataset</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="{{route('administrator.dashboard')}}">Administrator</a></li>
            <li class="active">Dataset</li>
          </ol>
        </div>
<div class="main-content container-fluid">
  <div class="row">

  <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-divider">Dataset<span class="panel-subtitle">Dataset Harga Minyak Dunia.</span></div>
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

                      <div class="col-xs-2">
                        Import Data
                      </div>
                      <div class="col-xs-10">
                        <form name="tambah" id="tambah" action="{{route('administrator.dataset.import')}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <input type="hidden" name="_method" value="POST">
                            <div class="form-group file-field input-field">
                              <div class="btn">
                                <input name="excel" type="file">
                              </div>
                              <button class="btn btn-primary" type="submit">Import</button>
                              <a class="btn btn-success" href="{{asset('storage/file/template_dataset_minyak.xlsx')}}">Unduh Template</a>
                            </div>

                        </form>
                      </div>
                    </div>


                    <div class="row">
                      <table id="table1" class="table table-striped table-hover table-fw-widget">
                        <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>Harga</th>

                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($dataset as $key)
                            <tr>
                              <td class="center">{{$key->tanggal}}</td>
                              <td class="center">{{$key->harga}}</td>
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>

<br><br>
                    <div class="row">
                      <div class="col-xs-10">
                      </div>
                      <div class="col-xs-2">
                          <button data-modal="full-success" class="btn btn-space btn-success md-trigger">Hitung</button>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
              </div>
                </div>


                <div id="full-success" class="modal-container modal-full-color modal-full-color-success modal-effect-8">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="text-center"><span class="modal-main-icon mdi mdi-assignment"></span>
                                          <h3>Mulai perhitungan!</h3>
                                          <p>Masukkan jumlah orde yang diinginkan.</p>
                                          <form class="" action="{{route('administrator.dataset.hitung')}}" method="post">
                                            @csrf
                                            <div class="md-form mb-5">
                                              <input type="number" id="orde" name="orde"class="form-control" required>
                                            </div>
                                          <div class="xs-mt-50">

                                            <button type="button" data-dismiss="modal" class="btn btn-default btn-space modal-close">Batal</button>
                                            <button type="submit" class="btn btn-success btn-space">Hitung!</button>
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                      <div class="modal-footer"></div>
                                    </div>
                                  </div>
@endsection


@section('js')
<script src="{{asset('lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/jquery.niftymodals/dist/jquery.niftymodals.js')}}" type="text/javascript"></script>

<script type="text/javascript">
$.fn.niftyModal('setDefaults',{
      	overlaySelector: '.modal-overlay',
      	closeSelector: '.modal-close',
      	classAddAfterOpen: 'modal-show',
      });
//We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );

    $("#table1").dataTable();

    //Remove search & paging dropdown
    $("#table2").dataTable({
      pageLength: 6,
      dom:  "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

    //Enable toolbar button functions
    $("#table3").dataTable({
      buttons: [
        'copy', 'excel', 'pdf', 'print'
      ],
      "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
      dom:  "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

</script>
@endsection
