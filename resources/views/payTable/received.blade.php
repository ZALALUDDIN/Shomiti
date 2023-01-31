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
                                                    <div class="form-group">
                                                        <label for="">Member Name</label>
                                                        <select class="form-control" name="member" onchange="get_price(this)" id="member_id">>
                                                            <option value="">{{__('-------Select-----')}}</option>
                                                            @forelse($payer as $p)
                                                            <option value="{{$p->id}}">{{$p->name}}</option>
                    
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
                                                    <label for="receipt_no">Receipt No</label>
                                                        <input type="number" class="form-control" name="receipt_no" id="receipt_no">
                                                </div>
                                            </div>
                                            {{-- <div class="form-floating mb-3">
                                                <div class="form-group">
                                                    <label for="fees_month">Fees Month</label> <br>
                                                    <select class="form-control" name="month" id="month">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div> --}}
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
                                                        <select class="form-control" name="month" onChange="get_price(this)" id="member_id">
                                                            <option value=""></option>
                                                        </select>
                                                       </td>
                                                       <td>
                                                           <input type="text" name="price[]" required readonly class="form-control" value="0.00">
                                                       </td>

                                                       <td>
                                                         <div class="btn btn-group">
                                                           <button type="button" class="btn btn-sm btn-primary addBtn">Add</button>
                                                           <button type="button" class="btn btn-sm btn-danger removeBtn">Remove</button>
                                                          </div>
                                                       </td>
                                                   </tr>
                                               </tbody>
                                               <tfoot>
                                                   <tr class="bg-info">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Total</th>
                                                       <th><input type="text" name="total" id="total" class="form-control" readonly required placeholder="Total"  value="0.00"></th>
                                                       <td></td>
                                                   </tr>
                                                   <tr>
                                                       <td colspan="3"></td>
                                                       <th class="text-right text-success">Pay</th>
                                                       <td><input type="text" name="paid" id="paid" class="paidDue form-control" required placeholder="Paid"  value="0.00" onKeyup="get_due()"></td>
                                                       <td></td>
                                                   </tr>
                                                   <tr class="bg-danger">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Due</th>
                                                       <td><input type="text" name="due" id="due" class="paidDue form-control" required readonly placeholder="Due" value="0.00"></td>
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
    (function () {
       
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

		//remove row
		$('body').on('click','.removeBtn' ,function() {
        $(this).parent().parent().parent().remove();
		var total = 0;
			$('.price').each(function(){
				total += parseFloat($(this).val());
				$('#total').val(total.toFixed(2));
			});
		});


	})();

function get_month(v){
	$(v).parent('td').siblings('td').find('select').html('');
	$.ajax({
		url:'{{ route("payment.get_month")}}',
		type: 'GET',
		data: {'id': $(v).val()},

		success: function(data){
			if(data){
				$(v).parent('td').siblings('td').find('select').append("<option value=''> -- Select Month -- </option>");
				for(var i in data)
				$(v).parent('td').siblings('td').find('select').append("<option value='"+data[i].id+"'>"+data[i].month+"</option>");
			}
		}
	});
}
function get_price(v){
	$(v).parent('td').siblings('td').find('.price').html('');
	$.ajax({
		url:'{{ route("payment.get_price")}}',
		type: 'GET',
		data: {'id': $(v).val()},
		success: function(data){
			if(data){
				$(v).parent('td').siblings('td').find('.price').val(data.monthlyPayable);
				var total = 0;
				$('.price').each(function(){
					total += parseFloat($(this).val());
					$('#total').val(total.toFixed(2));
				});
			}
		}
	});
}

	function get_due(){
		var total =$('#total').val();
		var paid =$('#paid').val();
		var due = ((parseFloat(total)-parseFloat(paid))).toFixed(2);
		if (due < 1)
			due = 0;
		$('#due').val(due).toFixed(2);
	}

            </script>



@endsection



