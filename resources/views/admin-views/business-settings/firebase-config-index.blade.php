@extends('layouts.admin.app')

@section('title', \App\CentralLogics\translate('Settings'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{\App\CentralLogics\translate('Firebase Message Configuration')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            @php($data=\App\CentralLogics\Helpers::get_business_settings('firebase_message_config'))
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{env('APP_MODE')!='demo'?route('admin.business-settings.firebase_message_config'):'javascript:'}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($data))
                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('API Key')}}</label><br>
                            <input type="text" placeholder="" class="form-control" name="apiKey"
                                   value="{{env('APP_MODE')!='demo'?$data['apiKey']:''}}" required autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('Auth Domain')}}</label><br>
                            <input type="text" class="form-control" name="authDomain" value="{{env('APP_MODE')!='demo'?$data['authDomain']:''}}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('Project ID')}}</label><br>
                            <input type="text" class="form-control" name="projectId" value="{{env('APP_MODE')!='demo'?$data['projectId']:''}}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('Storage Bucket')}}</label><br>
                            <input type="text" class="form-control" name="storageBucket" value="{{env('APP_MODE')!='demo'?$data['storageBucket']:''}}" required autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('Messaging Sender ID')}}</label><br>
                            <input type="text" placeholder="" class="form-control" name="messagingSenderId"
                                   value="{{env('APP_MODE')!='demo'?$data['messagingSenderId']:''}}" required autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <label style="padding-left: 10px">{{\App\CentralLogics\translate('App ID')}}</label><br>
                            <input type="text" placeholder="" class="form-control" name="appId"
                                   value="{{env('APP_MODE')!='demo'?$data['appId']:''}}" required autocomplete="off">
                        </div>

                        <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}" class="btn btn-primary mb-2">{{\App\CentralLogics\translate('save')}}</button>
                    @else
                        <button type="submit" class="btn btn-primary mb-2">{{\App\CentralLogics\translate('configure')}}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
