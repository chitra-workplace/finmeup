@extends("admin.layout.admin_master")

@section("top_title")
  Admin | Change Password
@endsection

@section("right_panel")
<section class="content-header">
       <ol class="breadcrumb">
           <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li>Change Password</li>
       </ol>
   </section>

   <section class="content">
       @include("admin.admin_error")
       <div class="row">
           <div class="col-xs-12">
               <div class="box box-primary">
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
                                    <span class="has-error">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter New Password" value="{{ old('password')}}" required>
                                    @if($errors->has('password'))
                                    <span class="has-error">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password')}}" required>
                                    @if($errors->has('confirm_password'))
                                    <span class="has-error">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>

                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.box -->

         </div><!--/.col (left) -->
         
     </div>   <!-- /.row -->
 </section><!-- /.content -->
@endsection

@section("page_footer")

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('public/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <!-- InputMask -->
  <script src="{{ asset('public/assets/js/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/assets/js/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/assets/js/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
  <!-- date-range-picker -->
  <script src="{{ asset('public/assets/js/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('public/assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}" type="text/javascript"></script>
  <!-- bootstrap time picker -->
  <script src="{{ asset('public/assets/js/plugins/timepicker/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('public/assets/js/AdminLTE/app.js') }}" type="text/javascript"></script>

  <!-- Page script -->
  <script type="text/javascript">
      $(function() {
          //Datemask dd/mm/yyyy
          $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
          //Datemask2 mm/dd/yyyy
          $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
          //Money Euro
          $("[data-mask]").inputmask();

          //Date range picker
          $('#reservation').daterangepicker();
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
          //Date range as a button
          $('#daterange-btn').daterangepicker(
                  {
                      ranges: {
                          'Today': [moment(), moment()],
                          'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                          'Last 7 Days': [moment().subtract('days', 6), moment()],
                          'Last 30 Days': [moment().subtract('days', 29), moment()],
                          'This Month': [moment().startOf('month'), moment().endOf('month')],
                          'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                      },
                      startDate: moment().subtract('days', 29),
                      endDate: moment()
                  },
          function(start, end) {
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }
          );

          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
              checkboxClass: 'icheckbox_minimal',
              radioClass: 'iradio_minimal'
          });
          //Red color scheme for iCheck
          $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
              checkboxClass: 'icheckbox_minimal-red',
              radioClass: 'iradio_minimal-red'
          });
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
              checkboxClass: 'icheckbox_flat-red',
              radioClass: 'iradio_flat-red'
          });

          //Colorpicker
          $(".my-colorpicker1").colorpicker();
          //color picker with addon
          $(".my-colorpicker2").colorpicker();

          //Timepicker
          $(".timepicker").timepicker({
              showInputs: false
          });
      });
  </script>

  <script type="text/javascript">
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