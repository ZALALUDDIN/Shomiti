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
                                    <li class="breadcrumb-item active">Payment</li>
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
                                    <a href="{{route('asd.index')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> List of Reveived</a>
                                </div>
                                <h4 class="header-title">Make Payment</h4>
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
                                                    <select class="form-control select2" data-toggle="select2" name="member">
                                                        <option value="">{{__('Select Name')}}</option>
                                                        @forelse($payer as $p)
                                                        <option value="{{$p->id}}">{{$p->name}}</option>
                
                                                        @empty
                                                            <option value="">{{('No data found!')}}</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="monthName" id="">
                                                        <option value="">Select Month</option>
                                                        <option value="January">January </option>
                                                        <option value="February">February </option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" name="payAmount" value="{{ old('payAmount')}}">
                                                    <label for="floatingInput">{{__('Amount')}}</label>
                                                </div>
                                            </div>
                                        
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="category" id="">
                                                        <option value="">Select Payment Category</option>
                                                        <option value="1">Registration Fee</option>
                                                        <option value="2">Monthly Fee</option>
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" id="year" name="year">
                                                        <option value="">Select Year</option>
                                                    </select>
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

<script>
    (function () {
        var ddlYears = document.getElementById("year");

        var currentYear = (new Date()).getFullYear();

        for (var i = 2018; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            ddlYears.appendChild(option);
            }
        })();
            </script>

@endsection


