@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
           サイドバー 
        </div>
      </div>
    </div>
    <div class="col-md-9">
     <div class="card">
       <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
          プロフィール編集 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection