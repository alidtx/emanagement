@extends('layouts.app')
@section('title', 'Company Profile')
@section('content')
    <div class="content-wrapper">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Company Profile</h6>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'company_profile_update', 'method' => 'POST', 'files' => true]) !!}

                    @isset($company->logo)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label required" for="logo"> Upload Site Logo</label>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Site Logo" width="150px"
                                    height="150px">
                            </div>
                        </div>
                    @endisset
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="logo">Upload Site Logo (Only PNG)</label>
                        <div class="col-sm-10">
                            {!! Form::file('logo', [
                                'placeholder' => 'Upload Site Logo',
                                'id' => 'logo',
                                'class' => 'form-control',
                                'accept' => 'image',
                            ]) !!}
                        </div>
                    </div>
                    @isset($company->favicon)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label required" for="fevicon"> Upload Fevicon Logo</label>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/' . $company->favicon) }}" alt="Fevicon Logo" width="150px"
                                    height="150px">
                            </div>
                        </div>
                    @endisset
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="favicon">Upload Fevicon Logo</label>
                        <div class="col-sm-10">
                            {!! Form::file('favicon', [
                                'placeholder' => 'Upload favicon Logo',
                                'id' => 'favicon',
                                'class' => 'form-control',
                                'accept' => 'image',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="fevicon">Color</label>
                        <div class="col-sm-10">
                            <input type="color" id="color" name="color" class="form-control" value="{{$company->color ?? null}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Update </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
