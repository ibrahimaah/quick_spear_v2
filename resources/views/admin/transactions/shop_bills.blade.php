@extends('admin.layouts.app')

@section('title', 'عرض كل طلبات الدفع')

@section('content')

<div class="row">
	<div class="col-sm-12">
	    <div class="card">
	      <div class="card-header">
	        <div class="d-flex justify-content-between">
				<h5>طلبات الدفع</h5>
				<a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
			</div>
	      </div>

           
	    </div>
	</div>
</div>
@endsection