@extends('layouts.admin.admin')
@section('title') User {{ $user->firstname }} @endsection
@section('page-title') User: {{ $user->firstname }} - Details @endsection
@section('header')
    {{ Html::style('css/sweetalert.min.css') }}
    {{ Html::style('css/jquery.bootstrap-touchspin.min.css') }}
@endsection
@section('content')
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @include('includes.admin.users.navpills')
                        <div class="card-box">
                            <h4 class="header-title m-b-30">Web Account: Details</h4>
                            <div class="alert-ban">
                                @if($user->isBanned())
                                    <div class="alert alert-danger fade in m-b-30">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4>This account is banned!</h4>
                                        <p style="text-decoration: underline;">Ban reason:</p>
                                        <p style="font-weight: bold;" class="banreason">{{ $user->banReason }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="alert-active">
                                @if(!$user->isActive())
                                    <div class="alert alert-warning">
                                        <strong>Info!</strong> This account is not confirmed by the user.
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-30">Actions</h4>
                                    <div class="text-center buttons">
                                        @if ($user->isBanned())
                                            <button type="button" id="unban-{{$user->id}}" class="unban btn btn-info waves-effect w-md m-b-5"><i class="fa fa-check-circle-o m-r-5"></i> Unban</button>
                                        @else
                                            <button type="button" id="ban-{{$user->id}}" class="ban btn btn-danger waves-effect w-md m-b-5"><i class="fa fa-ban m-r-5"></i> Ban</button>
                                        @endif

                                        @if (!$user->isActive())
                                            <button type="button" id="active-{{$user->id}}" class="activ btn btn-warning waves-effect w-md m-b-5"><i class="fa fa-check m-r-5"></i>Active</button>
                                        @endif
                                        <button type="button" class="btn btn-success waves-effect w-md m-b-5" data-toggle="modal" data-target="#user-password-modal"><i class="fa fa-key m-r-5"></i> Change password</button>
                                        @if ($user->forum_id)
                                            <a class="btn btn-primary waves-effect w-md m-b-5" href="{{ config('dofus.social.forum') }}profile/{{ $user->forum_id }}-null" target="_blank"><i class="fa fa-users m-r-5"></i> Forum</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    {{ Html::image($user->avatar, 'avatar',['class' => 'center-block img-responsive img-circle', 'id' => 'avatar']) }}

                                    @if($user->avatar != config('dofus.default_avatar'))
                                        <br/>
                                        <button id="resetavatar-{{$user->id}}" href="#" class="resetavatar center-block btn btn-default waves-effect w-md waves-light">Reset avatar</button>
                                    @endif
                                    <small class="pull-right">
                                        Member since: {{ $user->created_at->format('d M Y, g:i A') }}
                                    </small>
                                </div>
                            </div>
                            {!! Form::model($user, ['route' => ['admin.user.update',$user->id], 'files' => true]) !!}
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('pseudo') ? ' has-error' : '' }}">
                                        <label for="firstname">Pseudo:</label>
                                        {!! Form::text('pseudo', null, ['class' => 'form-control', 'id' => 'pseudo']) !!}
                                        @if ($errors->has('pseudo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pseudo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <label for="firstname">Firstname:</label>
                                        {!! Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname']) !!}
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        <label for="lastname">Lastname:</label>
                                        {!! Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname']) !!}
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email:</label>
                                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'disabled']) !!}
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('rank') ? ' has-error' : '' }}">
                                        <label for="rank">Rank:</label>
                                        {!! Form::select('rank', ['0' => 'User', '4' => 'Admin'], null,['class' => 'form-control', 'id' => 'rank']) !!}
                                        @if ($errors->has('rank'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rank') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('points') ? ' has-error' : '' }}">
                                        <label for="points">Points:</label>
                                        {!! Form::text('points', null,['class' => 'form-control', 'id' => 'points']) !!}
                                        @if ($errors->has('points'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('points') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group {{ $errors->has('votes') ? ' has-error' : '' }}">
                                        <label for="votes">Votes:</label>
                                        {!! Form::text('votes', null,['class' => 'form-control', 'id' => 'votes', 'disabled']) !!}
                                        @if ($errors->has('votes'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('votes') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="user-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">{{ $user->firstname }}: Edit password</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::open([ 'route' => ['admin.user.password', $user->id], 'id' => 'form-password-user']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">New password:</label>
                                    {!! Form::password('password',['class' => 'form-control']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('passwordConfirmation') ? ' has-error' : '' }}">
                                    <label for="password_confirmation">Confirmation:</label>
                                    {!! Form::password('passwordConfirmation',['class' => 'form-control']) !!}
                                    @if ($errors->has('passwordConfirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('passwordConfirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endsection

        @section('bottom')
            {!! Html::script('js/admin/sweetalert.min.js') !!}
            {!! Html::script('js/admin/jquery.bootstrap-touchspin.min.js') !!}
            <script>

               $(document).ready(function () {
                   // Global variables
                   var root = '{{ route('home') }}';
                   var token = '{{ Session::token() }}';
                   var url_users_base = '{{ route('admin.users')}}';

                   // Touchspin initialize
                   $("input[name='points']").TouchSpin({
                       min: 0,
                       max: 999999999999999999999999999999,
                       step: 1,
                       decimals: 0,
                       boostat: 5,
                       maxboostedstep: 10,
                       buttondown_class: "btn btn-success",
                       buttonup_class: "btn btn-danger",
                       postfix: 'Ogrines'
                   });

                    // Edit Password (Save ajax)
                   $( "#form-password-user" ).on( "submit", function( event ) {
                       event.preventDefault();
                       var $this = $(this);
                       var datas = $this.serialize();

                       $.ajax({
                           method: 'PATCH',
                           url: $this.attr("action"),
                           data: datas,

                           success: function (msg) {

                               toastr.success('Password updated');
                               $('#user-password-modal').modal('hide');
                           },

                           error: function (jqXhr, json, errorThrown) {
                               var errors = jqXhr.responseJSON;
                               var errorsHtml;
                               if(errors)
                               {
                                   errorsHtml= '';
                                   $.each( errors, function( key, value ) {
                                       errorsHtml += '<li>' + value[0] + '</li>';
                                   });
                               }
                               else
                               {
                                   errorsHtml = 'Unknow error';
                               }
                               toastr.error(errorsHtml);
                           }
                       });
                   });
                   // Ban user
                   $("body").on("click", ".ban", function(e) {
                       e.preventDefault();
                       // Find ID of the user
                       var clickedId = $(this).attr('id');
                       var userId = clickedId.replace("ban-", "");
                       var element = $(this);
                       swal({
                           title: "Are you sure to ban this user?",
                           text: "Please, write a ban reason:",
                           type: "input",
                           showCancelButton: true,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "Yes, ban this user!",
                           closeOnConfirm: false }, function(inputValue){
                           if (inputValue === false)
                               return false;
                           if (inputValue === "")
                           {     swal.showInputError("You need to write something!");
                               return false
                           }
                           var banReason = inputValue;

                           $.ajax({
                               method: 'PATCH',
                               url: ''+url_users_base+'/'+userId+'/ban',
                               data: { _token: token, banReason : banReason},

                               success: function (msg) {
                                   swal("Banned!", "This user has been banned.", "success");
                                   var button = '<button type="button" id="unban-'+userId+'" class="unban btn btn-info waves-effect w-md m-b-5"><i class="fa fa-check-circle-o m-r-5"></i> Unban</button>';
                                   element.replaceWith(button);
                                   var alert = '<div class="alert alert-danger alert-ban fade in m-b-30"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h4>This account is banned!</h4> <p style="text-decoration: underline;">Ban reason:</p> <p style="font-weight: bold;" class="banreason">'+banReason+'</p> </div>';
                                   $('div.alert-ban').append(alert);
                               },

                               error: function(jqXhr, json, errorThrown) {
                                   var errors = jqXhr.responseJSON;
                                   var errorsHtml;
                                   if(errors)
                                   {
                                       errorsHtml= '';
                                       $.each( errors, function( key, value ) {
                                           errorsHtml += '<li>' + value[0] + '</li>';
                                       });
                                   }
                                   else
                                   {
                                       errorsHtml = 'Unknow error';
                                   }
                                   toastr.error(errorsHtml);
                               }
                           });

                       });
                   });
                    // Unban user
                   $("body").on("click", ".unban", function (e) {
                       e.preventDefault();
                       // Find ID of the user
                       var clickedId = $(this).attr('id');
                       var userId = clickedId.replace("unban-", "");
                       var element = $(this);

                       var banReason = $('p.banreason').text();

                       swal({
                           title: "Are you sure?",
                           text: "This user will be unbanned!<br/>Ban reason:<br/><strong> "+banReason+"</strong>",
                           html: true,
                           type: "warning",
                           showCancelButton: true,
                           confirmButtonColor: "#DD6B55",
                           confirmButtonText: "Yes, unban him!",
                           closeOnConfirm: false }, function(){

                           $.ajax({
                               method: 'PATCH',
                               url: ''+url_users_base+'/'+userId+'/unban',
                               data: { _token: token },

                               success: function (msg) {
                                   swal("Unbanned!", "User is unbanned.", "success");
                                   var button = '<button type="button" id="ban-'+userId+'" class="ban btn btn-danger waves-effect w-md m-b-5"><i class="fa fa-ban m-r-5"></i> Ban</button>';
                                   element.replaceWith(button);
                                   $('div.alert-ban').html('');
                               },

                               error: function(jqXhr, json, errorThrown) {
                                   var errors = jqXhr.responseJSON;
                                   var errorsHtml;
                                   if(errors)
                                   {
                                       errorsHtml= '';
                                       $.each( errors, function( key, value ) {
                                           errorsHtml += '<li>' + value[0] + '</li>';
                                       });
                                   }
                                   else
                                   {
                                       errorsHtml = 'Unknow error';
                                   }
                                   toastr.error(errorsHtml);
                               }
                           });

                       });
                   });
                    // Active user account
                   $("body").on('click', '.activ', function () {
                       // Find ID of the user
                       var clickedId = $(this).attr('id');
                       var userId = clickedId.replace("active-", "");
                       var element = $(this);


                       $.ajax({
                           method: 'PATCH',
                           url: ''+url_users_base+'/'+userId+'/activate',
                           data: { _token: token },

                           success: function (msg) {
                               $('div.alert-active').html('');
                               element.hide();
                               toastr.success('Account activated');
                           },

                           error: function(jqXhr, json, errorThrown) {
                               var errors = jqXhr.responseJSON;
                               var errorsHtml;
                               if(errors)
                               {
                                   errorsHtml= '';
                                   $.each( errors, function( key, value ) {
                                       errorsHtml += '<li>' + value[0] + '</li>';
                                   });
                               }
                               else
                               {
                                   errorsHtml = 'Unknow error';
                               }
                               toastr.error(errorsHtml);
                           }
                       });
                   });
                   // Reset avatar (AJAX)
                   $('body').on('click', '.resetavatar', function () {
                       // Find ID of the user
                       var clickedId = $(this).attr('id');
                       var userId = clickedId.replace("resetavatar-", "");
                       var element = $(this);

                       var url_default_avatar = '{{ config('dofus.default_avatar') }}';
                       $.ajax({
                           method: 'PATCH',
                           url: ''+url_users_base+'/'+userId+'/avatar/reset',
                           data: { _token: token },

                           success: function (msg) {
                               toastr.success('Avatar updated');
                               element.hide();
                               $('#avatar').attr('src', root+'/'+url_default_avatar);
                           },

                           error: function(jqXhr, json, errorThrown) {
                               var errors = jqXhr.responseJSON;
                               var errorsHtml;
                               if(errors)
                               {
                                   errorsHtml= '';
                                   $.each( errors, function( key, value ) {
                                       errorsHtml += '<li>' + value[0] + '</li>';
                                   });
                               }
                               else
                               {
                                   errorsHtml = 'Unknow error';
                               }
                               toastr.error(errorsHtml);
                           }
                       });
                   });
               });
            </script>
@endsection
