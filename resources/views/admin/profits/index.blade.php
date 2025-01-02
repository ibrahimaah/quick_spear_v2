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

        </div>
    </div>
 
    @isset($profits)
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card text-center shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4>مجموع الأرباح</h4>
                </div>
                <div class="card-body">
                    <h1 class="display-4 text-success">
                         <span id="profits">{{ $profits ?? 0 }}</span>
                    </h1>
                    <p class="fw-bold text-secondary" style="font-size: 1.5rem;">دينار أردني</p>
                    {{-- <p class="card-text text-muted">Profits calculated between the selected dates.</p> --}}
                </div>
                {{-- <div class="card-footer text-muted">
                    Last updated: <span id="last-updated">N/A</span>
                </div> --}}
            </div>
        </div>
    </div>
    @endisset
 

@endsection
