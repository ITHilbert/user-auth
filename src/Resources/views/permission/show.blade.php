@extends('customer::layouts.userauth')

@section('title', Lang::get('customer::customer.header_show'))

{{-- @section('content_header')
@stop --}}

@section('content')
<j-card title="@lang('customer::customer.header_show')">
<div>
    @include('include.message')
        <div class="form-group row mb-2">
            <label for="customer_type_id" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.customer_type_id')</label>
            <div class="col-md-6">
            <txt>{{ $customer->getCustomerTypeText() }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2" id="divFirma1">
            <label for="company_row_1" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.company_row_1')</label>
            <div class="col-md-6">
                <txt>{{ $customer->company_row_1 }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2" id="divFirma2">
            <label for="company_row_2" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.company_row_2')</label>
            <div class="col-md-6">
                <txt>{{ $customer->company_row_2 }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="address_id" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.address_id')</label>
            <div class="col-md-6">
                <txt>{{ $customer->getNameAddressText() }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="titel" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.titel')</label>
            <div class="col-md-6">
                <txt>{{ $customer->titel }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.first_name')</label>
            <div class="col-md-6">
                <txt>{{ $customer->first_name }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.last_name')</label>
            <div class="col-md-6">
                <txt>{{ $customer->last_name }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="street" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.street')</label>
            <div class="col-md-6">
                <txt>{{ $customer->street }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="postcode" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.postcode')</label>
            <div class="col-md-6">
                <txt>{{ $customer->postcode }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="city" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.city')</label>
            <div class="col-md-6">
                <txt>{{ $customer->city }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="country" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.country')</label>
            <div class="col-md-6">
                <txt>{{ $customer->country }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="getInvoiceTypeText" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.invoice_type')</label>
            <div class="col-md-6">
                <txt>{{ $customer->getInvoiceTypeText() }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2" id="divUStID">
            <label for="ustid" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.ustid')</label>
            <div class="col-md-6">
                <txt>{{ $customer->ustid }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.phone')</label>
            <div class="col-md-6">
                <txt>{{ $customer->phone }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="mobile" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.mobile')</label>
            <div class="col-md-6">
                <txt>{{ $customer->mobile }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="fax" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.fax')</label>
            <div class="col-md-6">
                <txt>{{ $customer->fax }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.email')</label>
            <div class="col-md-6">
                <txt>{{ $customer->email }}</txt>
            </div>
        </div>



        <div class="form-group row mb-2">
            <label for="web" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.web')</label>
            <div class="col-md-6">
                <txt>{{ $customer->web }}</txt>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="hourly_rate" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.hourly_rate')</label>
            <div class="col-md-6">
                <euro value="{{ $customer->hourly_rate }}" />
            </div>
        </div>


        <div class="form-group row mb-2">
            <label for="mileage_allowance" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.mileage_allowance')</label>
            <div class="col-md-6">
                <euro value="{{ $customer->mileage_allowance }}" />
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="comment" class="col-md-4 col-form-label text-md-right">@lang('customer::customer.comment')</label>
            <div class="col-md-6">
                <txt>{{ $customer->comment }}</txt>
            </div>
        </div>


        <div class="form-group row mb-2">
            <div class="col-md-4 text-right">
                <button-back route="{{ route('customer.list') }}">@Lang('master.btn-back')</button-back>
            </div>
            <div class="col-md-6 text-left">
                <button-edit route="{{ route('customer.edit', $customer->id) }}" >@lang('master.btn-edit')</button-save>
            </div>
        </div>

</div>
</j-card>
@stop

@section('adminlte_css')
@stop

@section('adminlte_js')
    <script src="{{ asset('js/customer.js') }}" ></script>
@stop
