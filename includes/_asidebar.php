  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
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

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">PRODUTOS</li>
        <li class="<?php echo $ativo == "productshome" ? "active" : "" ?>">
          <a href="<?php echo URL::getBase(); ?>productshome">
            <i class="fa fa-bookmark"></i> <span>Gerenciar Produtos</span>
          </a>
        </li>        
        <li class="<?php echo $ativo == "categorieshome" ? "active" : "" ?>">
          <a href="<?php echo URL::getBase(); ?>categorieshome">
            <i class="fa fa-tags"></i> <span>Gerenciar Categorias</span>
          </a>
        </li>
        <li class="<?php echo $ativo == "taxes" ? "active" : "" ?>">
          <a href="<?php echo URL::getBase(); ?>taxes">
            <i class="fa fa-line-chart"></i> <span>Gerenciar Impostos</span>
          </a>
        </li>
        <li class="header">SYSTEM</li>
        <li class="<?php echo $ativo == "userscreate" ? "active" : "" ?>">
          <a href="<?php echo URL::getBase(); ?>userscreate">
            <i class="fa fa-user-plus"></i> <span>Adicionar Usuário</span>
          </a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>