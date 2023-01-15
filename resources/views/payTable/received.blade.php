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


                @php
                    $d=Date("YmdHis");
                    echo RAND(Date("Ymd"),Date("His"));
                @endphp
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
                                                        <select class="form-control" name="member" onchange="get_fees()" id="member_id">>
                                                            <option value="">{{__('-------Select-----')}}</option>
                                                            @forelse($payer as $p)
                                                            <option value="{{$p->id}}">{{$p->name}}</option>
                    
                                                            @empty
                                                                <option value="">{{('No data found!')}}</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-floating mb-3">
                                                    <div class="form-group">
                                                        <label for="year">Year</label> <br>
                                                            <select class="form-control" name="year" id="year">
                                                                <option value="">Select Year</option>
                                                            </select>
                                                    </div>
                                                </div> --}}
                                                <div class="form-floating mb-3">
                                                  <div class="form-group">
                                                    <label for="receipt_no">Receipt No</label>
                                                        <input type="number" class="form-control" name="receipt_no" id="receipt_no">
                                                  </div>
                                                </div>
                                            </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <div class="form-group">
                                                    <label for="is_once">Include One Time Payment (Subscription)</label> <br>
                                                      <select name="is_once" onchange="get_fees()" id="is_once" class="form-control">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                      </select>
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

                                            <table id="invoice" class="table table-striped">
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
                                                           {{-- <select class="form-control inv_cat_id dont-select-me" onchange="get_test(this)" id="year">
                                                            <option value="0"> -- Select Year -- </option>
                                                           </select> --}}
                                                           

                                                       </td>
                                                       <td colspan="2">
                                                           <select class="form-control month" id="month" name="inv_list_id[]" onChange="get_price(this)";>
                                                                   <option value="0"> -- Month Name -- </option>
                                                           </select>
                                                       </td>
                                                       <td>
                                                           <input type="text" name="price[]" required readonly class="form-control price" placeholder="Price" value="0.00">
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
                                                       <th colspan="3" class="text-right">Vat</th>
                                                       <td>
                                                           <div class="input-group">
                                                             <div class="input-group-addon">%</div>
                                                             <input type="text" id="vatParcent" required   class="form-control"name="vat" value="0" onKeyup="vat_discount()">
                                                           </div>
                                                       </td>
                                                       <td><input type="text" id="vat" required class="vatDiscount paidDue form-control" placeholder="Vat" value="0.00" ></td>
                                                       <td></td>
                                                   </tr>
                                                   <tr>
                                                       <th colspan="3" class="text-right">Discount</th>
                                                       <td>
                                                           <div class="input-group">
                                                             <div class="input-group-addon">%</div>
                                                             <input type="text"name="discount"  id="discountParcent" required class=" form-control" value="0" onKeyup="vat_discount()" >
                                                           </div>
                                                       </td>

                                                       <td><input type="text" required id="discount" class="vatDiscount paidDue form-control" placeholder="Discount"  value="0.00" ></td>
                                                       <td></td>
                                                   </tr>
                                                   <tr class="bg-success">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Grand Total</th>
                                                       <th><input type="text" name="grand_total" readonly required  id="grand_total" class="paidDue form-control" placeholder="Grand Total" value="0.00" onKeyup="vat_discount()" ></th>
                                                       <td></td>
                                                   </tr>
                                                   <tr>
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Paid</th>
                                                       <td><input type="text" name="paid" id="paid" class="paidDue form-control" required placeholder="Paid"  value="0.00" onKeyup="get_due()"></td>
                                                       <td></td>
                                                   </tr>
                                                   <tr class="bg-danger">
                                                       <td colspan="3"></td>
                                                       <th class="text-right">Due</th>
                                                       <td><input type="text" name="due" id="due" class="paidDue form-control" required placeholder="Due" value="0.00"></td>
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
        var ddlYears = document.getElementById("year");

        var currentYear = (new Date()).getFullYear();

        for (var i = 2018; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            ddlYears.appendChild(option);
            }
        


            let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var month_selected = (new Date).getMonth(); // current month
            var option = '';
            option = '<option>Select Month</option>'; // first option

            for (let i = 0; i < months.length; i++) {
                let month_number = (i + 1);

                let month = (month_number <= 9) ? '0' + month_number : month_number;

                let selected = (i === month_selected ? ' selected' : '');
                option += '<option value="' + month + '"' + selected + '>' + months[i] + '</option>';
            }
            document.getElementById("month").innerHTML = option;



        		//   STARTS OF DYNAMIC FORM
		//#------------------------------------
		//add row
		var body      = $('#invoice > tbody');
		$('body').on('click','.addBtn' ,function() {

			$('#invoice > tbody >tr:last').clone().insertAfter('#invoice > tbody >tr:last');
			$("#invoice > tbody >tr:last input[type='text']").val('');
			$("#invoice > tbody >tr:last .month").html('');
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

function get_test(v){
	$(v).parent('td').siblings('td').find('select').html('');
	$.ajax({
		url:'',
		type: 'GET',
		data: {'id': $(v).val()},

		success: function(data){
			if(data){
				$(v).parent('td').siblings('td').find('select').append("<option value=''> -- Investigation Name -- </option>");
				for(var i in data)
				$(v).parent('td').siblings('td').find('select').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
			}
		}
	});
}
function get_price(v){
	$(v).parent('td').siblings('td').find('.price').html('');
	$.ajax({
		url:'',
		type: 'GET',
		data: {'id': $(v).val()},
		success: function(data){
			if(data){
				$(v).parent('td').siblings('td').find('.price').val(data.price);
				var total = 0;
				$('.price').each(function(){
					total += parseFloat($(this).val());
					$('#total').val(total.toFixed(2));
					$('#grand_total').val(total.toFixed(2));
				});
			}
		}
	});
}
	function vat_discount(){
		var total = $('#total').val();
		var vatParcent = $('#vatParcent').val();
		$('#vat').val(parseFloat((total * vatParcent)/100).toFixed(2));
		//vat in discount
		var discountParcent = $('#discountParcent').val();
		$('#discount').val(parseFloat((total * discountParcent)/100).toFixed(2));
		//grand total
		var vat = $('#vat').val();
		var discount = $('#discount').val();
		$('#grand_total').val(((parseFloat(total)+parseFloat(vat)-parseFloat(discount))).toFixed(2));
	}

	function get_due(){
		var grand_total =$('#grand_total').val();
		var paid =$('#paid').val();
		var due = ((parseFloat(grand_total)-parseFloat(paid))).toFixed(2);
		if (due < 1)
			due = 0;
		$('#due').val(due).toFixed(2);
	}


            </script>



@endsection



