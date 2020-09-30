<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{route('home')}}">
        <i class="fa fa-th"></i> <span>Home</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li ><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> user</a></li>
        <li ><a href="{{route('supplier.index')}}"><i class="fa fa-circle-o"></i> supplier</a></li>
        <li ><a href="{{route('pegawai.index')}}"><i class="fa fa-circle-o"></i> pegawai</a></li>
        <li ><a href="{{route('kategori.index')}}"><i class="fa fa-circle-o"></i> kategori</a></li>
        <li ><a href="{{route('produk.index')}}"><i class="fa fa-circle-o"></i> produk</a></li>
        <li ><a href="{{route('agen')}}"><i class="fa fa-circle-o"></i> agen</a></li>
      </ul>
    </li>
    <li>
      <a href="{{route('transaksi_masuk.index')}}">
        <i class="fa fa-th"></i> <span>Transaksi Masuk</span>
      </a>
    </li>
    <li>
      <a href="{{route('report_penjualan')}}">
        <i class="fa fa-th"></i> <span>report penjualan</span>
      </a>
    </li>
  </ul>