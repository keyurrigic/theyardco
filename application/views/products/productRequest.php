 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product Request</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Product Request</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Select Product Request</h3>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <?php foreach($products as $product){?>
                        <div class="col-sm-2">
                            <a href="<?php echo site_url('products/selectProduct/'.$product->id); ?>">
                                <img src="<?php echo $product->images[0]->src; ?>" class="img-fluid mb-2" alt="<?php echo $product->name; ?>"/><br/>
                                <?php echo $product->name; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
              </div>
              
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->