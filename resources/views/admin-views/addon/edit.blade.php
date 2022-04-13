@extends('layouts.admin.app')

@section('title', \App\CentralLogics\translate('Update Addon'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{\App\CentralLogics\translate('Addon Update')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.addon.update',[$addon['id']])}}" method="post">
                    @csrf
                    @php($language=\App\Model\BusinessSetting::where('key','language')->first())
                    @php($language = $language->value ?? null)
                    @php($default_lang = 'en')
                    @if($language)
                        @php($default_lang = json_decode($language)[0])
                        <ul class="nav nav-tabs mb-4">
                            @foreach(json_decode($language) as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}" href="#" id="{{$lang}}-link">{{\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="row">
                            <div class="col-6">
                                @foreach(json_decode($language) as $lang)
                                    <?php
                                    if(count($addon['translations'])){
                                        $translate = [];
                                        foreach($addon['translations'] as $t)
                                        {
                                            if($t->locale == $lang && $t->key=="name"){
                                                $translate[$lang]['name'] = $t->value;
                                            }
                                        }
                                    }
                                    ?>
                                        <div class="form-group {{$lang != $default_lang ? 'd-none':''}} lang_form" id="{{$lang}}-form">
                                            <label class="input-label"
                                                   for="exampleFormControlInput1">{{\App\CentralLogics\translate('name')}}
                                                ({{strtoupper($lang)}})</label>
                                            <input type="text" name="name[]"
                                                   value="{{$lang==$default_lang?$addon['name']:($translate[$lang]['name']??'')}}"
                                                   class="form-control"
                                                   placeholder="{{ \App\CentralLogics\translate('New Addon') }}"
                                                   {{$lang == $default_lang? 'required':''}} maxlength="255"
                                                   oninvalid="document.getElementById('en-link').click()">
                                        </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group lang_form" id="{{$default_lang}}-form">
                                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('name')}} ({{strtoupper($lang)}})</label>
                                                <input type="text" name="name[]" value="{{$addon['name']}}" class="form-control" placeholder="{{\App\CentralLogics\translate('New Addon')}}" required maxlength="255">
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{$default_lang}}">
                                            @endif
                                            <input name="position" value="0" style="display: none">
                                        </div>
                                        <div class="col-6 from_part_2">
                                            <div class="form-group">
                                                <label class="input-label" for="exampleFormControlInput1">{{\App\CentralLogics\translate('price')}}</label>
                                                <input type="number" min="0" step="0.01" name="price"
                                                       value="{{$addon['price']}}" class="form-control"
                                                       placeholder="{{\App\CentralLogics\translate('200')}}" required
                                                       oninvalid="document.getElementById('en-link').click()">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    <button type="submit" class="btn btn-primary">{{\App\CentralLogics\translate('update')}}</button>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '{{$default_lang}}')
            {
                $(".from_part_2").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });
    </script>

@endpush
