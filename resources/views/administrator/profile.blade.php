@extends('layouts.administrator')

@section('title')
Profile
@endsection

@section('css')
<link href="{{ asset('js/plugins/dropify/css/dropify.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
@endsection

@section('content')
  <div class="page-head">
          <h2 class="page-head-title">Profile</h2>
          <ol class="breadcrumb page-head-nav">
            <li><a href="{{route('administrator.dashboard')}}">Administrator</a></li>
            <li class="active">Profile</li>
          </ol>
        </div>
<div class="main-content container-fluid">
  <div class="row">

  <div class="col-xs-12">
    <div class="user-display">
      <div class="user-display-bg"><img src="{{asset('img/user-profile-display.png')}}" alt="Profile Background"></div>
      <div class="user-display-bottom">
        <div class="user-display-avatar"><img src="{{asset('storage/images/avatar/'.$user->avatar)}}" alt="Avatar"></div>
        <div class="user-display-info">
          <div class="name">{{$user->name}}</div>
          <div class="nick"><span class="mdi mdi-account"></span> Administrator</div>
        </div>
        <div class="row user-display-details">
        </div>
      </div>
    </div>
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading panel-heading-divider">About Me<span class="panel-subtitle"></span></div>
                <div class="panel-body">
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

                  <form action="{{route('administrator.profile.update')}}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="nama" class="col-sm-3 control-label">Nama:</label>
                      <div class="col-sm-6">
                        <input type="text" id="nama" name="nama" class="validate form-control" value="{{$user->name}}" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">Email:</label>
                      <div class="col-sm-6">
                        <input type="email" id="email" name="email" class="validate form-control" value="{{$user->email}}" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="password" class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-6">
                        <input id="password" name="password" type="password" class="validate form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>
                      <div class="col-sm-6">
                        <input id="confirm_password" name="confirm_password" type="password" class="validate form-control">
                      </div>
                    </div>

                    <div class="row section">
                      <div class="col-sm-3">
                      </div>
                      <div class="col-sm-6">
                          <p>Upload Foto Profil (Maximum file upload size 2MB).</p>
                          <input type="file" name="foto" class="dropify" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg bmp" @if (is_null($user->avatar)))
                            data-default-file="{{asset('storage/images/avatar/default.png')}}"
                            @else
                              data-default-file="{{asset('storage/images/avatar/'.$user->avatar)}}"
                          @endif
                            data-max-file-size="2M" />
                      </div>
                    </div>
                    <br><br>
                    <div class="row">
                      <div class="col-md-8">

                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-space btn-primary">Simpan</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
                </div>
                </div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/plugins/dropify/js/dropify.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){



    $("#formValidate").validate({
          rules: {
              nama: {
                  required: true
              },
              email: {
                  required: true,
                  email:true,
              },

              password: {
  				minlength: 6
  			},
  			confirm_password: {
  				minlength: 6,
  				equalTo: "#password"
  			},
          },
          //For custom messages
          messages: {
              nama:{
                  required: "Enter a username",
                  minlength: "Enter at least 5 characters"
              },
          },

          errorElement : 'div',
          errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          }
       });

    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer',
            error:   'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('.dropify-event').dropify();
    drEvent.on('dropify.beforeClear', function(event, element){
        return confirm("Do you really want to delete \"" + element.filename + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element){
        alert('File deleted');
    });

  });
</script>
@endsection
