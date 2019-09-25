@extends('admin.layout.auth')

@section('content')

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-question-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Quiz</span>
              <span class="info-box-number">4,000</span>
              <!-- <span class="info-box-number">90<small>%</small></span> -->
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-lightbulb-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Stock Pics</span>
              <span class="info-box-number">3,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-play-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Videos $ Articles</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

   
    

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
       
          <!-- /.box -->
          <div class="row">
       

            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Users</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Users</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user1-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user8-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user7-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">11 Sep</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user6-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Sep</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user2-160x160.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Oct</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user5-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Oct</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user4-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Oct</span>
                    </li>
                    <li>
                      <img src="{{ asset('/public/ltetheme/dist/img/user3-128x128.jpg') }}" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Oct</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ url('admin/users') }}" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <div class="col-md-8">
                <div class="box box-info" >
                        <div class="box-header with-border">
                          <h3 class="box-title"> Quiz Ananysis </h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                            <table class="table no-margin">
                              <thead>
                              <tr>
                                <th>Quiz Title</th>
                                <th>No of played users</th>
                                <th>Status</th>
                                <th>Posted At</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <td><a href="#">Quiz 1001</a></td>
                                <td>1500</td>
                                <td><span class="label label-success">75%</span></td>
                                <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo date('j M y',strtotime('-25 days')); ?></div>
                                </td>
                              </tr>
                              <tr>
                                <td><a href="#">Quiz 999</a></td>
                                <td>500</td>
                                <td><span class="label label-danger">25%</span></td>
                                <td>
                                  <div class="sparkbar" data-color="#f39c12" data-height="20"><?php echo date('j M y',strtotime('-40 days')); ?></div>
                                </td>
                              </tr>
                              <tr>
                                <td><a href="#">Quiz 799</a></td>
                                <td>900</td>
                                <td><span class="label label-warning">45%</span></td>
                                <td>
                                  <div class="sparkbar" data-color="#f56954" data-height="20"><?php echo date('j M y',strtotime('-2 months')); ?></div>
                                </td>
                              </tr>
                              <tr>
                                <td><a href="#">Quiz 500</a></td>
                                <td>1000</td>
                                <td><span class="label label-info">50%</span></td>
                                <td>
                                  <div class="sparkbar" data-color="#00c0ef" data-height="20"><?php echo date('j M y',strtotime('-3 months')); ?></div>
                                </td>
                              </tr>
                              <tr>
                                <td><a href="#">Quiz 400</a></td>
                                <td>100</td>
                                <td><span class="label label-danger">20%</span></td>
                                <td>
                                  <div class="sparkbar" data-color="#f39c12" data-height="20"><?php echo date('j M y',strtotime('-4 months')); ?></div>
                                </td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                          <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Post New</a>
                          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                        </div>
                        <!-- /.box-footer -->
                      </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col -->

 
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

@endsection
