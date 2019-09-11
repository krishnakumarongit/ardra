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
	
	<!----- -->
	<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('personal_details'); ?></a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('contact_information'); ?></a></li>
                       
             <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('other_details'); ?></a></li>
             
              <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false"><?php echo $this->lang->line('identification_details'); ?></a></li>
            
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('first_name'); ?><span class="text-red">*</span></label>
                <input name="first_name" id="first_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('first_name'); ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php echo $this->lang->line('last_name'); ?><span class="text-red">*</span></label>
                <input name="last_name" id="last_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('last_name'); ?>">
                </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('middle_name'); ?><span class="text-red"></span></label>
                <input name="middle_name" id="middle_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('middle_name'); ?>">
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
            
            <div class="col-md-6">
              <div class="form-group">
                <label><?php echo $this->lang->line('dob'); ?></label>
				<input name="dob" id="dob" type="text" class="form-control" placeholder="<?php echo $this->lang->line('dob'); ?>">
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
					                <label><?php echo $this->lang->line('member_id'); ?></label>
				<input name="member_id" id="member_id" type="text" class="form-control" placeholder="<?php echo $this->lang->line('member_id'); ?>">
				
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
			<textarea name="address" id="address" type="text" class="form-control" placeholder="<?php echo $this->lang->line('address'); ?>"></textarea>
		</div>
		<!-- /.form-group -->
		<div class="form-group">
			<label><?php echo $this->lang->line('state'); ?></label>
			<input name="state" id="state" type="text" class="form-control" placeholder="<?php echo $this->lang->line('state'); ?>">
		</div>
		<!-- /.form-group -->
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('city'); ?></label>
		<input name="city" id="city" type="text" class="form-control" placeholder="<?php echo $this->lang->line('city'); ?>">
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
		</div>
		<div class="row">
		<!-- /.col -->
		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('zip_code'); ?></label>
		<input name="zip_code" id="zip_code" type="text" class="form-control" placeholder="<?php echo $this->lang->line('zip_code'); ?>">
		</div>
		<!-- /.form-group -->
		<div class="form-group">
		<label><?php echo $this->lang->line('email'); ?> </label>
		<input name="email" id="email" type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>">
		</div>
		<!-- /.form-group -->
		</div>
				<!-- /.col -->

		<div class="col-md-6">
		<!-- /.form-group -->
		<div class="form-group">
		<label><?php echo $this->lang->line('work_phone'); ?></label>
		<input name="work_phone" id="work_phone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('work_phone'); ?>">
		</div>
		<div class="form-group">
		<label><?php echo $this->lang->line('home_phone'); ?></label>
		<input name="home_phone" id="home_phone" type="text" class="form-control" placeholder="<?php echo $this->lang->line('home_phone'); ?>">

		</div>
		<!-- /.form-group -->
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label><?php echo $this->lang->line('emmergency_contact_name'); ?></label>
		<input name="emmergency_contact_name" id="emmergency_contact_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_name'); ?>">
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
		<input name="emmergency_contact_number" id="emmergency_contact_number" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_number'); ?>">
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
		</div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('disability_declared'); ?></label>
			<input name="disability_declared" id="disability_declared" type="text" class="form-control" placeholder="<?php echo $this->lang->line('disability_declared'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('disability_note'); ?></label>
			<textarea name="disability_note" id="disability_note" class="form-control" placeholder="<?php echo $this->lang->line('disability_note'); ?>"></textarea>
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('source'); ?></label>
			<input name="source" id="source" type="text" class="form-control" placeholder="<?php echo $this->lang->line('source'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('source_note'); ?></label>
			<textarea name="source_note" id="source_note" class="form-control" placeholder="<?php echo $this->lang->line('source_note'); ?>"></textarea>
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
			<label><?php echo $this->lang->line('emmergency_contact_name'); ?></label>
			<input name="emmergency_contact_name" id="emmergency_contact_name" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emmergency_contact_name'); ?>">
			</div>
		<!-- /.form-group -->
		<!-- /.form-group -->
		</div>
		<!-- /.col -->
		<div class="col-md-6">
			<div class="form-group">
			<label><?php echo $this->lang->line('emergency_contact_number'); ?></label>
			<input name="emergency_contact_number" id="emergency_contact_number" type="text" class="form-control" placeholder="<?php echo $this->lang->line('emergency_contact_number'); ?>">
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

 
      <!-- /.box -->
    </section>
