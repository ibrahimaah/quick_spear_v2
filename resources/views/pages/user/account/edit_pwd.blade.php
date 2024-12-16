@extends('pages.user.express.index')
@section('title', 'تعديل كلمة المرور')
@section('content')


<div class="row justify-content-center">
   
    <div class="col-sm-6">

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session()->has('success'))
        <div class="alert text-center py-4 my-3 alert-success">{{ session()->get('success') }}</div>
      @endif

      <div class="card">
        <div class="card-header">
          <h5>تعديل كلمة المرور</h5>
        </div>
        <form class="form theme-form" 
              method="POST" 
              action="{{ route('front.user.update_pwd') }}">
          
          @csrf
          <div class="card-body"> 
            <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">كلمة المرور الجديدة</label>
              <div class="col-sm-9">
                <input class="form-control @error('new_password') is-invalid @enderror" 
                       name="new_password" 
                       type="password" 
                       placeholder="كلمة المرور الجديدة" 
                       required />
                @error('new_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">تأكيد كلمة المرور </label>
              <div class="col-sm-9">
                <input class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                       name="new_password_confirmation" 
                       type="password" 
                       placeholder="تأكيد كلمة المرور " 
                       required />
                @error('new_password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>


          </div>
          <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit">حفظ</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger">رجوع</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

 