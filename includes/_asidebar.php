  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">



      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">GERENCIAR</li>
        <li class="<?php echo $ativo == "invoices" ? "active" : "" ?>">
          <a href="<?php echo URL::getBase(); ?>invoice">
            <i class="fa fa-shopping-cart"></i> <span>Vendas</span>
          </a>
        </li>   
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