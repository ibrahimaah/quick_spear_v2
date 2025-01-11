{{-- @dd(auth()->user()->notifications) --}}
@extends('admin.layouts.app')
@section('title', 'تفاصيل الأرباح')
@section('pageTitle', 'تفاصيل الأرباح')
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
                        {{-- <th scope="col">عدد الطلبات</th> --}}
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
                                    <a class="btn btn-sm btn-success" href="{{ asset('storage/' . $statement->pdf_path) }}" target="_blank">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $statement->delegate->name }}</td> 
                                <td>{{ $statement->created_at->format('Y-m-d h:i A') }}</td>
                                <td>{{ $statement->final_total }}</td> 
                                <td>{{ $statement->delegate_profits }}</td>
                                <td>{{ $statement->calculated_profit ?? 'N/A' }}</td>
                            </tr>  
                        @endforeach
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
 
    
 

@endsection
