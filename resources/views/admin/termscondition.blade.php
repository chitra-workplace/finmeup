@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Terms & Condition
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Terms & Condition</li>
      </ol>
    </section>
   <!-- Main content -->
   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
               <div class="box">
                <form method="POST" action="{{url('admin/temscondition')}}">
                   <div class="box-header">
                       <h3 class="box-title">Terms & Condition</h3>
                    </div>                                    
                   <!-- /.box-header -->
                   <div class="box-body">
                            {{ csrf_field() }}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control summernote" name="detail">{{ @$terms->content }}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                       <input type="submit" class="btn btn-success submit-button pull-right">
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </section>
  </div>
</div>
@endsection
