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
                                <div class="col-lg-4">
                                    <a href="{{route('payment.index')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> List of Reveived</a>
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
                                        <form id="paymentReceiveForm" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')

                                        <div class="row mt-4">
                                            <div class="form-group">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#SL</th>
                                                            <th>Name</th>
                                                            <th>Mobile No</th>
                                                            <th>Email</th>
                                                            <th>Payment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($payer as $p)
                                                        <tr>
                                                            <td>{{++$loop->index}}</td>
                                                            <td>{{$p->name}}</td>
                                                            <td>{{$p->phone}}</td>
                                                            <td>{{$p->email}}</td>
                                                            <td><a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">৳ Collection</a></td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="2">{{('No data found!')}}</td>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
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
    </div>
</div> 


  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="payment-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Payment data will be inserted here -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Payment</button>
                </div>
            </div>
        </div>
    </div>
    
      
  

      <script>
          const myModal = document.getElementById('myModal')
          const myInput = document.getElementById('myInput')
          
        //   myModal.addEventListener('shown.bs.modal', () => {
        //       myInput.focus()
        //     })
        $(document).on("click", ".btn-success", function () {
            var name = $(this).closest("tr").find("td:eq(1)").text();
            var email = $(this).closest("tr").find("td:eq(2)").text();
            var phone = $(this).closest("tr").find("td:eq(3)").text();
            
            // Make AJAX call to fetch payment data for this user
            $.ajax({
                url: "http://127.0.0.1:8000/payer?page=" + page,
                type: "GET",
                data: {
                    name: name,
                    email: email,
                    phone: phone
                },
                success: function (response) {
                    // Update the table with the payment data
                    $("#payment-table tbody").html(response);
                }
            });
        });

        </script>


@endsection



