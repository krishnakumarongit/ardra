<section class="content-header">
  <h1>
	<?php echo $this->lang->line('membership'); ?>
	<small><?php echo $this->lang->line('list'); ?></small>
	     <a href="<?php echo site_url('add-membership'); ?>"><button type="submit" class="btn btn-info "><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add');?> <?php echo $this->lang->line('membership');?></button></a>
      
  </h1>
  
  
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('memberships'); ?></li>
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
<form method="get" action="" autocomplete="off">
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $this->lang->line('search'); ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
          <div class="row">
             <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('name'); ?></label>
				  <input class="form-control" name="name" type="text" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '';  ?>">     
			   </div>
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
         <a href="<?php echo site_url('list-memberships'); ?>"><button type="button" class="btn btn-default"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('clear'); ?></button></a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
        
        </div>
      </div>
</form>


<!-- -->
          	
		
          <div class="box">
		
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive" >
              <table class="table table-bordered">
                <tbody>
				<tr>
                  <th><?php echo $this->lang->line('name'); ?></th>
                  <th><?php echo $this->lang->line('duration'); ?></th>
                  <th><?php echo $this->lang->line('fee'); ?></th>
                  <th><?php echo $this->lang->line('status'); ?></th>
                  <th style="text-align:center;"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                <?php 
                if (count($data['memebrs']) > 0) { 
				foreach($data['memebrs'] as $row) {	
				?>
                <tr>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->duration; ?> <?php echo $this->lang->line($row->duration_type); ?> </td>
                  <td>
                    <?php echo $row->fee.' '.$this->currency; ?>
                  </td>
                   <td>
                    <?php if($row->status == 'active'){ 
							echo '<span class="label label-success">'.$this->lang->line($row->status).'</span>';  
						} else 
						{ 
							echo '<span class="label label-danger">'.$this->lang->line($row->status).'</span>';
						} 
					?>
                  </td>
                  <td style="text-align:center;">				
					  <a title="<?php echo $this->lang->line('view'); ?>" href="<?php echo site_url('view-membership/'.$row->id); ?>">
					  <button type="button" class="btn btn-success btn-sm" ><i class="fa fa-eye"></i>
                </button></a>
                
                 <a title="<?php echo $this->lang->line('edit'); ?>" href="<?php echo site_url('add-membership/'.$row->id); ?>">
					  <button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"></i>
                </button></a>
                
 <a title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm'); ?>');" href="<?php echo site_url('delete-membership/'.$row->id); ?>">
					  <button type="button" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i>
                </button></a>
                
                
                
                </td>
                </tr>
                <?php }} else { ?>
                 <tr><td colspan="5"><?php echo $this->lang->line('no_records'); ?></td></tr>
                <?php } ?>
              </tbody>              
              </table>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
			<?php echo $this->lang->line('total_records'); ?> : <?php echo $total; ?>	<?php echo $data['links']; ?>
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
