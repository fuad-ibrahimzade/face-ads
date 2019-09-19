@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        {{--Your application's dashboard.--}}
                        <span>Link Count:&nbsp;&nbsp;</span><h4 style="display: inline">{{$link_click_count}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
