<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Session::get('name')}} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ Request::path() == 'siswa' ? 'active' : '' }}"><a href="/siswa"><i class="fa fa-circle-o"></i> Siswa</a></li>
            <li  class="{{ Request::path() == 'guru' ? 'active' : '' }}"><a href="/guru"><i class="fa fa-circle-o"></i>Guru</a></li>
            <li  class="{{ Request::path() == 'kelas' ? 'active' : '' }}"><a href="/kelas"><i class="fa fa-circle-o"></i>Kelas</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ Request::path() == 'users' ? 'active' : '' }}"><a href="/users"><i class="fa fa-circle-o"></i>Users Guru</a></li>
            <li  class="{{ Request::path() == 'userapproval' ? 'active' : '' }}"><a href="/userapproval"><i class="fa fa-circle-o"></i>Users Siswa</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>E - Learning</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class="{{ Request::path() == 'rangkumannilai' ? 'active' : '' }}"><a href="/rangkumannilai"><i class="fa fa-circle-o"></i>Rangkuman Nilai</a></li>
            <li  class="{{ Request::path() == 'jadwalpelajaran' ? 'active' : '' }}"><a href="/jadwalpelajaran"><i class="fa fa-circle-o"></i>Jadwal Pelajaran</a></li>
            <li  class="{{ Request::path() == 'rekapabsen' ? 'active' : '' }}"><a href="/rekapabsen"><i class="fa fa-circle-o"></i>Rekap Absen</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>