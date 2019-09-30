@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Stock Pick
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Stock Pick </li>
      </ol>
    </section>
   <!-- Main content -->
   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
          
            <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Edit :: {{ @$stock->stock_name }}</h3>
                    </div>
                    <!-- /.box-header -->
                  <form role="form" action="{{ url('admin/update_stock') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                      
                      <div class="form">
                             <input type="hidden" name="stock_id" value="{{@$stock->id}}">
                              <div class="box-body">
                                <div class="col-sm-12 row" id="">
                                      <div class="form-group  col-sm-3">
                                          <label for="imgInp">Stock Pick <small>(jpg,jpeg,png)</small></label>
                                          <input type="file" name="image" id="imgInp" >
                                          @if($errors->has('image'))
                                          <span class="has-error">{{ $errors->first('image') }}</span>
                                          @endif
                                      </div>

                                      <div class="form-group  col-sm-9">
                                        <?php $url = \URL::To('public/icon').'/default_comp_logo.png';
                                          if(!empty(@$stock->image)){
                                            $url = url($stock->image);
                                          }
                                         ?>
                                          <img id="blah" src="{{ $url }}" style="width: 100px;" >
                                          <input type="hidden" name="stock_image" value="{{@$url}}">
                                      </div>
                                      <div class="form-group  col-sm-12"></div>
                                      <div class="form-group  col-sm-6">
                                          <label for="category">Choose Category</label>
                                           <select name="category" class="form-control" data-validation="required" onchange="set_hold_for(this)">
                                                <option value=""> -- Choose Category -- </option>
                                              <?php if(!empty($stock_ctg)){ ?>
                                                <?php foreach($stock_ctg as $key => $value ){ ?>
                                                <option value="{{$key}}" <?php if($key == @$stock->category){ echo "selected"; } ?> > {{$value}}</option>
                                              <?php } }?>
                                            </select>
                                          @if($errors->has('category'))
                                          <span class="has-errors text-red">{{ $errors->first('category') }}</span>
                                          @endif
                                      </div>
                                  
                                      <div class="form-group  col-sm-6">
                                          <label for="stock_name">Stock Name </label>
                                          <input type="text" name="stock_name" class="form-control" placeholder="Enter Stock Name" data-validation="required" value="{{$stock->stock_name}}">
                                          
                                          @if($errors->has('stock_name'))
                                          <span class="has-errors text-red">{{ $errors->first('stock_name') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group col-sm-12 holdfor_block @if(@$stock->category < 3) d-none @endif">
                                           <label for="hold_for">Hold For</label> <br>
                                            <div class="col-sm-2 row">
                                              <select class="form-control" name="hold_for_year"  data-validation="required">
                                                <option value="">--No of Year--</option>
                                                <?php for ($i=0; $i < 51; $i++) {  ?>
                                                  <option value="{{$i}}" <?php if($i == @$stock->hold_for_year){ echo "selected"; } ?> > {{$i}} Year </option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                            <div class="col-sm-2">
                                              <select class="form-control" name="hold_for_month"  data-validation="required">
                                                <option value="">--No of Month--</option>
                                                <?php for ($i=0; $i < 13; $i++) {  ?>
                                                  <option value="{{$i}}" <?php if($i == @$stock->hold_for_month){ echo "selected"; } ?>> {{$i}} Month </option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                            <div class="col-sm-2 row">
                                              <select class="form-control" name="hold_for_days"  data-validation="required">
                                                <option value="">--No of Days--</option>
                                                <?php for ($i=0; $i < 32; $i++) {  ?>
                                                  <option value="{{$i}}" <?php if($i == @$stock->hold_for_days){ echo "selected"; } ?>> {{$i}} Days </option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                      </div>
                                      <div class="form-group col-sm-6">
                                          <label for="current_market_price">Current Market Price</label>
                                          <input type="text" name="current_market_price" class="form-control" placeholder="Enter Current Market Price" data-validation="required" value="{{$stock->current_market_price}}">
                                          @if($errors->has('current_market_price'))
                                          <span class="has-errors text-red">{{ $errors->first('current_market_price') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group col-sm-6">
                                          <label for="target_price">Target Price</label>
                                          <input type="text" name="target_price" class="form-control" placeholder="Enter Target Price" data-validation="required" value="{{$stock->target_price}}">
                                          @if($errors->has('target_price'))
                                          <span class="has-errors text-red">{{ $errors->first('target_price') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group col-sm-12">
                                          <label for="listed_in">Where it’s listed</label>
                                          <input type="text" name="listed_in" class="form-control" placeholder="Enter listed in" data-validation="required" value="{{$stock->listed_in}}">
                                          @if($errors->has('listed_in'))
                                          <span class="has-errors text-red">{{ $errors->first('listed_in') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group col-sm-12">
                                          <label for="description">Description</label>
                                          <textarea name="description" class="form-control" placeholder="Enter Description" data-validation="required">{{$stock->description}}</textarea>
                                          @if($errors->has('description'))
                                          <span class="has-errors text-red">{{ $errors->first('description') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group col-sm-12">
                                         <label for="reason">Reason</label> 
                                          <textarea name="reason" class="form-control" placeholder="Enter Reason" data-validation="required">{{$stock->reason}}</textarea>
                                          @if($errors->has('reason'))
                                          <span class="has-errors text-red">{{ $errors->first('reason') }}</span>
                                          @endif
                                      </div>
                                  </div> <!-- /.end of quiz box div -->
                              </div><!-- /.box-body -->

                              <div class="box-footer">
                                  <button type="submit" class="btn btn-success pull-right">Submit</button>
                              </div>
                         
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                    </div>
                </form>
            </div>
        </div>
    </section>
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

      function set_hold_for(th){
        var ths = $(th);

        if(ths.val() == 3){
          $('.holdfor_block').show();
        }else{
          $('.holdfor_block').hide();
        }
      }
  </script>
@endsection
