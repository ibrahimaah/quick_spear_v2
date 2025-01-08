{{-- @dd(auth()->user()->notifications) --}}
@extends('admin.layouts.app')
@section('title', 'الأرباح')
@section('pageTitle', 'الأرباح')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.calc_profits') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <label class="col-form-label">من</label>
                        </div>
                        <div class="col-auto">
                          <input type="date" class="form-control" name="from" value="{{ $from ?? '' }}" required>
                        </div>
                        <div class="col-auto"> 
                            <label class="col-form-label">إلى</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" class="form-control" name="to" value="{{ $to ?? '' }}" required>
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="form-control btn btn-primary" value="حساب">
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('admin.profits') }}" class="btn btn-danger">جديد</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="display text-center" id="basic-1">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">العمليات</th>
                        <th scope="col">المندوب</th>
                        <th scope="col">التاريخ</th>
                        <th scope="col">التحصيل</th>
                        <th scope="col">عدد الطلبات</th>
                        <th scope="col">أجور المندوب</th>
                        <th scope="col">أرباح</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($statementsGroupedByDelegate as $delegateId => $statements)
                        @foreach($statements as $statement)
                            <tr>
                                <th>{{ $statement->id }}</th>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{ asset('storage/' . $statement->pdf_path) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    @php
                                        $delegate = App\Models\Delegate::findOrFail($delegateId);
                                        echo $delegate->name;
                                    @endphp
                                </td>  
                                <td>{{ $statement->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>30</td>
                                <td>15</td>
                                <td>9</td>
                                <td>3</td>
                            </tr>  
                        @endforeach
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
 
    
 

@endsection
