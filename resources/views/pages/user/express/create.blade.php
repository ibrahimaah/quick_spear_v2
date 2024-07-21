@extends('pages.user.express.index')

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
        <div class="alert text-center py-4 text-light my-3 alert-success">{{ session()->get('success') }}</div>
    @endif
    {{-- <div class="card-header"> --}}
        {{-- <h4>#1</h4> --}}
    {{-- </div> --}}
    <div class="card-body">
        <div class="container">
            <form method="post" action="{{ route('front.express.store') }}" id="shipments_form">
                @csrf
                
                <input type="hidden" name="shop_id" value="{{ $shop->id }}" required />
                {{-- <input type="hidden" name="shipment_status_id" value="{{ $shipment_status_id }}" required /> --}}

                <div data-x-wrapper="shipments">
                    <div data-x-group>
                        {{-- <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success mb-3" data-add-btn>
                                <i class="bi bi-plus-lg"></i>
                            </button>
                            <button type="button" class="btn btn-danger mb-3" id="rmv-btn" data-remove-btn>
                                <i class="bi bi-trash"></i>
                            </button>
                        </div> --}}
            
                        <div class="row">
                            <div class="col-12 my-2 col-md-4">
                                <label>{{ __('Consignee Name') }}</label><span class="text-danger">*</span>
                                <input class="form-control mt-2 ml-2" type="text" name="consignee_name"/>
                                @error('consignee_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2 col-md-4">
                                <label>{{ __('Phone') }}</label><span class="text-danger">*</span>
                                <input class="form-control mt-2 ml-2" 
                                       type="text" 
                                       id="phone_number"
                                       pattern="[0-9]{10}" 
                                       onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                       title="Please Enter Ten Digits"
                                       name="consignee_phone" required/>
                                       
                                @error('consignee_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2 col-md-4">
                                <label>{{ __('Phone') }} 2</label>
                                <input class="form-control mt-2 ml-2" type="number" name="consignee_phone_2" />
                                @error('consignee_phone_2')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        

                            <div class="col-12 my-2 col-md-4">
                                <label class="mb-2 d-inline-block">{{ __('City') }}</label><span class="text-danger">*</span>
                                <select class="form-control mt-2 ml-2" type="text" id="cities-select2" name="consignee_city" required>
                                    @foreach (App\Models\City::get() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('consignee_city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                           

                            <div class="col-12 my-2 col-md-4">
                                <label class="mb-2 d-inline-block">{{ __('Region') }}</label><span class="text-danger">*</span> 
                                <select id="choose-region-select2" class="form-control" name="consignee_region" required> 
                                   
                                </select>
                            </div>

                            <div class="col-12 my-2 col-md-4">
                                <label>{{ __('Order price includes delivery') }}</label><span class="text-danger">*</span>
                                <input class="form-control mt-2 ml-2" type="number" name="order_price" step=".01" required/>
                                @error('order_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                      
                            <div class="col-12 my-2 col-md-4">
                                <label>{{ __('Customer notes') }}</label>
                                <input class="form-control mt-2 ml-2" name="customer_notes" id="" cols="30" rows="3"/>
                                @error('customer_notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 my-2 col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_returned" value="1" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        هل يوجد مرتجع؟
                                    </label>
                                </div>
                            </div>

 
                      
                        
                            

                        </div>
                        <hr>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg my-3" id="save_shipment_btn" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
</div>

{{-- <script src="{{ asset('assets/vendor/jquery/jquery_v3.7.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/jquery.replicate/jquery.replicate.js') }}"></script> --}}
<script src="{{ asset('assets/admin')}}/js/jquery-3.5.1.min.js"></script>
<script>
     function fetchRegions(cityId) 
     {
        var url = "{{ route('admin.delivery_price.get_regions_by_city_id', ['city' => 'CITY_ID_PLACEHOLDER']) }}";
        url = url.replace('CITY_ID_PLACEHOLDER', cityId);

        $.ajax({
            url: url,
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            beforeSend: function() {  
                $('#choose-region-select2').prop('disabled', true);
                $('#save_shipment_btn').addClass('disabled-button');
            },
            complete: function() { 
                $('#choose-region-select2').prop('disabled', false);
                $('#save_shipment_btn').removeClass('disabled-button'); 
            },
            success: function(response) {
                if (response.code == 1) {
                    var regions = response.data;
                    console.log(regions)
                    var regionSelect = $('#choose-region-select2');
                    regionSelect.empty();
                    regionSelect.append('<option value=""></option>'); // Add default empty option
                    $.each(regions, function(index, region) {
                        regionSelect.append('<option value="' + region.id + '">' + region.name + '</option>');
                    });
                } else if (response.code == 0) {
                    alert('Error fetching regions');
                }
            },
            error: function() {
                console.log('An error occurred')
            }
        });
    }

    // const selector ='[data-x-wrapper]';

    // let options = {
    //     disableNaming:'[data-disable-naming]',
    //     wrapper: selector,
    //     group:'[data-x-group]',
    //     addBtn:'[data-add-btn]',
    //     removeBtn:'[data-remove-btn]'
    // };

    // $(selector).replicate(options);
    
    $(document).ready(function() 
    {
        $('#cities-select2').select2();
        $('#choose-region-select2').select2();

        var initialCityId = $('#cities-select2').val();
            if (initialCityId) {
                fetchRegions(initialCityId);
            }

        // Fetch delegates on change event
        $('#cities-select2').on('change', function (e) {
            var cityId = $("option:selected", this).val();
            if (cityId) { 
                fetchRegions(cityId);
            }
        });

    })
   
</script>
@endsection
