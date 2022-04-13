@extends('layouts.blank')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <div class="mar-ver pad-btm text-center">
                    <h1 class="h3">Purchase Code</h1>
                    <p>
						Nulled by @GambitSteel from Babiato.co
					</p>
                </div>
                <div class="text-muted font-13">
                    <form method="POST" action="{{ route('purchase.code') }}">
                        @csrf
                        <div class="form-group">
                            <label for="purchase_code">Codecanyon Username</label>
                            <input type="text" value="GambitSteel" class="form-control" id="username" name="username" readonly>
                        </div>

                        <div class="form-group">
                            <label for="purchase_code">Purchase Code</label>
                            <input type="text" value="(gambitsteel)-6127-4e1f-a6b1-b8483036fe00" class="form-control" id="purchase_key" name="purchase_key" readonly>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
