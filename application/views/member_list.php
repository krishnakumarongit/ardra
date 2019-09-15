<section class="content-header">
  <h1>
	Members
	<small>List</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Members</li>
  </ol>
</section>

<section class="content">
	<?php if(isset($_SESSION['success']) && $_SESSION['success'] !="" ){ ?>
	<div class="callout callout-success">
			<p><?php echo $_SESSION['success']; ?></p>
		</div>
	<?php } $_SESSION['success'] = ''; ?>
	<?php if(isset($_SESSION['error']) && $_SESSION['error'] !="" ){ ?>
	<div class="callout callout-danger">
			<p><?php echo $_SESSION['error']; ?></p>
		</div>
	<?php } $_SESSION['error'] = ''; ?>
	
	
	<div class="col-md-12">
	
<!-- -->
<form method="get" action="">
<div class="box box-default collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Search</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
				  <label>ID</label>
				  <input class="form-control" name="member_id" type="text">
                 </div>
              <!-- /.form-group -->
              <div class="form-group">
                     </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
				  <input class="form-control" name="name" type="text">     </div>
              <!-- /.form-group -->
              <div class="form-group">
               </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="">
         <a href="<?php echo site_url('list-members'); ?>"><button type="button" class="btn btn-default"><i class="fa fa-times-circle"></i> Clear</button></a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i> Search</button>
        
        </div>
      </div>
</form>


<!-- -->
          	
		
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive" >
              <table class="table table-bordered">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>DOB</th>
                  <th>Sex</th>
                  <th>Since</th>
                  <th style="width:150px;">Actions</th>
                </tr>
                <?php 
                if (count($data['memebrs']) > 0) { 
				foreach($data['memebrs'] as $row) {	
				?>
                <tr>
                  <td><?php echo $row->member_id; ?></td>
                  <td><?php echo $row->first_name; ?> <?php echo $row->last_name; ?></td>
                  <td>
                    <?php echo date('d/M/Y',strtotime($row->dob)); ?>
                  </td>
                   <td>
                    <?php echo $row->sex; ?>
                  </td>
                  <td><?php echo date('d/M/Y',strtotime($row->created_at)); ?></td>
                  <td>				
                  <button type="button" class="btn btn-info"><i class="fa fa-cogs"></i>&nbsp;Actions</button>
                </td>
                </tr>
                <?php }} ?>
                
                
              </tbody>              
              </table>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
				<?php echo $data['links']; ?>
            </div>
          </div>
          <!-- /.box -->

         
        </div>
        
	
</section>
<style>
.st li{
  display: inline;
  padding:5px;
}
.st{
	padding-left:0px;
}
</style>
