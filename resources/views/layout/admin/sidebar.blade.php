  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="images/user/{{Auth::user()->picture}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->fullname}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <!-- start ng dùng -->
        <li class="{{(Request::is('admin/user/*')) ? 'active' : ''}}">
          <a href="{{url('admin/user/list')}}">
            <i class="fa fa-user"></i> <span>Người dùng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
        </li>
        <!-- end ng dùng -->



        
        <!-- start đơn hàng -->
        <li class="{{ (Request::is('admin/order/*')) ? 'active' : ''}}">
          <a href="{{url('admin/order/list')}}">
            <i class="fa fa-calendar"></i> <span>Đơn hàng</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">4</small>
             
            </span>
          </a>
        </li>
        <!-- end đơn hàng -->
         <li class="{{ (Request::is('admin/product/*')) ? 'active' : ''}}">
          <a href="{{url('admin/product/list')}}">
            <i class="fa fa-book"></i> <span>Sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
        </li> <!-- end nhóm người dùng -->
         <li class="{{(Request::is('admin/chart')) ? 'active' : ''}}">
          <a href="{{url('admin/chart')}}">
            <i class="fa fa-book"></i> <span>Biểu đồ đơn hàng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
        </li> <!-- end nhóm người dùng -->
         <li class="{{(Request::is('admin/calendar')) ? 'active' : ''}}">
          <a href="{{url('admin/calendar')}}">
            <i class="fa fa-book"></i> <span>Lịch shipper hàng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
        </li> <!-- end nhóm người dùng -->
        
        
    </section>
    <!-- /.sidebar -->
  </aside>
