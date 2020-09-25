@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
        @include('layouts.sidevar')
    </div>
    <div class="col-md-9">
     <div class="card">
       <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
          先生表示
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
