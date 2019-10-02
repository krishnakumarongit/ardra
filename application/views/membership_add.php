<script src="<?php echo site_url('theme/js/money.js'); ?>"></script>

<section class="content-header">
  <h1>
	<?php echo $this->lang->line('membership'); ?>
	<small><?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-memberships'); ?>"><?php echo $this->lang->line('memberships'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('membership'); ?> <?php if($id == 0){ echo $this->lang->line('add'); } else { echo $this->lang->line('update'); } ?></li>
  </ol>
</section>

<section class="content">
 

<form method="post" action="<?php echo site_url('add-membership/'.$id); ?>" onsubmit="return validate();">	
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
               <label><?php echo $this->lang->line('name'); ?><span class="text-red">*</span></label>
                <input name="name" value="<?php echo set_value('name', $data['name']); ?>" id="name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('name'); ?>">
                      </div>
              <!-- /.form-group -->
              <div class="form-group">
				    <label><?php echo $this->lang->line('duration'); ?><span class="text-red">*</span></label>
                <input name="duration" value="<?php echo set_value('duration', $data['duration']); ?>" id="duration" type="text" class="form-control" placeholder="<?php echo $this->lang->line('duration'); ?>">
                    </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
				  
                <label><?php echo $this->lang->line('fee'); ?><span class="text-red">*</span></label>
                <input name="fee" value="<?php echo set_value('fee', $data['fee']); ?>" id="fee" type="text" class="currency form-control" placeholder="<?php echo $this->lang->line('fee'); ?>">
                
                    </div>
              <!-- /.form-group -->
              <div class="form-group">
			  <label><?php echo $this->lang->line('duration_type'); ?><span class="text-red">*</span></label>
			  <?php $duration_select = set_value('duration_type', $data['duration_type']); ?>
              <select name="duration_type" id="duration_type"  class="form-control">
               	  <option value=""><?php echo $this->lang->line('select'); ?></option>
               	  <option <?php if ($duration_select == 'day') { ?> selected <?php } ?> value="day"><?php echo $this->lang->line('day'); ?></option>
               	  <option <?php if ($duration_select == 'month') { ?> selected <?php } ?> value="month"><?php echo $this->lang->line('month'); ?></option>
               	  <option <?php if ($duration_select == 'year') { ?> selected <?php } ?> value="year"><?php echo $this->lang->line('year'); ?></option>
               	</select>
                        </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
          
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label><?php echo $this->lang->line('description'); ?><span class="text-red">*</span></label>
                <textarea name="description" id="description" class="form-control" placeholder="<?php echo $this->lang->line('description'); ?>"><?php echo set_value('description', $data['description']); ?></textarea>
                      </div>
              <!-- /.form-group -->
              <div class="form-group">
				      </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
				  
               	<label><?php echo $this->lang->line('status'); ?><span class="text-red">*</span></label>
               	<?php $status_select = set_value('status', $data['status']); ?>		    
               	<select name="status" id="status"  class="form-control">
               	  <option value=""><?php echo $this->lang->line('select'); ?></option>
               	  <option <?php if ($status_select == 'active') { ?> selected <?php } ?>  value="active"><?php echo $this->lang->line('active'); ?></option>
               	  <option <?php if ($status_select == 'in-active') { ?> selected <?php } ?>  value="in-active"><?php echo $this->lang->line('in-active'); ?></option>
               	</select>
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
            <div class="col-md-6">
              <div class="form-group">
                         </div>
              <!-- /.form-group -->
              <div class="form-group">
				  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
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
	
</script>
