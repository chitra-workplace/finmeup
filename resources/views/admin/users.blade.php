@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users </li>
      </ol>
    </section>
   <!-- Main content -->
   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
          
            <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Users List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       {{ csrf_field() }}
                      <table class="table table-bordered">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact No.</th>
                          <th>Status</th>
                          <th>Registered At</th>
                          <th>Action</th>
                        </tr>
                          <?php if(!empty(@$users)){
                            foreach ($users as $key => $value) { 
                             $srno =  $key+1; ?>
                                <tr>
                                  <td>{{ $srno }}</td>
                                  <td>{{ ucfirst(@$value->name) }}</td>
                                  <td>{{ @$value->email }}</td>
                                  <td>{{ @$value->contact_no }}</td>
                                  <td>
                                    <!-- <div class="progress progress-xs">
                                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div> -->
                                    <?php 
                                    $status  = "Active"; $class = "bg-green";
                                    if(@$value->status == 2){
                                      $status  = "Inactive"; $class = "bg-red";
                                    } ?>
                                    <span class="badge {{$class}}">{{ $status }}</span>
                                  </td>
                                  <td>{{ date('j M Y',strtotime(@$value->created_at)) }}</td>
                                  <td>
                                    <a class="btn btn-xs bg-purple">
                                      Submitted Quiz
                                    </a>
                                     <a class="btn btn-xs bg-olive">
                                      Favourite Post
                                    </a>
                                  </td>
                                </tr>
                          <?php  }
                          } else { ?> 
                            <tr><td colspan="8"> Record Not Found...! </td></tr>
                          <?php } ?>
                          
                       
                       
                      </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                      <!-- <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                      </ul> -->
                    </div>
            </div>
        </div>
    </section>
  </div>
</div>
@endsection
