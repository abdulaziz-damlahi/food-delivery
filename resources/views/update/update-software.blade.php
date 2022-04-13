@extends('layouts.blank')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-2"></div>
            <div class="col-md-8">
                <div class="mar-ver pad-btm text-center">
                    <h1 class="h3">eFood Software Update</h1>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="POST" action="{{route('update-system')}}">
                            @csrf
                            <div class="form-group">
                                <label for="purchase_code">Codecanyon Username</label>
                                <input type="text" class="form-control" id="username" value="GambitSteel"
                                       name="username" readonly>
                            </div>

                            <div class="form-group">
                                <label for="purchase_code">Purchase Code</label>
                                <input type="text" class="form-control" id="purchase_key"
                                       value="(gambitsteel)-6127-4e1f-a6b1-b8483036fe00" name="purchase_key" readonly>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
