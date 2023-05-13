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
                                  <a href="{{route('payment.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Make Payment</a>
                              </div>
                              <div class="col-sm-8">
                                  <div class="text-sm-end">
                                      <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog"></i></button>
                                      <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                      <button type="button" class="btn btn-light mb-2">Export</button>
                                  </div>
                              </div><!-- end col-->
                          </div>

                          <div class="table-responsive">
                              @if(Session::has('response'))
                              {!!Session::get('response')['message']!!}
                              @endif
                              <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th>#SL.</th>
                                        <th>Member Name</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Payment Date</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pay as $m)
                                    <tr>
                                        <td>{{ ++$loop->index}}</td>
                                        <td>{{$m->member->name}}</td>
                                        <td>{{$m->year->year}}</td>
                                        <td>{{$m->month->month}}</td>
                                        <td>{{$m->amount}}</td>
                                        <td>
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#dueModal{{$m->id}}">{{$m->due}}</button>
                                            <!-- Add a modal for each row with a unique ID -->
                                            <div class="modal fade" id="dueModal{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="dueModalLabel{{$m->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="dueModalLabel{{$m->id}}">Due Amount for {{$m->month->month}}  {{$m->year->year}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Due Amount: {{$m->due}}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if(!$m->isPaid())
                                                            <form action="{{route('payments.update', $m)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary">Pay</button>
                                                            </form>
                                                            @else
                                                            <p>Paid</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>{{$m->paymentDate}}</td>
                                    
                                         <td class="d-flex">
                                                <a class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="tooltip" title="" href="{{ route('payment.edit', $m->id) }}" data-bs-original-title="Edit User">
                                                    <span class="btn-inner">
                                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                              
                                              <form id="form{{$m->id}}" action="{{ route('payment.destroy',$m->id) }}" method="POST">
                                                  @csrf
                                                  @method('delete')
                                                  <button class="btn btn-sm btn-icon text-danger">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg></button>
                                              </form>
                                          </td>
                                        </tr>
                                            @empty
                                        <tr>
                                            <td colspan="9">No data found.</td>
                                        </tr>
                                      <tr>
                                          <td colspan="8">
                                              <div class="form-check">
                                                  <input type="checkbox" class="form-check-input" id="customCheck2">
                                                  <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                              </div>
                                          </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
     //
</script>

@endsection

