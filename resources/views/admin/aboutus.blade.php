@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       About Us
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About Us</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- row -->
      <div class="row">
              <div class="col-xs-12">
                  @include("admin.admin_error")
                  <div class="box box-primary">
                   
                    <form method="POST" action="{{url('admin/aboutus')}}" enctype="multipart/form-data">
                      <div class="box-header">
                        <h3 class="box-title box-title-flex"><span>About Us</span>                                    
                        </h3>
                      </div>
                      <div class="box-body">
                          {{ csrf_field() }}
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <label>Image (jpg,jpeg,png)</label><span class="astric"> *</span>
                                  <input type="file" name="image1" class="form-control imgInp">
                                  <img src="{{ isset($data->image1) ? asset('/storage/about_us/'.$data->image1) :''}}" width="100px" id="blah">
                               </div>
                              <div class="form-group">
                                  <label>Content</label><span class="astric"> *</span>
                                  <textarea class="form-control summernote" name="content">{{ @$data->content1 }}</textarea>
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
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>


@endsection