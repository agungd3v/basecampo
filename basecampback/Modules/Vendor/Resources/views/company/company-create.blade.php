@extends('vendor::layouts.master')
@section('company', 'active')
@section('company-create', 'active')

@section('content')
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Add Company</h3>
        <p class="text-subtitle text-muted">Lorem ipsum dolor sit amet</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Company</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card">
      <div class="card-body">
        <form class="form form-vertical" action="{{ route('vendor.company.store') }}" method="POST">
          @csrf
          <div class="form-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name">Company Name</label>
                  <input type="text" id="name" class="form-control" name="name" placeholder="Company Name" autocomplete="off">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="phone">Company Phone</label>
                  <input type="number" id="phone" class="form-control" name="phone" placeholder="Company Phone" autocomplete="off">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="address">Company Address</label>
                  <textarea id="address" name="address"></textarea>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
<script>
  $('#address').summernote({
    tabsize: 2,
    height: 240,
  })
</script>
@endpush
