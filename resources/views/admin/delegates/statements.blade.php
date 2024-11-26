@extends('admin.layouts.app')
@section('title', 'الكشوفات')
@section('content')

 
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5>
                        @if($delegate)
                        <span>الكشوفات الخاصة بالمندوب</span><span class="text-success"> {{ $delegate->name }}</span>
                        @endif
                    </h5>
                    <a href="{{ url()->previous() }}" class="btn btn-danger d-block">رجوع</a>
                </div>
			</div>
			
			

			<div class="card-body">
				<div class="table-responsive">
					<table class="display" id="basic-1">
						<thead>
							<tr>
								<th>#</th>
								<th>تاريخ الكشف</th>
								<th>العمليات</th> 
							</tr>
						</thead>
						<tbody>
							@foreach($delegate_statements_ids as $delegate_statements_id)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ 'test' }}</td>
                                        <td><a class="btn btn-sm btn-success" href="{{ route('admin.delegates.view_delegate_statment',['delegate_statements_id' => $delegate_statements_id]) }}">عرض الكشف</a></td> 
                                    </tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection