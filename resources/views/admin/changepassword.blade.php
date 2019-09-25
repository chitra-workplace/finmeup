@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>


   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
               <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Change Password</h3>                                    
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ url('admin/changepassword/') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="username">Old Password</label>
                                    <input id="password" type="password" class="form-control" name="old_password" placeholder="Enter Old Password" value="{{ old('old_password')}}" required>
                                    @if($errors->has('old_password'))
                                    <span class="has-error  text-red">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter New Password" value="{{ old('password')}}" required>
                                    @if($errors->has('password'))
                                    <span class="has-error  text-red">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password')}}" required>
                                    @if($errors->has('confirm_password'))
                                    <span class="has-error  text-red">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div>
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
  </div>
</div>

@endsection

