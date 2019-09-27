@extends('admin.layout.auth')

@section('content')
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Post New Quiz
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Post New Quiz </li>
      </ol>
    </section>
   <!-- Main content -->
   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
          
            <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Post New Quiz</h3>
                    </div>
                    <!-- /.box-header -->
                  <form role="form" action="{{ url('admin/create_quiz') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="box-body">
                      
                      <div class="form">
                          
                              <div class="box-body">
                                  <div class="form-group">
                                      <label for="title">Title</label>
                                      <input type="text" name="title" class="form-control" id="title" placeholder="Quiz Title" data-validation="required">
                                      @if($errors->has('title'))
                                      <span class="has-errors text-red">{{ $errors->first('title') }}</span>
                                      @endif
                                  </div>
                                  <div class="quiz_box col-xs-12" id="quizbox_1">
                                      <div class="form-group">
                                          <label for="question">Question <span class="no"> 1 </span></label>
                                          <a href="javascript:void(0)" class="pull-right remove text-red m-l-5 d-none" onclick="remove(this)"> - Remove </a>

                                          <a href="javascript:void(0)" class="pull-right add_more" onclick="add_more(this)"> + Add More</a>

                                          <textarea name="question[]" class="form-control" placeholder="Enter Question" data-validation="required"></textarea>
                                          @if($errors->has('question.*'))
                                          <span class="has-errors text-red">{{ $errors->first('question.*') }}</span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="option_1">Option 1</label>
                                          <input type="text" name="option_1[]" class="form-control" placeholder="Enter First Option" data-validation="required">
                                          @if($errors->has('option_1.*'))
                                          <span class="has-errors text-red">{{ $errors->first('option_1.*') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="option_2">Option 2</label>
                                          <input type="text" name="option_2[]" class="form-control" placeholder="Enter Second Option" data-validation="required">
                                          @if($errors->has('option_2.*'))
                                          <span class="has-errors text-red">{{ $errors->first('option_2.*') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="option_3">Option 3</label>
                                          <input type="text" name="option_3[]" class="form-control" placeholder="Enter Third Option" data-validation="required">
                                          @if($errors->has('option_3.*'))
                                          <span class="has-errors text-red">{{ $errors->first('option_3.*') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="option_4">Option 4</label>
                                          <input type="text" name="option_4[]" class="form-control" placeholder="Enter Fourth Option" data-validation="required">
                                          @if($errors->has('option_4.*'))
                                          <span class="has-errors text-red">{{ $errors->first('option_4.*') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group">
                                          <label for="right_option">Right Option</label>
                                          <select name="right_option[]" class="form-control" data-validation="required">
                                              <option value=""> -- Select Right Option -- </option>
                                              <option value="1"> Option 1</option>
                                              <option value="2"> Option 2</option>
                                              <option value="3"> Option 3</option>
                                              <option value="4"> Option 4</option>
                                          </select>
                                          @if($errors->has('right_option.*'))
                                          <span class="has-errors text-red">{{ $errors->first('right_option.*') }}</span>
                                          @endif
                                      </div>
                                      <div class="form-group">
                                         <label for="right_opt_reason">Reason for right option</label> 
                                          <textarea name="right_opt_reason[]" class="form-control" placeholder="Enter reason for right option" data-validation="required"></textarea>
                                          @if($errors->has('right_opt_reason.*'))
                                          <span class="has-errors text-red">{{ $errors->first('right_opt_reason.*') }}</span>
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
      function add_more(th){
        var ths = $(th);
        var noofquizdiv = $('.quiz_box').length;
        var qno = parseInt(noofquizdiv) + 1;
        var newid = 'quizbox_'+qno;
        var divClone = $("div#quizbox_"+noofquizdiv).clone();
        //The next line changes the ID and innerHTML
        divClone.find('input').val('');
        divClone.find('textarea').val('');
        divClone.attr("id", newid);
        divClone.find('.no').html(qno);
        divClone.find('.has-errors').html('');
        divClone.insertAfter("div.quiz_box:last");
        //$('.quiz_box:last').clone().insertAfter("div.quiz_box:last");
        ths.parent().parent().find('.remove').show();
        ths.parent().parent().find('.add_more').hide();
      }

      function remove(th){
        var ths = $(th);
        ths.parent().parent('div.quiz_box').remove();
        $(".quiz_box").get().forEach(function(entry, index, array) {
            // Here, array.length is the total number of items
            var ind = index+1;
            var newid = 'quizbox_'+ind;
            $(entry).find('.no').html(ind);
            $(entry).attr("id", newid);
        });
      }
  </script>
@endsection
