@extends('layouts.app_login')
@section('seo')
<?php
$title='Forgot password - Step 2 | '.Helpers::get_setting('seo_title');
$description='Forgot password - Step 2  | '.Helpers::get_setting('seo_description');
$keyword=Helpers::get_setting('seo_keyword');
$thumb_img_seo=asset(Helpers::get_setting('seo_image'));
$data_seo = array(
    'title' => $title,
    'keywords' => $keyword,
    'description' =>$description,
    'og_title' => $title,
    'og_description' => $description,
    'og_url' => Request::url(),
    'og_img' => $thumb_img_seo,
    'current_url' =>Request::url(),
    'current_url_amp' => Request::url()
    //route('amp.category.list',array($data->slug))
);
$seo = WebService::getSEO($data_seo);
?>
@include('partials.seo')
@endsection
@section('content')
<div class="container">
   <div class="d-flex justify-content-center h-100">
      <div class="card">
         <div class="card-header">
            <h3>Forgot password - Step 2</h3>
         </div>
         <div class="card-body">
            @if (count($errors) >0)
               @foreach($errors->all() as $error)
                 <div class="text-danger"> {{ $error }}</div>
               @endforeach
            @endif
            @if (session('status'))
               <div class="text-danger"> {{ session('status') }}</div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('actionForgetPassword_step2') }}">
               {{ csrf_field() }}
               <div class="input-group form-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" name="otp_mail" placeholder="OTP in email" class="txt_id form-control" required autofocus>
                  @if ($errors->has('otp_mail'))
                  <span class="help-block">
                  <strong>{{ $errors->first('otp_mail') }}</strong>
                  </span>
                  @endif
               </div>
               <div class="form-group">
                  <input type="submit" value="Continue" class="btn float-right login_btn">
               </div>
            </form>
         </div>
         <div class="card-footer">

         </div>
      </div>
   </div>
</div>
@endsection
