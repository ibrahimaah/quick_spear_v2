@extends('admin.layouts.app')
@section('title', 'المستخدمين')
@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#main-info" type="button" role="tab">البيانات الرئيسية</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#shipments" type="button" role="tab">الشحن</button>
    </li> 
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="main-info" role="tabpanel">
        <div class="row mt-5">
            <div class="col-sm-8">
                <h5 class="mb-4">معلومات الحساب</h5>
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">اسم المستخدم</th>
                        <td>{{ $user->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">البريد الالكتروني</th>
                        <td>{{ $user->email ?? 'غير محدد'}}</td>
                      </tr>
                      <tr>
                        <th scope="row">رقم الهاتف</th>
                        <td>{{ $user->phone }}</td>
                      </tr>
                      <tr>
                        <th scope="row">اسم المتجر</th>
                        <td>{{ $user->shop->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">المدينة</th>
                        <td>{{ $user->shop->city->name }}</td>
                      </tr>
                      <tr>
                        <th scope="row">المنطقة</th>
                        <td>{{ $user->shop->region }}</td>
                      </tr>
                      <tr>
                        <th scope="row">الوصف</th>
                        <td>{{ $user->shop->description }}</td>
                      </tr>
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="shipments" role="tabpanel">
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>الشحنات</h5>
                    </div>
                    <div class="card-body datatable-container" id="myTabContent">
                            {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>اسعار التوصيل لهذا المستخدم</h5>
                        <button class="btn btn-success"
                                data-bs-toggle="modal" 
                                data-bs-target="#store-price-modal">إضافة سعر</button>
                                <div class="modal fade" id="store-price-modal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="post"
                                                action="{{ route('admin.delivery_price.store') }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        إضافة سعر توصيل جديد
                                                    </h5>
                                                    <button type="button" 
                                                            class="btn-close"
                                                            data-bs-dismiss="modal" >
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="shop_id" value="{{ $user->shop->id }}">
                                                    <div class="mb-3 row">
                                                        <label class="col-sm-3 col-form-label" >
                                                            اختر المحافظة
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="city" id="select-city" required>
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('city')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-sm-3 col-form-label" >
                                                            اختر المنطقة
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="regions[]" id="select-region" multiple="multiple">
                                                                
                                                            </select>
                                                            @error('region')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-sm-3 col-form-label" >
                                                            سعر التوصيل
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <input
                                                                class="form-control @error('price') is-invalid @enderror"
                                                                name="price" 
                                                                type="text"
                                                                value=""
                                                                required 
                                                            >
                                                            @error('price')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            id="store-price-save-btn"
                                                            class="btn btn-primary">إضافة</button> 
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border table-sm scroll-horizontal basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th> 
                                        <th>إلى</th>
                                        <th>نوع الموقع</th> 
                                        <th>السعر</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shop->deliveryPrices as $deliveryPrice) 
                                        <tr>
                                            <td>{{ $loop->iteration }}</td> 
                                            <td>
                                                
                                                @if(get_class($deliveryPrice->location) == "App\Models\City")
                                                    <span>{{ $deliveryPrice->location->name }}</span>
                                                @else 
                                                    @php 
                                                        $city_region = $deliveryPrice->location->city->name;
                                                        $city_region = "تتبع لمحافظة ".$city_region;
                                                    @endphp 
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $city_region }}">{{ $deliveryPrice->location->name }}</span>
                                                @endif 
                                                
                                            </td>
                                            <td>
                                                @if(get_class($deliveryPrice->location) == "App\Models\City")
                                                    <span>محافظة</span>
                                                @else 
                                                    
                                                     <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $city_region }}">منطقة</span>
                                                     @php 
                                                        $city_region = $deliveryPrice->location->city->name;
                                                        // $city_region = "تتبع لمحافظة ".$city_region;
                                                        echo '('.$city_region.')';
                                                    @endphp 
                                                @endif 
                                            </td>
                                            <td>{{ $deliveryPrice->price }}</td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-primary" 
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#edit-rate2-1">
                                                    تعديل
                                                </button>

                                                <div class="modal fade" id="edit-rate2-1" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post"
                                                                action="{{ route('admin.delivery_price.update',['id' => $deliveryPrice->id]) }}">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        تعديل</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3 row">
                                                                        <label class="col-sm-3 col-form-label" >
                                                                            سعر التوصيل
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input
                                                                                class="form-control @error('price') is-invalid @enderror"
                                                                                name="price" 
                                                                                type="text"
                                                                                value="{{ $deliveryPrice->price }}"
                                                                                required />
                                                                            @error('price')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">حفظ</button>
                                                                    {{-- <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">إغلاق</button> --}}
                                                                    
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <a onclick="confirm('برجاء تأكيد العملية') ? document.getElementById('delete_delivery_price{{ $deliveryPrice->id }}').submit() : '';" class="btn btn-sm btn-danger"> <i class="bi bi-trash"></i></a>

                                                <form action="{{ route('admin.delivery_price.delete',['id' => $deliveryPrice->id]) }}" id="delete_delivery_price{{ $deliveryPrice->id }}" method="post">
                                                    @csrf 
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> 
  </div>
  
     
    @push('scripts')
    {{ $dataTable->scripts() }}
    <script>

        function fetchRegions(cityId) 
        {
            // alert(cityId)
            var url = "{{ route('admin.delivery_price.get_regions_by_city_id', ['city' => 'CITY_ID_PLACEHOLDER']) }}";
            url = url.replace('CITY_ID_PLACEHOLDER', cityId);

            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() { 
                    // $('#store-price-save-btn').prop('disabled', true);
                    $('#select-region').prop('disabled', true);
                    $('#store-price-save-btn').addClass('disabled-button');
                },
                complete: function() { 
                    // $('#store-price-save-btn').prop('disabled', false);
                    $('#select-region').prop('disabled', false);
                    $('#store-price-save-btn').removeClass('disabled-button'); 
                },
                success: function(response) {
                    if (response.code == 1) {
                        var regions = response.data;
                        console.log(regions)
                        var regionSelect = $('#select-region');
                        regionSelect.empty();
                        regionSelect.append('<option value=""></option>'); // Add default empty option
                        $.each(regions, function(index, region) {
                            regionSelect.append('<option value="' + region.id + '">' + region.name + '</option>');
                        });
                    } else if (response.code == 0) {
                        regionSelect.empty();
                        alert(response.msg);
                    }
                },
                error: function() {
                    console.log('An error occurred')
                }
            });
        }

        $(document).ready(function() 
          {
            $('#select-city').select2(); 
            $('#select-region').select2(); 
            
            $('#select-city').select2({
                dropdownParent: $('#store-price-modal')
            });
            $('#select-region').select2({
                dropdownParent: $('#store-price-modal')
            });  
          });


          var initialCityId = $('#select-city').val();
            if (initialCityId) {
                fetchRegions(initialCityId);
            }

            // Fetch regions on change event
            $('#select-city').on('change', function (e) {
                var cityId = $("option:selected", this).val();
                if (cityId) {
                    fetchRegions(cityId);
                }
            });
      
      </script>

    @endpush
@endsection
