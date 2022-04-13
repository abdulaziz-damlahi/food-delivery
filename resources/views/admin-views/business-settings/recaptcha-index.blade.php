@extends('layouts.admin.app')

@section('title', \App\CentralLogics\translate('reCaptcha Setup'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-sm-0">
                    <h1 class="page-header-title">{{\App\CentralLogics\translate('reCaptcha Credentials Setup')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <div class="flex-between">
                            <h3>{{\App\CentralLogics\translate('reCaptcha')}}</h3>
                            <div class="btn-sm btn-dark p-2" data-toggle="modal" data-target="#recaptcha-modal"
                                 style="cursor: pointer">
                                <i class="tio-info-outined"></i> {{\App\CentralLogics\translate('Credentials SetUp')}}
                            </div>
                        </div>
                        <div class="mt-4">
                            @php($config=\App\CentralLogics\Helpers::get_business_settings('recaptcha'))
                            <form
                                action="{{env('APP_MODE')!='demo'?route('admin.business-settings.recaptcha_update',['recaptcha']):'javascript:'}}"
                                method="post">
                                @csrf

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status"
                                           value="1" {{isset($config) && $config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{\App\CentralLogics\translate('active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status"
                                           value="0" {{isset($config) && $config['status']==0?'checked':''}}>
                                    <label
                                        style="padding-left: 10px">{{\App\CentralLogics\translate('inactive')}} </label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="text-capitalize"
                                           style="padding-left: 10px">{{\App\CentralLogics\translate('Site Key')}}</label><br>
                                    <input type="text" class="form-control" name="site_key"
                                           value="{{env('APP_MODE')!='demo'?$config['site_key']??"":''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label class="text-capitalize"
                                           style="padding-left: 10px">{{\App\CentralLogics\translate('Secret Key')}}</label><br>
                                    <input type="text" class="form-control" name="secret_key"
                                           value="{{env('APP_MODE')!='demo'?$config['secret_key']??"":''}}">
                                </div>

                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{\App\CentralLogics\translate('save')}}</button>
                            </form>
                            {{-- Modal --}}
                            <div class="modal fade" id="recaptcha-modal" data-backdrop="static" data-keyboard="false"
                                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="staticBackdropLabel">{{\App\CentralLogics\translate('reCaptcha credential Set up Instructions')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ol>
                                                <li>{{\App\CentralLogics\translate('Go to the Credentials page')}}
                                                    ({{\App\CentralLogics\translate('Click')}} <a
                                                        href="https://www.google.com/recaptcha/admin/create"
                                                        target="_blank">{{\App\CentralLogics\translate('here')}}</a>)
                                                </li>
                                                <li>{{\App\CentralLogics\translate('Add a ')}}
                                                    <b>{{\App\CentralLogics\translate('label')}}</b> {{\App\CentralLogics\translate('(Ex: Test Label)')}}
                                                </li>
                                                <li>
                                                    {{\App\CentralLogics\translate('Select reCAPTCHA v2 as ')}}
                                                    <b>{{\App\CentralLogics\translate('reCAPTCHA Type')}}</b>
                                                    ({{\App\CentralLogics\translate("Sub type: I'm not a robot Checkbox")}}
                                                    )
                                                </li>
                                                <li>
                                                    {{\App\CentralLogics\translate('Add')}}
                                                    <b>{{\App\CentralLogics\translate('domain')}}</b>
                                                    {{\App\CentralLogics\translate('(For ex: demo.6amtech.com)')}}
                                                </li>
                                                <li>
                                                    {{\App\CentralLogics\translate('Check in ')}}
                                                    <b>{{\App\CentralLogics\translate('Accept the reCAPTCHA Terms of Service')}}</b>
                                                </li>
                                                <li>
                                                    {{\App\CentralLogics\translate('Press')}}
                                                    <b>{{\App\CentralLogics\translate('Submit')}}</b>
                                                </li>
                                                <li>{{\App\CentralLogics\translate('Copy')}} <b>Site
                                                        Key</b> {{\App\CentralLogics\translate('and')}} <b>Secret
                                                        Key</b>, {{\App\CentralLogics\translate('paste in the input filed below and')}}
                                                    <b>Save</b>.
                                                </li>
                                            </ol>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">{{\App\CentralLogics\translate('Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
