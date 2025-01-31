@extends('pages.user.express.index')

@section('active4', 'active')
@section('expressContent')



{{-- @php
    $shipment_status_id = App\Models\ShipmentStatus::UNDER_REVIEW;
@endphp --}}
<style>
   #shipments_form > div > div:nth-child(1) > div > #rmv-btn {
        visibility: hidden !important;
    }
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
</style>
{{-- <h2 class="mb-4">{{ __('Create') }} {{ __('Shipping.') }} </h2> --}}
<h2 class="mb-4">إنشاء شحنة للمتجر <span class="fw-bold text-success">{{ $shop?->name }}</span></h2>
{{--<a class="btn btn-primary mb-3" href="{{ route('front.get_shipments_import') }}">{{ __('Excel Import') }}</a>
<a class="btn btn-success mb-3" href="{{ asset('assets/file.xlsx') }}">{{ __('Excel Import Format') }}</a> --}}

<div class="card">
    @if (session()->has('error'))
        <div class="alert text-center py-4 text-light my-3 alert-danger">{{ session()->get('error') }}</div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
          </div>
    @endif
    {{-- <div class="card-header"> --}}
        {{-- <h4>#1</h4> --}}
    {{-- </div> --}}
    <div class="card-body">
        <div class="container">
            <div class="table-responsive">
                <table class="table border table-sm scroll-horizontal basic-1">
                    <thead>
                        <tr>
                            <th>#</th> 
                            <th>إلى</th>
                            <th>نوع الموقع</th> 
                            <th>السعر</th>
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
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <a href="{{ url()->previous() }}" class="btn btn-danger btn-lg my-3">رجوع</a>
        </div>
    </div>
</div>



@endsection
