@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Profile</li>
      </ol>
    </section>

   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
               <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Profile</h3>                                    
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{ url('admin/profile/'.Auth::guard('admin')->user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="username">Name</label>
                                    <input type="text" name="name" class="form-control" id="username" placeholder="Enter Name" value="{{ Auth::guard('admin')->user()->name }}" required>
                                    @if($errors->has('name'))
                                    <span class="has-error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                                </div>

                                <div class="form-group">
                                    <label for="imgInp">Choose Image <small>(jpg,jpeg,png)</small></label>
                                    <input type="file" name="image" id="imgInp" >
                                    @if($errors->has('image'))
                                    <span class="has-error">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                  <?php $url = \URL::To('public/icon').'/user.png';
                                  if(@Auth::guard('admin')->user()->image){
                                    $url = \URL::To('storage/images/adminimage/').'/'.Auth::guard('admin')->user()->image;
                                  }

                                   ?>
                                    <img id="blah" src="{{ $url }}" style="width: 100px;" >
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!--/.col (left) -->
            </div>   <!-- /.row -->
        </div>   <!-- /.row -->
   </section><!-- /.content -->
 </div>
</div>
@endsection
@section('myjsfile')
  <script type="text/javascript">
      
      $(document).ready(function() {
       
      });
      function readURL(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function() {
        readURL(this);
      });
  </script>
@endsection
