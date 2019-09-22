<section class="content-header">
  <h1>
	<?php echo $this->lang->line('membership'); ?>
	<small><?php echo $this->lang->line('view'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-memberships'); ?>"><?php echo $this->lang->line('memberships'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('membership'); ?> <?php echo $this->lang->line('view'); ?></li>
  </ol>
</section>

<section class="content">
 

<div class="col-md-12">







  <div class="box box-default">
    <!-- /.box-header -->
        <div class="box-body">
			
			<table class="table table-bordered table-striped">
<tr>
<td><?php echo $this->lang->line('name'); ?></td>
<td> <?php echo $data['name']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('duration'); ?></td>
<td><?php echo $data['duration']; ?>

<?php $duration_select =  $data['duration_type']; ?>
               	  <?php if ($duration_select == 'day') {  echo $this->lang->line('day'); } ?>
               	  <?php if ($duration_select == 'month') {  echo $this->lang->line('month'); } ?>
               	 <?php if ($duration_select == 'year') {  echo $this->lang->line('year'); } ?>
</td>
</tr>
<tr>
<td><?php echo $this->lang->line('fee'); ?></td>
<td><?php echo $data['fee']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('description'); ?></td>
<td><?php echo $data['description']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('status'); ?></td>
<td>  <?php $status_select =  $data['status']; ?>		    
 <?php if($status_select == 'active'){ 
			echo '<span class="label label-success">'.$this->lang->line($status_select).'</span>';  
		} else 
		{ 
			echo '<span class="label label-danger">'.$this->lang->line($status_select).'</span>';
		} 
	?>			
</td>
</tr>

<tr>
<td><?php echo $this->lang->line('created_at'); ?></td>
<td><?php echo date('d/m/Y',strtotime($data['created_at'])); ?></td>
</tr>

<tr>
<td></td>
<td>  
	 <a title="<?php echo $this->lang->line('edit'); ?>" href="<?php echo site_url('add-membership/'.$data['id']); ?>">
					  <button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"></i>
                </button></a>
                
 <a title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm'); ?>');" href="<?php echo site_url('delete-membership/'.$data['id']); ?>">
					  <button type="button" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i>
                </button></a>		
</td>
</tr>

</table>
			
			
			
          
          
          
          
         
          
       
          
          
          
          
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>
          <!-- kk -->
              </div>
      <!-- /.box -->
    </section>


<script type="text/javascript">
	
</script>
