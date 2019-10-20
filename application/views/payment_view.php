<section class="content-header">
  <h1>
	<?php echo $this->lang->line('payment'); ?>
	<small><?php echo $this->lang->line('view'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-payment'); ?>"><?php echo $this->lang->line('payments'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('view'); ?></li>
  </ol>
</section>

<section class="content">
 

<div class="col-md-12">

<div class="box box-default">
<!-- /.box-header -->
<div class="box-body">
<table class="table table-bordered table-striped">
<tr>
<td><?php echo $this->lang->line('transaction_id'); ?></td>
<td><?php echo $data['transaction_id']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('member'); ?></td>
<td> <?php echo ucwords($data['member_name']); ?>  [<?php echo $member['data']['member_id']; ?>]</td>
</tr>
<tr>
<td><?php echo $this->lang->line('membership'); ?></td>
<td><?php echo ucwords($data['subscription_name']); ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('payment_amount'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['amount']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('source'); ?></td>
<td><?php echo ucwords($this->lang->line($data['source'])); ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('payment_date'); ?></td>
<td><?php echo date('M d, Y',strtotime($data['payment_date'])); ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('notes'); ?> </td>
<td><?php echo $data['note']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('status'); ?> </td>
<td><?php echo $this->lang->line($data['status']); ?></td>
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
