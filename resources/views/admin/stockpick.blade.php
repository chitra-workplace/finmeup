@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Stock Picks
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stock Picks </li>
      </ol>
    </section>
   <!-- Main content -->
   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
          
            <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Stock Pick List</h3>
                      <a class="btn btn-xs btn-primary pull-right" href="{{url('admin/poststock')}}">Post New Stock</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                       {{ csrf_field() }}
                      <table class="table table-bordered">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Category</th>
                          <th>Stock Pick</th>
                          <th>Stock Name</th>
                          <th>Listed In</th>
                          <th>Market Price</th>
                          <th>Target Price</th>
                          <th>Status</th>
                          <th>Posted At</th>
                          <th>Action</th>
                        </tr>
                          <?php if(count(@$stock) > 0){
                            foreach ($stock as $key => $value) { 
                               $url = \URL::To('public/icon').'/default_comp_logo.png';
                               if(!empty($value->image)){
                                $url = url($value->image);
                               }
                               $srno =  $key+1; ?>
                                <tr>
                                  <td>{{ $srno }}</td>
                                  <td>{{__('finmeup_leng.stock_category.'.@$value->category)}}</td>
                                  <td> <img class="blah" src="{{ $url }}" style="width: 50px;" ></td>
                                  <td>{{ ucfirst(@$value->stock_name) }}</td>
                                  <td>{{ ucfirst(@$value->listed_in) }}</td>
                                  <td>{{ ucfirst(@$value->current_market_price) }}</td>
                                  <td>{{ ucfirst(@$value->target_price) }}</td>
                                  <td>
                                    <?php 
                                    $status  = "Active"; $class = "btn-success";
                                    $ostatus = "Inactive"; $stval = 2;
                                    if(@$value->status == 2){
                                      $status  = "Inactive"; $class = "btn-danger"; $ostatus = "Active"; $stval = 1;
                                    } ?>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-xs {{$class}}  btn-flat">{{$status}}</button>
                                      <button type="button" class="btn btn-xs {{$class}}  btn-flat dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url('admin/change_stock_status').'/'.@$value->id.'/'.$stval}}">{{ $ostatus }}</a></li>
                                      </ul>
                                    </div>
                                  </td>
                                  <td>{{ date('j M Y',strtotime(@$value->created_at)) }}</td>
                                  <td>
                                    <a href="{{url('admin/edit_stock/'.@$value->id)}}" class="btn btn-xs bg-olive">
                                      Edit
                                    </a>
                                    <a href="{{url('admin/delete_stock/'.@$value->id)}}" class="btn btn-xs bg-maroon" onclick="return confirm('Are your sure want to delete?')">
                                      Delete
                                    </a>
                                  </td>
                                </tr>
                          <?php  }
                          } else { ?> 
                            <tr><td colspan="12"> <p class="text-center"> Record Not Found...! </p> </td></tr>
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
