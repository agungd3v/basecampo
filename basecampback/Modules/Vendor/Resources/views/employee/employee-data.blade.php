@extends('vendor::layouts.master')
@section('employee', 'active')

@section('content')
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Employee</h3>
        <p class="text-subtitle text-muted">Lorem ipsum dolor sit amet</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card">
      <div class="card-header pb-2">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#border-less">Create Employee</button>
      </div>
      <div class="card-body">
        {!! $html->table() !!}
      </div>
    </div>
  </section>
  <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Employee</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="{{ route('vendor.employee.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name">Employee Name</label>
                  <input type="text" id="name" class="form-control" name="name" placeholder="Employee Name" autocomplete="off">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="email">Employee Email</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder="Employee Email" autocomplete="off">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="password">Employee Password</label>
                  <input type="password" id="password" class="form-control" name="password" placeholder="Employee Password">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="company">Company Name</label>
                  <select name="company" onchange="getDivision(this)" id="company" class="form-control">
                    <option value="" selected>Select Company</option>
                    @foreach ($company as $cmp)
                      <option value="{{ $cmp->id }}">{{ $cmp->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="division">Division Name</label>
                  <select name="division" id="division" class="form-control" disabled>
                    <option value="">Select Division</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Submit</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
{!! $html->scripts() !!}
<script>
  function getDivision(data) {
    const division = document.getElementById('division')
    division.setAttribute('disabled', true)
    division.innerHTML = '<option value="" selected>Select Division</option>'
    if (data.value != '') {
      fetch('/api/vendor/division', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          company: data.value
        })
      }).then(req => req.json()).then(res => {
        if (res.status) {
          res.message.forEach(dt => {
            division.innerHTML += `<option value="${dt.id}">${dt.name}</option>`
          })
          division.removeAttribute('disabled')
        }
      })
    }
  }
</script>
@endpush
