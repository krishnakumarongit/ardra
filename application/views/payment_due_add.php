<script src="<?php echo site_url('theme/js/holdon.js'); ?>"></script>
<script src="<?php echo site_url('theme/js/money.js'); ?>"></script>

<section class="content-header" id="price_app">
  <h1>
	<?php echo $this->lang->line('payment'); ?>
	<small><?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-payment'); ?>"><?php echo $this->lang->line('payments'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('payment'); ?> <?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></li>
  </ol>
</section>

<section class="content">

<form method="post" action="<?php echo site_url('add-due-payment/'.$id); ?>" onsubmit="return validate();">	
<input type="hidden" id="balance" name="balance" value="<?php echo set_value('balance', $data['balance']); ?>" />
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
	<?php if($id > 0){ ?>
<br /><br />
	<?php } ?>
	<label><?php echo $this->lang->line('member'); ?><?php if($id > 0){ echo " - ".ucwords($data['name']).' ['.$data['member_id'].']'; } else { ?><span class="text-red">*</span> <?php } ?></label>
	
	<?php if($id > 0){ ?> 
		<input type="hidden" name="member_id" id="member_id" value="<?php echo $data['member_id']; ?>" />
    <?php } else { ?>
	
	<select  name="member_id"  id="member_id" onchange="getSubscription(this.value)"   class="form-control">
		<option value=""><?php echo $this->lang->line('select'); ?></option>
		<?php 
		$memeber = set_value('member_id', $data['member_id']);
		if (count($members) >0) { 
		foreach ($members as $row => $val) {  
		?>
		<option value="<?php echo $val['id']; ?>" <?php if($val['id'] == $memeber){ ?>  selected <?php } ?> ><?php echo $val['first_name'].' '.$val['last_name']; ?> [<?php echo $val['member_id']; ?>]</option>
	    <?php }} ?>
	</select>
	<?php } ?>
	
	
</div>			  
<div class="col-md-12">
<label><?php echo $this->lang->line('subscription'); ?><?php if($id > 0){ echo " - ".$data['sub']; } else { ?><span class="text-red">*</span><?php } ?></label>


<?php if($id > 0){ ?> 
		<input type="hidden" name="subscription" id="subscription" value="<?php echo $data['subscription']; ?>" />
    <?php } else { ?>
<select name="subscription" <?php if($id > 0){ ?>  style="display:none" <?php } ?>  onchange="getSubscriptionValue(this.value)" id="subscription"  class="form-control">
<option value=""><?php echo $this->lang->line('select'); ?></option>
<?php echo $subdrop; ?>
</select>
<?php } ?>

</div>


						  
<div class="col-md-12">
<hr />

<div class="row"> 
	<div class="col-md-6">
<label><?php echo $this->lang->line('payment_amount'); ?> <span class="text-red">*</span></label>
<input name="amount" value="<?php echo set_value('amount', $data['amount']); ?>" onkeyUp="<?php if($id > 0){ ?>processTotal()<?php } else { ?>processTotal()<?php } ?>" id="amount" type="text" class="currency form-control" placeholder="<?php echo $this->lang->line('payment_amount'); ?>">
</div>

<?php if($id > 0){ ?>
<div class="col-md-6">
<input type="hidden" id="paidamt" value="<?php echo  $data['amount']; ?>" />
<label><?php echo $this->lang->line('remaining_amount'); ?></label>
<input value="<?php echo set_value('remaining_amount', $data['remaining_amount']); ?>" name="remaining_amount" readonly id="remaining" type="text" class="currency form-control" >
</div>
<?php } else { ?>	 
<div class="col-md-6"   >
<label><?php echo $this->lang->line('remaining_amount'); ?></label>
<input value="<?php echo set_value('remaining_amount', $data['remaining_amount']); ?>" name="remaining_amount" readonly id="remaining" type="text" class="currency form-control" >
</div>
<?php } ?>

</div>
</div>


<div class="col-md-12" style="padding-top:5px;">
<label><?php echo $this->lang->line('source'); ?><span class="text-red">*</span></label>
<div class="md-radio-inline">
	<div class="md-radio">
		<?php $source = set_value('payment_source', $data['payment_source']); ?>
		<input type="radio" value="cash" id="cash_radio" <?php if($source =="" || $source =='cash'){ ?> checked <?php } ?> name="payment_source" class="md-radiobtn">
		<label for="cash_radio">
			<span></span>
			<span class="check"></span>
			<span class="box"></span> <i class="fa fa-money"></i> <?php echo $this->lang->line('cash'); ?> </label>
	</div>
	<div class="md-radio ">
		<input type="radio" value="credit_card" <?php if($source =='credit_card'){ ?> checked <?php } ?> id="credit_card_radio" name="payment_source" class="md-radiobtn">
		<label for="credit_card_radio">
			<span></span>
			<span class="check"></span>
			<span class="box"></span> <i class="fa fa-credit-card"></i> <?php echo $this->lang->line('credit_card'); ?> </label>
	</div>
	<div class="md-radio">
		<input type="radio" value="debit_card" <?php if($source =='debit_card'){ ?> checked <?php } ?> id="debit_card_radio" name="payment_source" class="md-radiobtn">
		<label for="debit_card_radio">
			<span></span>
			<span class="check"></span>
			<span class="box"></span> <i class="fa fa-cc-visa"></i> <?php echo $this->lang->line('debit_card'); ?> </label>
	</div>
	<div class="md-radio">
		<input type="radio" value="net_banking" <?php if($source =='net_banking'){ ?> checked <?php } ?> id="net_banking_radio" name="payment_source" class="md-radiobtn">
		<label for="net_banking_radio">
			<span></span>
			<span class="check"></span>
			<span class="box"></span> <i class="fa fa-internet-explorer"></i> <?php echo $this->lang->line('net_banking'); ?> </label>
	</div>
 </div>
</div>
             

              

<div class="col-md-12">
	<br />
<label>
<?php echo $this->lang->line('payment_date'); 
	$sdate = set_value('payment_date', $data['payment_date']);
	$test_date = $sdate;
		$test_arr  = explode('/', $test_date);
		if (count($test_arr) == 3) {
			$sdate = $test_arr[2].'-'.$test_arr[1].'-'.$test_arr[0];
		} 
	if ($sdate != "") {
		$sdate = date('d/m/Y', strtotime($sdate));
	}
?> <span class="text-red">*</span>
</label>
<input name="payment_date" readonly value="<?php echo $sdate; ?>" id="payment_date" type="text" class="form-control" placeholder="<?php echo $this->lang->line('payment_date'); ?>" >
</div>


<div class="col-md-12">
	<br />
<label>
<?php echo $this->lang->line('more_payment'); ?> 
<span class="text-red">*</span>
</label>
<div class="md-radio-inline">
	<?php 
	$more = set_value('payment_required', $data['payment_required']);
	?>
                                                <div class="md-radio">
                                                    <input <?php if($more =="" || $more =='yes'){ ?> checked <?php } ?> type="radio" value="yes" id="yes_radio" name="payment_required" class="md-radiobtn" checked="">
                                                    <label for="yes_radio">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Yes </label>
                                                </div>
                                                <div class="md-radio ">
                                                    <input type="radio" <?php if($more =='no'){ ?> checked <?php } ?> value="no" id="no_radio" name="payment_required" class="md-radiobtn">
                                                    <label for="no_radio">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> No </label>
                                                </div>
                                            </div>
</div>




<div class="col-md-12">
<label>
<?php echo $this->lang->line('next_payment'); 
	    $ndate = set_value('next_payment', $data['next_payment'] );
	    $test_date = $ndate;
		$test_arr  = explode('/', $test_date);
		if (count($test_arr) == 3) {
			$ndate = $test_arr[2].'-'.$test_arr[1].'-'.$test_arr[0];
		} 
	
	
	if($ndate != "") {
		$ndate = date('d/m/Y', strtotime($ndate));
	}
?> 
</label>
<input name="next_payment" readonly value="<?php echo $ndate; ?>" id="next_payment" type="text" class="form-control" placeholder="<?php echo $this->lang->line('next_payment'); ?>" >
</div>
                
                
                
                
<div class="col-md-12">
<label><?php echo $this->lang->line('notes'); ?> </label>
   <textarea name="note" id="note" class="form-control" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo set_value('note', $data['note']); ?></textarea>
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
				  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
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
		
		var member_id = $('#member_id').val();
		var subscription = $('#subscription').val();
		var amount = $('#amount').val();		
		var payment_date = $('#payment_date').val();
		
		$('#member_id').css('border-bottom','1px solid #d2d6de');
		$('#subscription').css('border-bottom','1px solid #d2d6de');
		$('#amount').css('border-bottom','1px solid #d2d6de');
		$('#payment_date').css('border-bottom','1px solid #d2d6de');
		$('#next_payment').css('border-bottom','1px solid #d2d6de');
		
		
		var message ='';
		if (member_id == '') {
			$('#member_id').css('border-bottom','1px solid #dd4b39');
			message = message + '<?php echo $this->lang->line('member'); ?><?php echo $this->lang->line('is_required'); ?>';
		}
		if (subscription == '') {
			$('#subscription').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('subscription'); ?><?php echo $this->lang->line('is_required'); ?>';
		}
		if (amount == '' || amount == '0.00') {
			$('#amount').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('payment_amount'); ?><?php echo $this->lang->line('is_required'); ?>';
		}
		
		
		if (payment_date == '') {
			$('#payment_date').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('payment_date'); ?><?php echo $this->lang->line('is_required'); ?>';
		}
		
		if ($('#yes_radio').is(':checked') && $('#next_payment').val() =="") {
			$('#next_payment').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('next_payment'); ?><?php echo $this->lang->line('is_required'); ?>';
		}
		
		if(message !="") {
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
			$.ajax({ dataType: "JSON",  url: "<?php echo site_url('get-user-subscription'); ?>/"+id, success: function(result) {
               if(result.status == 1){
				   $('#subscription').html(result.data);
			   } else {
				   $('#balance').val('0.00');
				   $('#amount').val('0.00');
				   $('#remaining').val('0.00');
				   $('#subscription').html('<option><?php echo $this->lang->line("select"); ?></option>');
				   $('#error_notification').html("<?php echo $this->lang->line('no_subscription'); ?>");
				   $('#error_notification').show();
			   }
			   $.unblockUI(); 
            }});
		} else {
			$('#balance').val('0.00');
			$('#amount').val('0.00');
		    $('#remaining').val('0.00');
			$('#subscription').html('<option><?php echo $this->lang->line("select"); ?></option>');
		}
	}
	
	function getSubscriptionValue(id)
	{
		if (id != "") {
            $.blockUI({ message: '<?php echo $this->lang->line('request_processing'); ?>', css: { background: 'none'} });
			$.ajax({ dataType: "JSON",  url: "<?php echo site_url('get-user-subscription-value'); ?>/"+id, success: function(result) {
               if(result.status == 1){
				   $('#balance').val(result.data);
				   $('#amount').val('0.00');
				   $('#remaining').val(result.data);
			   } else {
				   $('#balance').val('0.00');
				   $('#amount').val('0.00');
				   $('#remaining').val('0.00');
			   }
			   processTotal();
			   $.unblockUI(); 
            }});
		} else {
			 $('#balance').val('0.00');
			$('#amount').val('0.00');
		    $('#remaining').val('0.00');
			 processTotal();
		}
		
	}
	
	
function processTotal() {
	var payment_amount = $('#amount').val();
	var balance = $('#balance').val();	
	var tot = 0;
	
	if (parseFloat(payment_amount) != NaN) {
		tot = parseFloat(balance) - parseFloat(payment_amount);
	}
	
	if (isNaN(tot)) {
	  $('#remaining').val(balance);
	} else if(tot < 1){
	  $('#remaining').val('0.00');
	} else {
	  $('#remaining').val(tot);
	}
	
}


function processNewTotal() {
	var payment_amount = $('#amount').val();
	var ptamount = $('#paidamt').val();
	
	
	var balance = $('#balance').val();	
	var tot = 0;
	
	if (parseFloat(payment_amount) != NaN && parseFloat(ptamount) != NaN) {
		
		if (parseFloat(payment_amount) == parseFloat(ptamount)) {
			tot = parseFloat(balance);
		}
		
		if (parseFloat(payment_amount) < parseFloat(ptamount)) {
			tot = parseFloat(balance) + (parseFloat(ptamount) - parseFloat(payment_amount));
		}
		
		if (parseFloat(payment_amount) > parseFloat(ptamount)) {
			tot = parseFloat(balance) - (parseFloat(payment_amount) - parseFloat(ptamount));
		}
		
	}
	
	if (isNaN(tot)) {
	  $('#remaining').val(balance);
	} else if(tot < 1){
	  $('#remaining').val('0.00');
	} else {
	  $('#remaining').val(tot);
	}
	
}

	$(function () {
		$('#payment_date').datepicker({
		  autoclose: true,
		  format: 'd/mm/yyyy',
		});
		$('#next_payment').datepicker({
		  autoclose: true,
		  format: 'd/mm/yyyy',
		});
		$('.currency').maskMoney({thousands:'', decimal:'.', allowZero:true, suffix: ''});
	});
</script>
