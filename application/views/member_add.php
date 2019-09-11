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

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
		  <div class="box-header with-border">
              <?php echo $this->lang->line('mandatory'); ?>
            </div>

        <!-- /.box-header -->
        <div class="box-body" style="">
			
	 <div class="box-header with-border" style="margin-bottom:8px;">
              <?php echo $this->lang->line('personal_details'); ?>
              
            </div>
            
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('full_name'); ?><span class="text-red">*</span></label>
                <input name="fullname" id="fullname" type="text" class="form-control" placeholder="<?php echo $this->lang->line('full_name'); ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php echo $this->lang->line('sex'); ?><span class="text-red">*</span></label>
                <select class="form-control" name="sex" id="sex">
					<option value=""><?php echo $this->lang->line('select'); ?></option>
					<option value="<?php echo $this->lang->line('male'); ?>"><?php echo $this->lang->line('male'); ?></option>
					<option value="<?php echo $this->lang->line('female'); ?>"><?php echo $this->lang->line('female'); ?></option>
				</select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                 <label><?php echo $this->lang->line('dob'); ?></label>
                <input name="dob" id="dob" type="text" class="form-control" placeholder="<?php echo $this->lang->line('dob'); ?>">
            
                     </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php echo $this->lang->line('address'); ?></label>
                <textarea name="address" id="address" type="text" class="form-control" placeholder="<?php echo $this->lang->line('address'); ?>"></textarea>
             </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- repeat -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('city'); ?></label>
                <input name="city" id="city" type="text" class="form-control" placeholder="<?php echo $this->lang->line('city'); ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                 <label><?php echo $this->lang->line('state'); ?></label>
                <input name="state" id="state" type="text" class="form-control" placeholder="<?php echo $this->lang->line('state'); ?>">
               </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                  <label><?php echo $this->lang->line('zip_code'); ?></label>
                <input name="zip_code" id="zip_code" type="text" class="form-control" placeholder="<?php echo $this->lang->line('zip_code'); ?>">
                    </div>
              <!-- /.form-group -->
              <div class="form-group">
               <label><?php echo $this->lang->line('country'); ?></label>
                <select class="form-control" name="country" id="country">
					<option value=""><?php echo $this->lang->line('select'); ?></option>
					<option value="<?php echo $this->lang->line('male'); ?>"><?php echo $this->lang->line('male'); ?></option>
					<option value="<?php echo $this->lang->line('female'); ?>"><?php echo $this->lang->line('female'); ?></option>
				</select>
               </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          
          <!-- end repeat -->
          
<!-- repeat -->
<div class="row">
<div class="col-md-6">
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('email'); ?> <span class="text-red">*</span></label>
<input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>">

</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('work_phone'); ?></label>
<input name="work_phone" id="work_phone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('work_phone'); ?>">
</div>
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('home_phone'); ?></label>
<input name="home_pone" id="home_pone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('home_phone'); ?>">

</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
</div>

<!-- end repeat -->
 <div class="box-header with-border" style="margin-bottom:8px;">
              <?php echo $this->lang->line('identification_details'); ?>
              
            </div>


<!-- repeat -->
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('idcard'); ?></label>
<input name="idcard" id="idcard" type="text" class="form-control" placeholder="<?php echo $this->lang->line('idcard'); ?>">

</div>
<!-- /.form-group -->
<!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('lisence'); ?></label>
<input name="lisence" id="lisence" type="text" class="form-control" placeholder="<?php echo $this->lang->line('lisence'); ?>">
</div>
<!-- /.form-group -->

<!-- /.form-group -->
</div>
<!-- /.col -->
</div>

<!-- end repeat -->

<!-- repeat -->
 <div class="box-header with-border" style="margin-bottom:8px;">
              <?php echo $this->lang->line('emergency_contact'); ?>
              
            </div>


<!-- repeat -->
<div class="row">
<div class="col-md-6">
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('emmergency_contact_name'); ?></label>
<input name="emmergency_contact_name" id="emmergency_contact_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_name'); ?>">

</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('emmergency_contact_number'); ?></label>
<input name="emmergency_contact_number" id="emmergency_contact_number" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_number'); ?>">

</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
</div>


<div class="box-header with-border" style="margin-bottom:8px;">
</div>
         
<!-- repeat -->
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('disability_declared'); ?></label>
<select class="form-control" name="disability_declared" id="disability_declared">
	<option value=""><?php echo $this->lang->line('select'); ?></option>
	<option value="<?php echo $this->lang->line('yes'); ?>"><?php echo $this->lang->line('yes'); ?></option>
	<option value="<?php echo $this->lang->line('no'); ?>"><?php echo $this->lang->line('no'); ?></option>
</select>
</div>
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('source'); ?></label>
<input name="source" id="source" type="text" class="form-control" placeholder="<?php echo $this->lang->line('source'); ?>">

</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('disability_note'); ?></label>
<textarea name="disability_note" id="disability_note" class="form-control" placeholder="<?php echo $this->lang->line('disability_note'); ?>"></textarea>
</div>
<!-- /.form-group -->
<div class="form-group">
<label><?php echo $this->lang->line('source_note'); ?></label>
<textarea name="source_note" id="source_note" class="form-control" placeholder="<?php echo $this->lang->line('source_note'); ?>"></textarea>
</div>
<!-- /.form-group -->
</div>
<!-- /.col -->
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label><?php echo $this->lang->line('status'); ?> <span class="text-red">*</span></label>
<select class="form-control" name="status" id="status">
	<option value=""><?php echo $this->lang->line('select'); ?></option>
	<option value="<?php echo $this->lang->line('active'); ?>"><?php echo $this->lang->line('active'); ?></option>
	<option value="<?php echo $this->lang->line('in-active'); ?>"><?php echo $this->lang->line('in-active'); ?></option>
</select>
</div>
</div>

</div>
          
          
        </div>
        <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->
    </section>
