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
                                  <li class="breadcrumb-item active">ReceivedList</li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>     
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="row mb-2">
                              <div class="col-sm-4">
                                  <a href="#" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Reports </a>
                              </div>
                              <div class="col-sm-8">
                                  <div class="text-sm-end">
                                      <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                      <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                      <button type="button" class="btn btn-light mb-2">Export</button>
                                  </div>
                              </div><!-- end col-->
                          </div>


                          
                            <label for="start-date">Start Date:</label>
                            <input class="onlydatepicker" type="date" id="start-date">

                            <label for="end-date">End Date:</label>
                            <input class="onlydatepicker" type="date" id="end-date">

                          <div id="printable-area" class="table-responsive print-info">
                              @if(Session::has('response'))
                              {!!Session::get('response')['message']!!}
                              @endif
                              
                              <table class="table table-centered table-striped dt-responsive nowrap w-100 print" id="products-datatable">
                                  <thead>
                                      <tr>
                                          <th>#SL.</th>
                                          <th>Payment Date</th>
                                          <th>Name</th>
                                          <th>Year</th>
                                          <th>Month</th>
                                          <th>Amounts</th>
                                      </tr>
                                </thead>
                                <tbody id="report-data">

                                </tbody>
                                <tfoot class="h4">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total : </td>
                                        <td><span id="total-amount"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                          </div>
                          <button class="btn btn-warning" onclick="printContent()">Print Report</button>
                      </div> 
                  </div> 
                </div>
           </div>
          </div>

      </div>
  </div>
</div>

<script>
    $(document).ready(function () {
    load_data();

    function load_data(page) {
        var start_date = $("#start-date").val();
        var end_date = $("#end-date").val();
        $.ajax({
            url: "http://127.0.0.1:8000/report?page=" + page,
            type: "GET",
            data: { "start-date": start_date, "end-date": end_date },
            success: function (data) {
                var html = "";
                var total = 0;
                $.each(data.data, function (index, value) {
                    html += "<tr>"+
                                "<td>" + value.id + "</td>"+
                                "<td>" + value.paymentDate + "</td>"+
                                "<td>" + value.name + "</td>"+
                                "<td>" + value.year + "</td>"+
                                "<td>" + value.month + "</td>"+
                                "<td>" + value.amount + "</td>"+
                            "</tr>";
                    total += parseFloat(value.amount);
                });
                $("#report-data").html(html);
                $("#total-amount").text(total);

                // add pagination links
                var paginationLinks = data.links;
                $(".pagination").html(paginationLinks);
            }
        });
    }

    // listen for changes in the date inputs
    $("#start-date, #end-date").on("change", function () {
        load_data();
    });
});



function printContent() {
  var content = document.getElementById("printable-area").innerHTML;
  var myWindow = window.open('', '', 'width=1300, height=600');
  myWindow.document.write('<html><head><title>Report Print</title>');
  // add a CSS stylesheet to maintain the table format
  myWindow.document.write('<style>table, th, td {text-align: center; padding:10px; border: 1px solid black; border-collapse: collapse;}</style>');
  // add a @media print rule to center the table on the printed page
  myWindow.document.write('<style>@media print { table, h2, p { margin: 0 auto; l ine-height: 0.5in; } }</style>');
  myWindow.document.write('</head><body style="align:center"; margin-top: 0.5in;>');
  myWindow.document.write('<h2 style="text-align:center">সমিতি মেনেজমেন্ট সিস্টেম</h2><br>'+
                          '<p style="text-align:center">This is the report as you want</p><hr>')
  myWindow.document.write(content);
  myWindow.document.write('</body></html>');
  myWindow.document.close();
  myWindow.focus();
  myWindow.print();
  myWindow.close();
}

</script>

@endsection

