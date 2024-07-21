@extends('pages.user.express.index')

@section('expressContent')
<style>
    #shipments_form>div>div:nth-child(1)>div>#rmv-btn {
        visibility: hidden !important;
    }
</style>
<style>
    
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
{{-- <h2 class="mb-4">{{ __('Edit') }} {{ __('Shipping.') }} #{{ $shipment->id }} </h2> --}}
    <h2 class="mb-4">تعديل شحنة رقم <span class="text-success">#{{ $shipment->id }}</span> للمتجر <span class="text-success">{{ $shipment->shop->name }}</span></h2>


<div class="card">
    @if (session()->has('error'))
    <div class="alert text-center py-4 my-3 alert-danger">{{ session()->get('error') }}</div>
    @endif
    @if (session()->has('success'))
    <div class="alert text-center py-4 my-3 alert-success">{{ session()->get('success') }}</div>
    @endif
    {{-- <div class="card-header">
        <h4>#1</h4>
    </div> --}}
    <div class="card-body">
        <div class="container">
            <form method="post" action="{{ route('front.express.update',['shipment'=>$shipment->id]) }}" id="shipments_form">
                @csrf

                <div class="row">
                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Consignee Name') }}</label>
                        <input class="form-control mt-2 ml-2" type="text" name="consignee_name" value="{{ $shipment->consignee_name }}"/>
                        @error('consignee_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Phone') }}</label><span class="text-danger">*</span>
                        <input class="form-control mt-2 ml-2" type="text" id="phone_number" pattern="[0-9]{10}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" title="Please Enter Ten Digits" name="consignee_phone" value="{{ $shipment->consignee_phone }}" required />
                        @error('consignee_phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Phone') }} 2</label>
                        <input class="form-control mt-2 ml-2" type="number" name="consignee_phone_2" value="{{ $shipment->consignee_phone_2 }}"/>
                        @error('consignee_phone_2')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('City') }}</label><span class="text-danger">*</span>
                        <select class="form-control mt-2 ml-2" type="text" name="consignee_city" id="cities-select2" required>
                            @foreach (App\Models\City::get() as $city)
                            <option value="{{ $city->id }}" <?=$shipment->consignee_city == $city->id ? 'selected' : '' ?>>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('consignee_city')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2 col-md-4">
                        <label class="mb-2 d-inline-block">{{ __('Region') }}</label><span class="text-danger">*</span> 
                        <select id="choose-region-select2" class="form-control" name="consignee_region" required>
                            @if($regions->isNotEmpty())
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" <?= ($shipment->consignee_region == $region->id) ? 'selected' : ''?>>{{ $region->name }}</option> 
                                @endforeach
                            @endif
                        </select>
                        @error('consignee_region')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Order price includes delivery') }}</label><span class="text-danger">*</span>
                        <input class="form-control mt-2 ml-2" type="number" name="order_price" step=".01" value="{{ $shipment->order_price }}" required />
                        @error('order_price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>




                    <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Customer notes') }}</label>
                        <input class="form-control mt-2 ml-2" name="customer_notes" value="{{ $shipment->customer_notes }}" id="" cols="30" rows="3" />
                        @error('customer_notes')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="col-12 my-2 col-md-4">
                        <label>{{ __('Delegate notes') }}</label>
                        <input class="form-control mt-2 ml-2" name="delegate_notes" value="{{ $shipment->delegate_notes }}" id="" cols="30" rows="3" />
                        @error('delegate_notes')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}




                </div>
                <hr>


                <button class="btn btn-primary btn-lg my-3" type="submit">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
</div>


@endsection

@push('js') 
    {{-- <script src="{{ asset('assets/admin')}}/js/jquery-3.5.1.min.js"></script> --}}
    <script>
        function fetchDelegates(cityId) 
        {
            var url = "{{ route('admin.delegates.get_delegates_by_city_id', ['city' => 'CITY_ID_PLACEHOLDER']) }}";
            url = url.replace('CITY_ID_PLACEHOLDER', cityId);
            var delegateSelect = $('#choose-delegate-select2');

            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() { 
                    $('#choose-delegate-select2').prop('disabled', true);
                    $('#save_shipment_btn').addClass('disabled-button');
                },
                complete: function() { 
                    $('#choose-delegate-select2').prop('disabled', false);
                    $('#save_shipment_btn').removeClass('disabled-button');
                },
                success: function(response) {
                    
                    if (response.code == 1) {
                        var delegates = response.data;
                        delegateSelect.empty();
                        delegateSelect.append('<option value=""></option>'); // Add default empty option
                        $.each(delegates, function(index, delegate) 
                        { 
                            delegateSelect.append('<option value="' + delegate.id + '">' + delegate.name + '</option>');
                        });
                    } else if (response.code == 0) {
                        delegateSelect.empty();
                        alert(response.msg);
                    }
                },
                error: function() {
                    delegateSelect.empty();
                    console.log(response.msg)
                }
            });
        }

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
            
            $('#choose-region-select2').select2();  
            $('#cities-select2').select2();

            // Fetch delegates on change event
            $('#cities-select2').on('change', function (e) {
                var cityId = $("option:selected", this).val();
                if (cityId) { 
                    fetchRegions(cityId);
                }
            });
        
        });
    </script>

@endpush