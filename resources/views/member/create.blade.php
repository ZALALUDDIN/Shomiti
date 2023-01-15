@extends('master')
@section('content')

<div class="container-fluid">
    <div class="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Table</a></li>
                                    <li class="breadcrumb-item active">addMember</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-sm-4">
                                    <a href="{{route('asd.index')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> List of Members</a>
                                </div>
                                <h4 class="header-title">Add New Members</h4>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li class="invalid-tooltips">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="floating-preview">
                                        <form action="{{ route('asd.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')

                                        <div class="row mt-4">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    @error('FullName')
                                            <div class="invalid-tooltip">{{$message}}</div>
                                            @enderror
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="John Duo" required name="FullName" value="{{ old('FullName')}}">
                                                    <label for="floatingInput">{{__('Full Name')}}:</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="EmailAddress" value="{{ old('EmailAddress')}}">
                                                    <label for="floatingInput">Email address</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" name="reg" value="{{ old('reg')}}">
                                                    <label for="floatingInput">Registration Fee</label>
                                                </div>
                                            
                                            </div>
                                        
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="+88-018-000-000" name="PhoneNumber" value="{{ old('PhoneNumber')}}">
                                                    <label for="floatingInput">{{__('Phone')}}</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" name="monthly" value="{{ old('monthly')}}">
                                                    <label for="floatingInput">Monthly Payable</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="date" class="form-control" id="floatingInput" name="date" value="{{ old('date')}}">
                                                    <label for="floatingInput">{{__('Date')}}</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row justify-content-center mt-4">
                                            <div class="d-flex justify-content-around" style="width:15rem; ">

                                                <button class="btn btn-warning text-center justify-content-center" type="reset">{{__('Reset')}} </button>
                                                
                                                <button class="btn btn-primary text-center justify-content-center" type="submit">{{__('Create')}} </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
</div>

@endsection