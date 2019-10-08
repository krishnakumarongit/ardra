<section class="content-header">
  <h1>
	<?php echo $this->lang->line('subscription'); ?>
	<small><?php echo $this->lang->line('view'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-subscriptions'); ?>"><?php echo $this->lang->line('subscriptions'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('subscription'); ?> <?php echo $this->lang->line('view'); ?></li>
  </ol>
</section>

<section class="content">
 

<div class="col-md-12">

<div class="box box-default">
<!-- /.box-header -->
<div class="box-body">
<table class="table table-bordered table-striped">
<tr>
<td><?php echo $this->lang->line('member'); ?></td>
<td> <?php echo $data['member_name']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('membership'); ?></td>
<td><?php echo $data['membership_name']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['fee']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('registration_fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['registration_fee']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['other_fee']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('total'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['total']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('discount'); ?> </td>
<td><?php echo $this->currency; ?> <?php echo $data['discount']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('tot_to_be_paid'); ?> </td>
<td><?php echo $this->currency; ?> <?php echo $data['amount_to_paid']; ?></td>
</tr>


<tr>
<td><?php echo $this->lang->line('subscription_starts'); ?></td>
<td><?php echo date('d/m/Y',strtotime($data['start_date'])); ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('subscription_ends'); ?></td>
<td><?php echo date('d/m/Y',strtotime($data['end_date'])); ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('notes'); ?></td>
<td><?php echo $data['notes']; ?></td>
</tr>


<tr>
<td></td>
<td>  
<a title="<?php echo $this->lang->line('edit'); ?>" href="<?php echo site_url('add-subscription/'.$data['id']); ?>">
  <button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"></i>
</button></a>

<a title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm'); ?>');" href="<?php echo site_url('delete-subscription/'.$data['id']); ?>">
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
