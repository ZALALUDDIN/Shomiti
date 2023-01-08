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
                                  <li class="breadcrumb-item active">MemberList</li>
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
                                  <a href="{{route('asd.create')}}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Member</a>
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
                                          <th style="width: 20px;">
                                              <div class="form-check">
                                                  <input type="checkbox" class="form-check-input" id="customCheck1">
                                                  <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                              </div>
                                          </th>
                                          <th>#SL.</th>
                                          <th>Name</th>
                                          <th>Phone</th>
                                          <th>Email</th>
                                          <th>Register Date</th>
                                          <th>Status</th>
                                          <th style="width: 75px;">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($member as $m)
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <input type="checkbox" class="form-check-input" id="customCheck2">
                                                  <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                              </div>
                                          </td>
                                          <td>{{ ++$loop->index}}</td>
                                          <td>{{$m->name}}</td>
                                          <td>{{$m->phone}}</td>
                                          <td>{{$m->email}}</td>
                                          <td>{{$m->date}}</td>
                                          <td>
                                              @if ($m->status === 1)
                                              <span class="badge badge-success-lighten">Active</span>
                                              @else                                   
                                                  <span class="badge badge-danger-lighten">Blocked</span>
                                              
                                              @endif
                                          </td>
                                          <td class="d-flex">
                                              <a href="#" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i>
                                              </a>
                                              <form action="#" method="POST">
                                                  @csrf
                                                  @method('delete')
                                                  <button class="btn action-icon"><i class="mdi mdi-delete"></i></button>
                                              </form>
                                          </td>
                                      </tr>
                                  
                                      @empty
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

@endsection

