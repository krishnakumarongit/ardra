<section class="content-header">
  <h1>
	<?php echo $this->lang->line('payment'); ?>
	<small><?php echo $this->lang->line('list'); ?></small>
	       <a href="<?php echo site_url('add-payment'); ?>"><button type="submit" class="btn btn-info "><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add');?> <?php echo $this->lang->line('payment');?></button></a>
     
  </h1>
  
  
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('payments'); ?></li>
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
<form method="get" action="<?php echo site_url('list-payment'); ?>" autocomplete="off">
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
                <label><?php echo $this->lang->line('member'); ?></label>
				 <select name="member_id" id="member_id"  class="form-control">
		<option value=""><?php echo $this->lang->line('select'); ?></option>
		<?php 
		
		if (count($members) >0) { 
		foreach ($members as $row => $val) {  
		?>
		<option value="<?php echo $val['id']; ?>" <?php if(isset($_GET['member_id']) && $_GET['member_id'] == $val['id'] ) { ?> selected <?php } ?> ><?php echo $val['first_name'].' '.$val['last_name']; ?> [<?php echo $val['member_id']; ?>]</option>
	    <?php }} ?>
	</select>
			   </div>
              <!-- /.form-group -->
              <div class="form-group">
				  <label><?php echo $this->lang->line('transaction_id'); ?></label>
				  <input type="text" value="<?php if(isset($_GET['transaction_id']) && $_GET['transaction_id'] != '' ) { echo $_GET['transaction_id']; } ?>" placeholder="<?php echo $this->lang->line('transaction_id'); ?>" name="transaction_id" id="transaction_id" class="form-control" >
				
               </div>
              <!-- /.form-group -->
            </div>
            
            
             <div class="col-md-6">
		     <div class="row">
				  <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('source'); ?></label>
				 <select name="source" id="source"  class="form-control">
					<option value=""><?php echo $this->lang->line('select'); ?></option>
					<option value="cash" <?php if(isset($_GET['source']) && $_GET['source'] == 'cash' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('cash'); ?></option>
	        
	        		<option value="credit_card" <?php if(isset($_GET['source']) && $_GET['source'] == 'credit_card' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('credit_card'); ?></option>
	        		<option value="debit_card" <?php if(isset($_GET['source']) && $_GET['source'] == 'debit_card' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('debit_card'); ?></option>
	        		<option value="net_banking" <?php if(isset($_GET['source']) && $_GET['source'] == 'net_banking' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('net_banking'); ?></option>
	        
	             </select>
			   </div>
			   </div>
			   <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('status'); ?></label>
				 <select name="status" id="status"  class="form-control">
					<option value=""><?php echo $this->lang->line('select'); ?></option>
					<option value="active" <?php if(isset($_GET['status']) && $_GET['status'] == 'active' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('active'); ?></option>
	        		<option value="cancelled" <?php if(isset($_GET['status']) && $_GET['status'] == 'cancelled' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('cancelled'); ?></option>
	             </select>
			   </div>
			   </div>
			   
			   </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-6">
			 <div class="row">	
				 
				 <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('date_from'); ?></label>
				  <input readonly type="text" value="<?php if(isset($_GET['date_from']) && $_GET['date_from'] != '' ) { echo $_GET['date_from']; } ?>" placeholder="<?php echo $this->lang->line('date_from'); ?>" name="date_from" id="date_from" class="form-control" >
				
			   </div>
			   </div>
			   
			   	 <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('date_to'); ?></label>
				 <input readonly type="text" value="<?php if(isset($_GET['date_to']) && $_GET['date_to'] != '' ) { echo $_GET['date_to']; } ?>" placeholder="<?php echo $this->lang->line('date_to'); ?>" name="date_to" id="date_to" class="form-control" >
	
			   </div>
			   </div>
			   
			   </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer" style="">
         <a href="<?php echo site_url('list-payment'); ?>"><button type="button" class="btn btn-default"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('clear'); ?></button></a>
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
                  <th><?php echo $this->lang->line('member'); ?></th>
                  <th><?php echo $this->lang->line('membership'); ?></th>
                  <th><?php echo $this->lang->line('payment_amount'); ?></th>
                  <th><?php echo $this->lang->line('source'); ?></th>
                  <th><?php echo $this->lang->line('payment_date'); ?></th>
                  <th><?php echo $this->lang->line('transaction_id'); ?></th>
                  <th><?php echo $this->lang->line('status'); ?></th>
                  <th style="text-align:center;"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                <?php 
                if (count($data['payments']) > 0) { 
				foreach($data['payments'] as $row) {	
				?>
                <tr>
                  <td><?php echo substr($row->member_name,0,15) ; ?></td>
                  <td><?php echo substr($row->subscription_name,0,10); ?></td>
                  <td>
                    <?php echo $this->currency.' '.$row->amount; ?>
                  </td>
                   <td>
                    <?php echo $this->lang->line($row->source); ?>
                  </td>
                   <td>
                    <?php echo date('M d, Y',strtotime($row->payment_date)); ?>
                  </td>
                  <td>
                    <?php echo $row->transaction_id; ?>
                  </td>
                   <td>
                    <small class="label <?php if ($row->status == 'active'){ ?>bg-green<?php } else { ?>bg-red<?php } ?>"><?php echo  $this->lang->line($row->status); ?></small>
                  </td>
                  <td style="text-align:center;">				
					  <a title="<?php echo $this->lang->line('view'); ?>" href="<?php echo site_url('view-payment/'.$row->id); ?>">
					  <button type="button" class="btn btn-success btn-sm" ><i class="fa fa-eye"></i>
                </button></a>   
                <?php if ($row->status == 'active'){ ?>                             
 <a title="<?php echo $this->lang->line('cancel'); ?>" onclick="return confirm('<?php echo $this->lang->line('cancel_confirm'); ?>');" href="<?php echo site_url('delete-payment/'.$row->id); ?>">
					  <button type="button" class="btn btn-danger btn-sm" ><i class="fa fa-ban"></i>
                </button></a>   
                <?php } ?>                           
                </td>
                </tr>
                <?php }} else { ?>
                 <tr><td colspan="8"><?php echo $this->lang->line('no_records'); ?></td></tr>
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
<script>

$(function () {
	$('#date_from').datepicker({
	  autoclose: true,
	  format: 'd/mm/yyyy',
	  orientation: "bottom auto"
	});
	$('#date_to').datepicker({
	  autoclose: true,
	  format: 'd/mm/yyyy',
	  orientation: "bottom auto"
	});
});	
</script>
