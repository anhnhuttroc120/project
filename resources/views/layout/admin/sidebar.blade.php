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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Người dùng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('admin/user/list')}}"><i class="fa fa fa-check"></i>Danh sách</a></li>
            <li><a href="{{url('admin/user/add')}}"><i class="fa fa fa-check"></i> Thêm người dùng</a></li>
          </ul>
        </li>
        <!-- end ng dùng -->

       <!--  start nhóm người dùng -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Nhóm người dùng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa fa-check"></i> Danh sách </a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa fa-check"></i> Thêm</a></li>
           
          </ul>
        </li> <!-- end nhóm người dùng -->
        
        <!-- start chuyên mục -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Chuyên mục</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa fa-check"></i> Danh sách chuyên mục</a></li>
            <li><a href=""><i class="fa fa fa-check"></i> Thêm chuyên mục</a></li>
           
          </ul>
        </li><!-- end chuyên mục -->

        
        <!-- start đơn hàng -->
        <li>
          <a href="{{url('admin/order/list')}}">
            <i class="fa fa-calendar"></i> <span>Đơn hàng</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">4</small>
             
            </span>
          </a>
        </li>
        <!-- end đơn hàng -->
         <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/product/list')}}"><i class="fa fa fa-check"></i> Danh sách </a></li>
            <li><a href="{{url('admin/product/add')}}"><i class="fa fa fa-check"></i> Thêm</a></li>
           
          </ul>
        </li> <!-- end nhóm người dùng -->
        
        
    </section>
    <!-- /.sidebar -->
  </aside>
