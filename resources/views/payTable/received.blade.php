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
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <div class="form-group">
                                                        <label for="">Member Name</label>
                                                        <select class="form-control" name="member" onchange="get_price(this)" id="member_id">>
                                                            <option value="">{{__('-------Select-----')}}</option>
                                                            @forelse($payer as $p)
                                                            <option payable_amount="{{$p->monthlyPayable}}" value="{{$p->id}}">{{$p->name}}</option>
                    
                                                            @empty
                                                                <option value="">{{('No data found!')}}</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <div class="form-group">
                                                    <label for="receipt_no">Receipt NUmber</label>
                                                        <input type="number" class="form-control" name="receipt_no" id="receipt_no" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                            <table id="payment" class="table table-striped text-white">
                                               <thead>
                                                   <tr class="bg-primary">
                                                       <th colspan="2">Payment Year</th>
                                                       <th colspan="2">Month Name</th>
                                                       <th width="120">Payable</th>
                                                       <th width="160">Add / Remove</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <tr>
                                                       <td colspan="2">
                                                        <select class="form-control" name="year" onChange="get_month(this)" id="year">
                                                            <option value="">{{__('-------Select-----')}}</option>
                                                            @forelse($year as $y)
                                                            <option value="{{$y->id}}">{{$y->year}}</option>
                    
                                                            @empty
                                                                <option value="">{{('No year found!')}}</option>
                                                            @endforelse
                                                        </select>
                                                           

                                                       </td>
                                                       <td colspan="2">
                                                        <select class="form-control" name="month" onchange="get_total()";>
                                                            <option value=""></option>
                                                        </select>

                                                       </td>
                                                       <td>
                                                           <input type="text" name="price[]" required readonly  class="form-control price" value="0">
                                                       </td>

                                                       <td>
                                                         <div class="btn btn-group">
                                                           <button type="button" class="btn btn-sm btn-primary addBtn" disabled>Add</button>
                                                           <button type="button" class="btn btn-sm btn-danger removeBtn" disabled>Remove</button>
                                                          </div>
                                                       </td>
                                                   </tr>
                                               </tbody>
                                               <tfoot>
                                                   <tr class="bg-info">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Total</th>
                                                       <th><input type="text" name="total" id="total" class="form-control" readonly required value="0"></th>
                                                       <td></td>
                                                   </tr>
                                                   <tr>
                                                       <td colspan="3"></td>
                                                       <th class="text-right text-success">Pay</th>
                                                       <td><input type="text" name="paid" id="paid" class="paidDue form-control" required placeholder="Paid"  value="0" onKeyup="get_due()"></td>
                                                       <td></td>
                                                   </tr>
                                                   <tr class="bg-danger">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Due</th>
                                                       <td><input type="text" name="dueAmount" id="due" class="paidDue form-control" required readonly placeholder="Due" value="Paid"></td>
                                                       <td></td>
                                                   </tr>

                                               </tfoot>
                                           </table>
                                       </div>
                                            
                                    </div>
                                </div>
                            </div>





                                        <div class="row justify-content-center mt-4">
                                            <div class="d-flex justify-content-around" style="width:15rem; ">

                                                <button class="btn btn-warning text-center justify-content-center" type="reset">{{__('Reset')}} </button>
                                                
                                                <button class="btn btn-primary text-center justify-content-center" type="submit">{{__('Submit')}} </button>
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

<script>
    
    $(document).ready(function() {
        //   STARTS OF DYNAMIC FORM
		//#------------------------------------
		//add row
		var body      = $('#payment > tbody');
		$('body').on('click','.addBtn' ,function() {

			$('#payment > tbody >tr:last').clone().insertAfter('#payment > tbody >tr:last');
			$("#payment > tbody >tr:last input[type='text']").val('');
			$("#payment > tbody >tr:last .month").html('');
			//$('.select2').select2();
		});
        
        $(document).on("change","#paymentReceiveForm select[name='month']",function(){
            var payableAmount = $("#paymentReceiveForm select[name='member'] option:selected").attr('payable_amount');
           $("#paymentReceiveForm input[name='price[]']").val(payableAmount)
        })
		//remove row
		$('body').on('click','.removeBtn' ,function() {
        $(this).parent().parent().parent().remove();
        });
	});


    const get_total = () => {
        var total = 0;
        $('.price').each(function(){
            total += parseFloat($(this).val());
            $('#total').val(total);
        });
    }

function get_month(v){
    $(v).parent('td').siblings('td').find('select').html('');
    $.ajax({
        url:'{{ route("payment.get_month")}}',
        type: 'GET',
        data: {'id': $(v).val()},

        success: function(data){
            if(data){
                $(v).parent('td').siblings('td').find('select').append("<option value=''> -- Select Month -- </option>");
                for(var i in data) {
                    var monthPaid = data[i].paid;
                    var month = data[i].month;
                    var option = "<option value='"+data[i].id+"'>"+month+"</option>";
                    if (monthPaid) {
                        option = "<option value='"+data[i].id+"' disabled>"+month+" (Already Paid)</option>";
                    }
                    $(v).parent('td').siblings('td').find('select').append(option);
                }
            }
        }
    });
}



function payment(v) {
    var year = $(v).val();
    var member_id = $('#member_id').val();
    $.ajax({
        url: "{{ route('check-payment') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            year: year,
            member_id: member_id
        },
        success: function(response) {
            if(response.message === 'paid') {
                $(v).parent('td').siblings('td').find('select').html('');
                alert('This month is already paid.');
            } else {
                $(v).parent('td').siblings('td').find('select').html('');
                if(response){
                    $(v).parent('td').siblings('td').find('select').append("<option value=''> -- Select Month -- </option>");
                    for(var i in response) {
                        var monthPaid = response[i].paid;
                        var month = response[i].month;
                        var option = "<option value='"+response[i].id+"'>"+month+"</option>";
                        if (monthPaid) {
                            option = "<option value='"+response[i].id+"' disabled>"+month+" (Already Paid)</option>";
                        }
                        $(v).parent('td').siblings('td').find('select').append(option);
                    }
                }
            }
        }
    });
}






	function get_due(){
		var total =$('#total').val();
		var paid =$('#paid').val();
		var due = ((parseFloat(total)-parseFloat(paid)));
		if (due < 1)
			due = 0;
		$('#due').val(due);
	}
</script>



@endsection



