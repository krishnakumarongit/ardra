<script src="<?php echo site_url('theme/js/money.js'); ?>"></script>

<section class="content-header">
  <h1>
	<?php echo $this->lang->line('invoice'); ?>
	<small><?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-invoice'); ?>"><?php echo $this->lang->line('invoices'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('invoice'); ?> <?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></li>
  </ol>
</section>

<section class="content">
 

<form method="post" action="<?php echo site_url('add-invoice/'.$id); ?>" onsubmit="return validate();">	
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
               <label><?php echo $this->lang->line('bill_to'); ?><span class="text-red">*</span></label>
                <input name="client_name" value="<?php echo set_value('client_name', ''); ?>" id="client_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('bill_to'); ?>">
                      </div>
              <!-- /.form-group -->
              <div class="form-group">
				 <label><?php echo $this->lang->line('client_email'); ?><span class="text-red">*</span></label>
                <input name="client_email" value="<?php echo set_value('client_email', ''); ?>" id="client_email" type="text" class="form-control" placeholder="<?php echo $this->lang->line('client_email'); ?>">
               
				    </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
				      <label><?php echo $this->lang->line('invoice_date'); ?><span class="text-red">*</span></label>
                <input name="invoice_date" readonly value="<?php echo set_value('invoice_date', ''); ?>" id="invoice_date" type="text" class="form-control" placeholder="<?php echo $this->lang->line('invoice_date'); ?>">
                
                
                    </div>
              <!-- /.form-group -->
              <div class="form-group">
			  <label><?php echo $this->lang->line('client_mobile'); ?><span class="text-red">*</span></label>
                <input name="mobile" value="<?php echo set_value('mobile', ''); ?>" id="mobile" type="text" class="form-control" placeholder="<?php echo $this->lang->line('client_mobile'); ?>">
               
                        </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label><?php echo $this->lang->line('client_address'); ?><span class="text-red">*</span></label>
               <textarea name="address" id="address" class="form-control" placeholder="<?php echo $this->lang->line('client_address'); ?>"></textarea>
                      </div>
              <!-- /.form-group -->
              <div class="form-group">
				      </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
           
          </div>
          <!-- /.row -->
          
          
           <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
				<tr>
                  <th><?php echo $this->lang->line('item'); ?></th>
                  <th><?php echo $this->lang->line('quantity'); ?></th>
                  <th><?php echo $this->lang->line('rate'); ?></th>
                  <th><?php echo $this->lang->line('amount'); ?></th>  
                </tr>
                 <tr>
                  <td><input type="text"></td>
                  <td><input type="text"></td>
                  <td><input type="text"></td>
                   <td><input type="text"></td>
                   </tr>
                </tbody>              
              </table>
              
              <table class="table">
                <tbody>
				
                  <tr>
                  <td><input  style="visibility:hidden;" type="text"></td>
                  <td><input style="visibility:hidden;" type="text"></td>
                  <td><input style="visibility:hidden;"  type="text"></td>
                   <td style="text-align:right;"><?php echo $this->currency." ".$this->lang->line('discount'); ?><br /><input type="text"></td>
                </tr>
                <tr>
                  <td><input style="visibility:hidden;"  type="text"></td>
                  <td><input style="visibility:hidden;" type="text"></td>
                  <td><input style="visibility:hidden;" type="text"></td>
                   <td style="text-align:right;"><?php echo $this->currency." ".$this->lang->line('tax'); ?><br /><input type="text"></td>
                </tr>
                 <tr>
                  <td><input style="visibility:hidden;" type="text"></td>
                  <td><input style="visibility:hidden;" type="text"></td>
                  <td><input style="visibility:hidden;"  type="text"></td>
                   <td style="text-align:right;"><?php echo $this->currency." ".$this->lang->line('total_single'); ?><br /><input type="text"></td>
                </tr>
               </tbody>              
              </table>
              </div>
              
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          
          
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                         </div>
              <!-- /.form-group -->
              <div class="form-group">
				  <button type="submit" class="btn btn-primary pull-right"><?php echo $this->lang->line('submit'); ?></button>
                    </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
				  
              
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
        <div class="box-footer">
          <?php echo $this->lang->line('fields_required'); ?>
        </div>
      </div>
          <!-- kk -->
                
                
                
                
              </div>
	
</form>
      <!-- /.box -->
      <div style="clear:both;"></div>
    </section>


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
	
	$(function () {
		$('.currency').maskMoney({thousands:'', decimal:'.', allowZero:true, suffix: ''});
	});
	
	


$(function () {
	$('#invoice_date').datepicker({
	  autoclose: true,
	  format: 'd/mm/yyyy',
	  orientation: "bottom auto"
	});

});	
	
</script>
