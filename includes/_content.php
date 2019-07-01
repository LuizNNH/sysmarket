  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_name; ?>
      </h1>
      <ol class="breadcrumb">
        <?php 
          foreach ($breadcrumb as $bread) {
              if ($bread['url'] == "") {
        ?>
        <li class="active"><?php echo $bread['title']?></li>
        <?php } else { ?>
        <li class="active"><a href="<?php echo $bread['url'] ?>"><i class="fa fa-dashboard"></i> <?php echo $bread['title']?></a></li>
        <?php } } ?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">