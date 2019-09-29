<script src="<?php echo site_url('theme/js/holdon.js'); ?>"></script>
<section class="content-header" id="price_app">
  <h1>
	<?php echo $this->lang->line('subscription'); ?>
	<small><?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-subscriptions'); ?>"><?php echo $this->lang->line('subscriptions'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('subscription'); ?> <?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></li>
  </ol>
</section>

<section class="content">
 

<form method="post" action="<?php echo site_url('add-subscription/'.$id); ?>" onsubmit="return validate();">	
<input type="hidden" name="post_check" value="1" />
<div class="col-md-12">
	<?php 
	$error = validation_errors(); 
	if ($error !="") {
	   echo '<div class="callout callout-danger"><p>'.$error.'</p></div>';
	}
?>
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
	
    <?php $this->load->view('notification'); ?>
<!-- kk-->
  <div class="box box-default">
    <!-- /.box-header -->
        <div class="box-body">
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
				  
<div class="col-md-12">
	<label><?php echo $this->lang->line('member'); ?><span class="text-red">*</span></label>
	<select name="member_id" id="member_id"  class="form-control">
		<option value=""><?php echo $this->lang->line('select'); ?></option>
		<?php 
		if (count($members) >0) { 
		foreach ($members as $row => $val) {  
		?>
		<option value="<?php echo $val['id']; ?>"><?php echo $val['first_name'].' '.$val['last_name']; ?> [<?php echo $val['member_id']; ?>]</option>
	    <?php }} ?>
	</select>
</div>
				  
				  <div class="col-md-12">
			    <label><?php echo $this->lang->line('membership'); ?><span class="text-red">*</span></label>
                
                <select name="membership_id" id="membership_id" onchange="getSubscription(this.value)"  class="form-control">
				<option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php 
                	if (count($memberships) >0) { 
					foreach ($memberships as $row => $val) {  
				   ?>
               	      <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
               	  <?php }} ?>
                </select>
                </div>
                
                <!-- div class="col-md-12">
               
               <label><?php echo $this->lang->line('subscription'); ?> <?php echo $this->lang->line('start_date'); ?></label>
			   <input name="subscription_start" value="" readonly id="subscription_start" type="text" class="form-control dtkk" >
              </div>
              <div class="col-md-12">
               
               <label><?php echo $this->lang->line('subscription'); ?> <?php echo $this->lang->line('end_date'); ?></label>
			   <input name="subscription_end" value="" readonly id="subscription_end" type="text" class="form-control dtkk" >
              </div -->
             
                
                
                <div class="col-md-12">
					<hr />
                <br />
                <label><?php echo $this->lang->line('membership'); ?> <?php echo $this->lang->line('fee'); ?><span class="text-red">*</span></label>
                <input name="fee" value="" onkeyUp="processTotal()" id="fee" type="text" class="form-control" placeholder="<?php echo $this->lang->line('membership'); ?> <?php echo $this->lang->line('fee'); ?>">
             </div>
             
             
             
             
             <div class="col-md-12">
               <label><?php echo $this->lang->line('registration_fee'); ?></label>
			   <input name="registration_fee" onkeyUp="processTotal()"  value="" id="registration_fee" type="text" class="form-control" placeholder="<?php echo $this->lang->line('registration_fee'); ?>">
              </div>
              
              <div class="col-md-12">
                <label><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('fee'); ?></label>
                <input name="other_fee" value="" onkeyUp="processTotal()" id="other_fee" type="text" class="form-control" placeholder="<?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('fee'); ?>">
                </div>
                
                 <div class="col-md-12">
					 <br />
                <label><?php echo $this->lang->line('total'); ?>:</label>
                 <?php echo $this->currency; ?>&nbsp;<span id="sub_total" font-size: 19px;></span>
                 </div>
                
                <div class="col-md-12">
                <label><?php echo $this->lang->line('discount'); ?> </label>
                <input name="discount" value="" onkeyUp="processTotal()" v-model.number="discount" id="discount" type="text" class="form-control" placeholder="<?php echo $this->lang->line('discount'); ?>">
                </div>
                
                
                <div class="col-md-12">
					 <br />
                <label><?php echo $this->lang->line('tot_to_be_paid'); ?>:</label>
                <?php echo $this->currency; ?>&nbsp;<span id="pay_total" style="font-size: 19px;"></span>
               
                </div>
              
               	<div style="clear:both;"></div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
			  </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                         </div>
              <!-- /.form-group -->
              <div class="col-md-12">
              <div class="form-group">
				  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save_next'); ?></button>
                    </div>
                    </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->        
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?php echo $this->lang->line('fields_required'); ?>
        </div>
      </div>
          <!-- kk -->
                
                
                
                
              </div>
	
</form>
      <!-- /.box -->
</section>
<div style="clear:both;"></div>

<script type="text/javascript">
	function validate() {
		$('#error_notification').html('');
		$('#error_notification').hide();
		
		var name = $('#name').val();
		var duration = $('#duration').val();
		var fee = $('#fee').val();
		var duration_type = $('#duration_type').val();
		var description = $('#description').val();
		var status = $('#status').val();
		
		$('#name').css('border-bottom','1px solid #d2d6de');
		$('#duration').css('border-bottom','1px solid #d2d6de');
		$('#fee').css('border-bottom','1px solid #d2d6de');
		$('#duration_type').css('border-bottom','1px solid #d2d6de');
		$('#description').css('border-bottom','1px solid #d2d6de');
		$('#status').css('border-bottom','1px solid #d2d6de');
		
		var message ='';
		
		if (name == '') {
			$('#name').css('border-bottom','1px solid #dd4b39');
			message = message + '<?php echo $this->lang->line('name'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		
		if (duration == '') {
			$('#duration').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('duration'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		
		
		
		if (fee == '') {
			$('#fee').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		

		
		if (duration_type == '') {
			$('#duration_type').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('duration_type'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		
		if (description == '') {
			$('#description').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('description'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		
		if (status == '') {
			$('#status').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('status'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		
		if(message !="") {
			$('#ta1').trigger('click');
			$('#error_notification').html(message);
			$('#error_notification').show();
			return false;
		}else {
			return true;
		}
	}
	
	
	function getSubscription(id)
	{
		if (id != "") {
            $.blockUI({ message: '<?php echo $this->lang->line('request_processing'); ?>', css: { background: 'none'} });
			$.ajax({ dataType: "JSON",  url: "<?php echo site_url('get-membership'); ?>/"+id, success: function(result) {
               if(result.status == 1){
				   $('#fee').val(result.data.fee);
				   $('#sub_total').html(result.data.fee);
				   $('#pay_total').html(result.data.fee);
			   }
			   processTotal();
			   $.unblockUI(); 
            }});
            
		}
	}
	
	
	
	function processTotal() {

$('#error_notification').html('');
$('#error_notification').hide();

var fee = $('#fee').val();
var registration_fee = $('#registration_fee').val();
var other_fee = $('#other_fee').val();
var discount = $('#discount').val();
var message = '';
var pattern = /^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/;
var fee_ok = pattern.exec(fee);
var registration_fee_ok = pattern.exec(registration_fee);
var other_fee_ok = pattern.exec(other_fee);
var discount_ok = pattern.exec(discount);


$('#fee').css('border-bottom','1px solid #d2d6de');
$('#registration_fee').css('border-bottom','1px solid #d2d6de');
$('#other_fee').css('border-bottom','1px solid #d2d6de');
$('#discount').css('border-bottom','1px solid #d2d6de');


if (fee =="") {
  $('#fee').css('border-bottom','1px solid #dd4b39');
  message = message + '<br /> <?php echo $this->lang->line('fee_validation'); ?>';	
}

if (registration_fee !="" && !registration_fee_ok) {
  $('#registration_fee').css('border-bottom','1px solid #dd4b39');
  message = message + '<br /> <?php echo $this->lang->line('registration_fee_validation'); ?>';	
}

if (other_fee !="" && !other_fee_ok) {
  $('#other_fee').css('border-bottom','1px solid #dd4b39');
  message = message + '<br /> <?php echo $this->lang->line('other_fee_validation'); ?>';	
}

if (discount !="" && !discount_ok) {
  $('#discount').css('border-bottom','1px solid #dd4b39');
  message = message + '<br /> <?php echo $this->lang->line('discount_validation'); ?> ';	
}


if(message !="") {
	$('#error_notification').html(message);
	$('#error_notification').show();
	return false;
}else {
	
	fee = (fee !="") ? fee : 0;
	registration_fee = (registration_fee != "") ? registration_fee : 0; 
	other_fee = (other_fee != "") ? other_fee : 0; 
	discount = (discount != "") ? discount : 0; 
	var sub_total = parseFloat(fee)+parseFloat(registration_fee)+parseFloat(other_fee);
	$('#sub_total').html(sub_total);
	var total = 0;
	if (discount < sub_total) {
		total  = (parseFloat(fee)+parseFloat(registration_fee)+parseFloat(other_fee)) - parseFloat(discount);
    }
	$('#pay_total').html(total);	
}
	
}
	
	
	$(function () {
		$('.dtkk').datepicker({
		  autoclose: true,
		  format: 'd/mm/yyyy'
		});
	});
	
</script>
