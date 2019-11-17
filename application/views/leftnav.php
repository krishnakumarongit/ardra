    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">&nbsp;</li>
        
        <li class="treeview  <?php if(isset($this->member_menu) && $this->member_menu == 'active'){ ?> menu-open<?php } ?>" <?php if(isset($this->member_menu) && $this->member_menu == 'active'){ ?> style="height:auto;" <?php } ?>>
          <a href="#">
            <i class="fa  fa-users"></i> <span><?php echo $this->lang->line('members'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if(isset($this->member_menu) && $this->member_menu == 'active'){ ?> style="display:block" <?php } ?>>
            <li class="<?php if(isset($this->member_list_menu) && $this->member_list_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-members'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('member'); ?> <?php echo $this->lang->line('list'); ?></a></li>
            <li class="<?php if(isset($this->member_add_menu) && $this->member_add_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('add-member'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('member'); ?></a></li>
          </ul>
          
        
        <li class="treeview  <?php if(isset($this->membership_menu) && $this->membership_menu == 'active'){ ?> menu-open<?php } ?>" <?php if(isset($this->membership_menu) && $this->membership_menu == 'active'){ ?> style="height:auto;" <?php } ?>>
          <a href="#">
            <i class="fa  fa-briefcase"></i> <span><?php echo $this->lang->line('memberships'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if(isset($this->membership_menu) && $this->membership_menu == 'active'){ ?> style="display:block" <?php } ?>>
            <li class="<?php if(isset($this->membership_list_menu) && $this->membership_list_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-memberships'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('membership'); ?> <?php echo $this->lang->line('list'); ?></a></li>
            <li class="<?php if(isset($this->membership_add_menu) && $this->membership_add_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('add-membership'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('membership'); ?></a></li>
          </ul>
        </li>
        
        
        
        <li class="treeview  <?php if(isset($this->subscription_menu) && $this->subscription_menu == 'active'){ ?> menu-open<?php } ?>" <?php if(isset($this->subscription_menu) && $this->subscription_menu == 'active'){ ?> style="height:auto;" <?php } ?>>
          <a href="#">
            <i class="fa  fa-random"></i> <span><?php echo $this->lang->line('subscriptions'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if(isset($this->subscription_menu) && $this->subscription_menu == 'active'){ ?> style="display:block" <?php } ?>>
            <li class="<?php if(isset($this->subscription_list_menu) && $this->subscription_list_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-subscriptions'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('subscription'); ?> <?php echo $this->lang->line('list'); ?></a></li>
            <li class="<?php if(isset($this->subscription_add_menu) && $this->subscription_add_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('add-subscription'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('subscription'); ?></a></li>
          </ul>
        </li>
        
        
        
        
         <li class="treeview  <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> menu-open<?php } ?>" <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> style="height:auto;" <?php } ?>>
          <a href="#">
            <i class="fa  fa-money"></i> <span><?php echo $this->lang->line('payments'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> style="display:block" <?php } ?>>
            <li class="<?php if(isset($this->payment_list_menu) && $this->payment_list_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-payment'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('list'); ?></a></li>
            <li class="<?php if(isset($this->payment_add_menu) && $this->payment_add_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('add-payment'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('payment'); ?></a></li>
             <li class="<?php if(isset($this->payment_duelist_menu) && $this->payment_duelist_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-due-payment'); ?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('due')." ".$this->lang->line('payments'); ?></a></li>
          </ul>
        </li>
        
        
        
         <li class="treeview  <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> menu-open<?php } ?>" <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> style="height:auto;" <?php } ?>>
          <a href="#">
            <i class="fa fa-sticky-note"></i> <span><?php echo $this->lang->line('invoices'); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"  <?php if(isset($this->payment_menu) && $this->payment_menu == 'active'){ ?> style="display:block" <?php } ?>>
            <li class="<?php if(isset($this->payment_list_menu) && $this->payment_list_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('list-payment'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('invoice'); ?> <?php echo $this->lang->line('list'); ?></a></li>
            <li class="<?php if(isset($this->payment_add_menu) && $this->payment_add_menu == 'active'){ ?> active<?php } ?>"><a href="<?php echo site_url('add-payment'); ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('invoice'); ?></a></li>
          </ul>
        </li>
            
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
