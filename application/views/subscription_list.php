<section class="content-header">
  <h1>
	<?php echo $this->lang->line('subscription'); ?>
	<small><?php echo $this->lang->line('list'); ?></small>
  </h1>
  
  
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('subscriptions'); ?></li>
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
<form method="get" action="<?php echo site_url('list-subscriptions'); ?>" autocomplete="off">
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
				  <label><?php echo $this->lang->line('membership'); ?></label>
				                 <select name="membership_id" id="membership_id" onchange="getSubscription(this.value)"  class="form-control">
				<option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php 
                    
                	if (count($memberships) >0) { 
					foreach ($memberships as $row => $val) {  
						if($val['deleted'] == 0) {
				   ?>
               	      <option value="<?php echo $val['id']; ?>" <?php if(isset($_GET['membership_id']) && $_GET['membership_id'] == $val['id'] ) { ?> selected <?php } ?> ><?php echo $val['name']; ?></option>
               	  <?php }}} ?>
                </select>
               </div>
              <!-- /.form-group -->
            </div>
            
            
             <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('status'); ?></label>
				 <select name="status" id="status"  class="form-control">
		         <option value=""><?php echo $this->lang->line('select'); ?></option>
		         <option value="no_payment_received" <?php if(isset($_GET['status']) && $_GET['status'] == 'no_payment_received' ) { ?> selected <?php } ?> ><?php echo $this->lang->line('no_payment_received'); ?></option>

	</select>
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
         <a href="<?php echo site_url('list-subscriptions'); ?>"><button type="button" class="btn btn-default"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('clear'); ?></button></a>
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
        
        </div>
      </div>
</form>


<!-- -->
          	
		
          <div class="box">
			  <div class="box-header with-border">
        

          <div class="box-tools pull-right">
            <a href="<?php echo site_url('add-subscription'); ?>"><button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add');?> <?php echo $this->lang->line('subscription');?></button></a>
          </div>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive" >
              <table class="table table-bordered">
                <tbody>
				<tr>
                  <th><?php echo $this->lang->line('member'); ?></th>
                  <th><?php echo $this->lang->line('membership'); ?></th>
                  <th><?php echo $this->lang->line('total_amount'); ?></th>
                  <th><?php echo $this->lang->line('due'); ?></th>
                  <th><?php echo $this->lang->line('start_date'); ?></th>
                  <th><?php echo $this->lang->line('next_payment'); ?></th>
                  <th><?php echo $this->lang->line('expires_on'); ?></th>
                  <th style="text-align:center;"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                <?php 
                if (count($data['subscriptions']) > 0) { 
				foreach($data['subscriptions'] as $row) {	
				?>
                <tr>
                  <td><?php echo ucwords(substr($row->member_name,0,15)) ; ?></td>
                  <td><?php echo ucwords(substr($row->membership_name,0,10)); ?></td>
                  <td>
                    <?php echo $this->currency.' '.$row->amount_to_paid; ?>
                  </td>
                   <td>
                    <?php echo $this->currency.' '.$row->amount_due; ?>
                  </td>
                   <td>
                    <?php echo date('M d, Y',strtotime($row->start_date)); ?>
                  </td>
                  <td>
                    <?php echo $this->lang->line($row->next_payment); ?>
                  </td>
                   <td>
                    <?php echo date('M d, Y',strtotime($row->end_date)); ?>
                  </td>
                  <td style="text-align:center;">				
					  <a title="<?php echo $this->lang->line('view'); ?>" href="<?php echo site_url('view-subscription/'.$row->id); ?>">
					  <button type="button" class="btn btn-success btn-sm" ><i class="fa fa-eye"></i>
                </button></a>
                
                 <a title="<?php echo $this->lang->line('edit'); ?>" href="<?php echo site_url('add-subscription/'.$row->id); ?>">
					  <button type="button" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"></i>
                </button>
                
 <a title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm'); ?>');" href="<?php echo site_url('delete-subscription/'.$row->id); ?>">
					  <button type="button" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i>
                </button></a>
                
                
                
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
