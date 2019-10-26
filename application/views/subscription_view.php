<section class="content-header">
  <h1>
	<?php echo $this->lang->line('subscription'); ?>
	<small><?php echo $this->lang->line('view'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('home'); ?></a></li>
	<li><a href="<?php echo site_url('list-subscriptions'); ?>"><?php echo $this->lang->line('subscriptions'); ?></a></li>
	<li class="active"><?php echo $this->lang->line('subscription'); ?> <?php echo $this->lang->line('view'); ?></li>
  </ol>
</section>

<section class="content">
	
	
	
 

<div class="col-md-12">
	
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('details'); ?></a></li>
              <li><a href="#tab_2" data-toggle="tab"><?php echo $this->lang->line('payments'); ?></a></li>              
            </ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1">
<table class="table table-bordered table-striped">
<tr>
<td><?php echo $this->lang->line('member'); ?></td>
<td> <?php echo ucwords($data['member_name']); ?>  [<?php echo $member['data']['member_id']; ?>]</td>
</tr>
<tr>
<td><?php echo $this->lang->line('membership'); ?></td>
<td><?php echo ucwords($data['membership_name']); ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['fee']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('registration_fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['registration_fee']; ?></td>
</tr>
<tr>
<td><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('fee'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['other_fee']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('total'); ?></td>
<td><?php echo $this->currency; ?> <?php echo $data['total']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('discount'); ?> </td>
<td><?php echo $this->currency; ?> <?php echo $data['discount']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('tot_to_be_paid'); ?> </td>
<td><?php echo $this->currency; ?> <?php echo $data['amount_to_paid']; ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('due'); ?> </td>
<td><?php echo $this->currency; ?> <?php echo $data['amount_due']; ?></td>
</tr>


<?php if ($data['due'] == 'yes') { ?>
<tr>
<td><?php echo $this->lang->line('next_payment'); ?> </td>
<td><?php echo date('d/m/Y',strtotime($data['next_payment'])); ?></td>
</tr>
<?php } ?>


<tr>
<td><?php echo $this->lang->line('subscription_starts'); ?></td>
<td><?php echo date('d/m/Y',strtotime($data['start_date'])); ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('subscription_ends'); ?></td>
<td><?php echo date('d/m/Y',strtotime($data['end_date'])); ?></td>
</tr>

<tr>
<td><?php echo $this->lang->line('notes'); ?></td>
<td><?php echo $data['notes']; ?></td>
</tr>


<?php if ($data['next_payment'] == 'payment_completed') { ?>
<tr>
<td></td>
<td><?php echo $this->lang->line('payment_completed'); ?></td>
</tr>
<?php } ?>

<?php if ($data['next_payment'] == 'no_payment_received') { ?>
<tr>
<td></td>
<td><?php echo $this->lang->line('no_payment_received'); ?></td>
</tr>
<?php } ?>



</table>
         </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
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
                if (count($payments) > 0) { 
				foreach($payments as $key => $row) {	
				?>
                <tr>
                  <td><?php echo substr($row['member_name'],0,15) ; ?></td>
                  <td><?php echo substr($row['subscription_name'],0,10); ?></td>
                  <td>
                    <?php echo $this->currency.' '.$row['amount']; ?>
                  </td>
                   <td>
                    <?php echo $this->lang->line($row['source']); ?>
                  </td>
                   <td>
                    <?php echo date('M d, Y',strtotime($row['payment_date'])); ?>
                  </td>
                  <td>
                    <?php echo $row['transaction_id']; ?>
                  </td>
                   <td>
                    <small class="label <?php if ($row['status'] == 'active'){ ?>bg-green<?php } else { ?>bg-red<?php } ?>"><?php echo  $this->lang->line($row['status']); ?></small>
                  </td>
                  <td style="text-align:center;">				
					  <a title="<?php echo $this->lang->line('view'); ?>" href="<?php echo site_url('view-payment/'.$row['id']); ?>">
					       <button type="button" class="btn btn-success btn-sm" ><i class="fa fa-eye"></i></button>
                      </a>                     
                </td>
                </tr>
                <?php }} else { ?>
                 <tr><td colspan="8"><?php echo $this->lang->line('no_records'); ?></td></tr>
                <?php } ?>
              </tbody>              
              </table>
              </div>

              </div>
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        
      </div>
          <!-- kk -->
              </div>
      <!-- /.box -->
    </section>


<script type="text/javascript">
	
</script>
