<section class="content-header">
  <h1>
	Members
	<small>Add</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">Forms</a></li>
	<li class="active">Advanced Elements</li>
  </ol>
</section>

<section class="content">
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

	
<form method="post" action="<?php echo site_url('add-member/'.$id); ?>" onsubmit="return validate();">	
<input type="hidden" name="post_check" value="1" />
	<!----- -->
	<div class="nav-tabs-custom">
            <ul id="tabul" class="nav nav-tabs">
              <li class="active"><a id="ta1" href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('personal_details'); ?></a></li>
              <li class=""><a id="ta2" href="#tab_2" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('contact_information'); ?></a></li>                    
              <li class=""><a id="ta3" href="#tab_3" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('other_details'); ?></a></li>
              <li class=""><a id="ta4" href="#tab_5" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('subscription_details'); ?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('first_name'); ?><span class="text-red">*</span></label>
                <input name="first_name" value="<?php echo set_value('first_name', $data['first_name']); ?>" id="first_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('first_name'); ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php echo $this->lang->line('last_name'); ?><span class="text-red">*</span></label>
                <input name="last_name" value="<?php echo set_value('last_name', $data['last_name']); ?>"  id="last_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('last_name'); ?>">
                </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('middle_name'); ?><span class="text-red"></span></label>
                <input name="middle_name" value="<?php echo set_value('middle_name', $data['middle_name']); ?>" id="middle_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('middle_name'); ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php echo $this->lang->line('sex'); ?><span class="text-red">*</span></label>
                <?php $middle_select = set_value('sex', $data['sex']); ?>
                <select class="form-control" name="sex" id="sex">
					<option value=""><?php echo $this->lang->line('select'); ?></option>
					<option <?php if ($middle_select == 'Male') { ?> selected <?php } ?> value="<?php echo $this->lang->line('male'); ?>"><?php echo $this->lang->line('male'); ?></option>
					<option <?php if ($middle_select == 'Female') { ?> selected <?php } ?> value="<?php echo $this->lang->line('female'); ?>"><?php echo $this->lang->line('female'); ?></option>
				</select>
              </div>
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('dob'); ?><span class="text-red">*</span></label>
				<input name="dob" id="dob" readonly value="<?php echo set_value('dob', $data['dob']); ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('dob'); ?>">
				 </div>
              <!-- /.form-group -->
              <div class="form-group">
				   <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
              <!-- /.form-group -->
            </div>
            
            
            <!-- /.col -->
            <div class="col-md-6">
				<div class="form-group">
					                <label><?php echo $this->lang->line('member_id'); ?><span class="text-red">*</span></label>
				<input name="member_id" value="<?php echo set_value('member_id', $data['member_id']); ?>"  id="member_id" type="text" class="form-control" placeholder="<?php echo $this->lang->line('member_id'); ?>">
				
				</div>
				<!-- /.form-group -->
				<div class="form-group">
					</div>
              <!-- /.form-group -->
            </div>
            
            
            <!-- /.col -->
          </div>
              </div>
              <!-- /.tab-pane -->
<div class="tab-pane" id="tab_2">
		<div class="row">

		<div class="col-md-6">
		<div class="form-group">
			<label><?php echo $this->lang->line('address'); ?></label>
			<textarea name="address"  id="address" type="text" class="form-control" placeholder="<?php echo $this->lang->line('address'); ?>"><?php echo set_value('address', $data['address']); ?></textarea>
		</div>
		<!-- /.form-group -->
		<div class="form-group">
			<label><?php echo $this->lang->line('state'); ?></label>
			<input name="state" value="<?php echo set_value('state', $data['state']); ?>" id="state" type="text" class="form-control" placeholder="<?php echo $this->lang->line('state'); ?>">
		</div>
		<!-- /.form-group -->
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('city'); ?></label>
		<input name="city" id="city" value="<?php echo set_value('city', $data['city']); ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('city'); ?>">
		</div>
		<!-- /.form-group -->
		<div class="form-group">
						 <label><?php echo $this->lang->line('country'); ?></label>
						 <?php  $country_select = set_value('country', $data['country']); ?>
		<select class="form-control" name="country" id="country">
			<option value=""><?php echo $this->lang->line('select'); ?></option>
			<?php foreach($country as $row => $val){ ?>
			<option <?php if ($country_select == $val->country_name) { ?> selected <?php } ?> value="<?php echo $val->country_name; ?>"><?php echo $val->country_name; ?></option>
			
			<?php } ?>
		</select>
		</div>
		<!-- /.form-group -->
		</div>
		</div>
		<div class="row">
		<!-- /.col -->
		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('zip_code'); ?></label>
		<input name="zip_code" id="zip_code" value="<?php echo set_value('zip_code', $data['zip_code']); ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('zip_code'); ?>">
		</div>
		<!-- /.form-group -->
		<div class="form-group">
		<label><?php echo $this->lang->line('email'); ?> </label>
		<input name="email" id="email" value="<?php echo set_value('email', $data['email']); ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>">
		</div>
		<!-- /.form-group -->
		</div>
				<!-- /.col -->

		<div class="col-md-6">
		<!-- /.form-group -->
		<div class="form-group">
		<label><?php echo $this->lang->line('work_phone'); ?></label>
		<input name="work_phone" value="<?php echo set_value('work_phone', $data['work_phone']); ?>" id="work_phone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('work_phone'); ?>">
		</div>
		<div class="form-group">
		<label><?php echo $this->lang->line('home_phone'); ?></label>
		<input name="home_phone" value="<?php echo set_value('home_phone', $data['home_phone']); ?>"  id="home_phone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('home_phone'); ?>">

		</div>
		<!-- /.form-group -->
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('emmergency_contact_name'); ?></label>
		<input name="emmergency_contact_name" value="<?php echo set_value('emmergency_contact_name', $data['emmergency_contact_name']); ?>"  id="emmergency_contact_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_name'); ?>">
		</div>
		<!-- /.form-group -->
		<div class="form-group">
		</div>
		<!-- /.form-group -->
		</div>
				<!-- /.col -->

		<div class="col-md-6">
		<!-- /.form-group -->
		<div class="form-group">
		<label><?php echo $this->lang->line('emmergency_contact_number'); ?></label>
		<input name="emmergency_contact_number" value="<?php echo set_value('emmergency_contact_number', $data['emmergency_contact_number']); ?>" id="emmergency_contact_number" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_number'); ?>">
		</div>
		<div class="form-group">
		</div>
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		
		<div class="col-md-6">
		<div class="form-group">
		</div>
		<!-- /.form-group -->
		<div class="form-group">
		 <button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		</div>
</div>
<!-- /.tab-pane 3-->
<div class="tab-pane" id="tab_3">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('idcard'); ?></label>
			<input name="idcard" id="idcard" value="<?php echo set_value('idcard', $data['idcard']); ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('idcard'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('lisence'); ?></label>
			<input name="lisence" value="<?php echo set_value('lisence', $data['lisence']); ?>"  id="lisence" type="text" class="form-control" placeholder="<?php echo $this->lang->line('lisence'); ?>">
			</div>
		</div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('disability_declared'); ?></label>
			<input name="disability" value="<?php echo set_value('disability', $data['disability']); ?>"  id="disability" type="text" class="form-control" placeholder="<?php echo $this->lang->line('disability_declared'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('disability_note'); ?></label>
			<textarea name="disability_note" id="disability_note" class="form-control" placeholder="<?php echo $this->lang->line('disability_note'); ?>"><?php echo set_value('disability_note', $data['disability_note']); ?></textarea>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('source'); ?></label>
			<input name="source" id="source" value="<?php echo set_value('source', $data['source']); ?>"  type="text" class="form-control" placeholder="<?php echo $this->lang->line('source'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('source_note'); ?></label>
			<textarea name="source_note" value="<?php echo set_value('source_note', $data['source_note']); ?>"   id="source_note" class="form-control" placeholder="<?php echo $this->lang->line('source_note'); ?>"><?php echo set_value('source', $data['source']); ?></textarea>
			</div>
		</div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			</div>
	    </div>
</div>
</div>


<div class="tab-pane" id="tab_5">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			  </div>
		</div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			</div>
	    </div>
</div>
		
		
		
	  </div>
<!-- /.tab-pane ending-->






      </div>
       <!-- /.tab-content -->
      </div>
	<!---- -->

 </form>
      <!-- /.box -->
    </section>


<script type="text/javascript">
	function validate() {
		$('#error_notification').html('');
		$('#error_notification').hide();
		var first_name = $('#first_name').val();
		var last_name = $('#last_name').val();
		var sex = $('#sex').val();
		var dob = $('#dob').val();
		var member_id = $('#member_id').val();
		
		
		$('#first_name').css('border-bottom','1px solid #d2d6de');
		$('#last_name').css('border-bottom','1px solid #d2d6de');
		$('#sex').css('border-bottom','1px solid #d2d6de');
		$('#dob').css('border-bottom','1px solid #d2d6de');
		$('#member_id').css('border-bottom','1px solid #d2d6de');
		
		var message ='';
		if (first_name == '') {
			$('#first_name').css('border-bottom','1px solid #dd4b39');
			message = message + '<?php echo $this->lang->line('first_name'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		if (last_name == '') {
			$('#last_name').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('last_name'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		if (sex == '') {
			$('#sex').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('sex'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		if (dob == '') {
			$('#dob').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('dob'); ?> <?php echo $this->lang->line('is_required'); ?>';
		}
		if (member_id == '') {
			$('#member_id').css('border-bottom','1px solid #dd4b39');
			message = message + '<br /> <?php echo $this->lang->line('member_id'); ?> <?php echo $this->lang->line('is_required'); ?>';
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
		$('#dob').datepicker({
		  autoclose: true,
		  format: 'd/mm/yyyy'
		});
	});
</script>
