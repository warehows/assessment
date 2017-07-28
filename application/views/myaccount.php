 <div class="container">


 <h3><?php echo $title;?></h3>



  <div class="row">
     <form method="post" action="<?php echo site_url('user/update_user/'.$uid);?>">

<div class="col-md-8">
<br>
 <div class="login-panel panel panel-default">
		<div class="panel-body">



			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>

				<div class="form-group">
				<?php echo $this->lang->line('group_name');?>: <?php echo $result['group_name'];?> (<?php echo $this->lang->line('price_');?>: <?php echo $result['price'];?>)
				</div>


				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label>
					<input type="text" id="inputEmail" name="email" value="<?php echo $result['email'];?>" readonly=readonly class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
			</div>

            <div class="form-group">
                <input id="changePassword" type="checkbox" name="changePassword" value="1"><span>Change Password</span>
            </div>
			<div class="form-group" id="passwordFields" style="display:none">
					<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
					<input type="password" id="confirmOldPassword" name="oldpassword" class="form-control" placeholder="Confirm Old Password"   >
					<input type="password" id="inputPassword" name="password"   value=""  class="form-control" placeholder="<?php echo $this->lang->line('password');?>"   >
			 </div>
            <script>
                jQuery(document).ready(function() {
                    jQuery("#changePassword").change(function() {
                        <?php if($result['su'] == 1): ?>
                        jQuery('#passwordFields').show();
                        jQuery('#passwordFields').remove();
                        jQuery('#changePassword').remove();
                        <?php endif; ?>
                        if(this.checked) {
                        jQuery('#passwordFields').show();

                        }else{
                            jQuery('#passwordFields').hide();
                        }
                    });

                });
            </script>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label>
					<input type="text"  name="first_name"  class="form-control"  value="<?php echo $result['first_name'];?>"  placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label>
					<input type="text"   name="last_name"  class="form-control"  value="<?php echo $result['last_name'];?>"  placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
			</div>
				<div class="form-group">
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label>
					<input type="text" name="contact_no"  class="form-control"  value="<?php echo $result['contact_no'];?>"  placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
			</div>


	<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>

		</div>
</div>




</div>
      </form>
</div>



<div class="row">
<div class="col-md-8">
<h3><?php echo $this->lang->line('payment_history');?></h3>
<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('payment_gateway');?></th>
<th><?php echo $this->lang->line('paid_date');?> </th>
<th><?php echo $this->lang->line('amount');?></th>
<th><?php echo $this->lang->line('transaction_id');?> </th>
<th><?php echo $this->lang->line('status');?> </th>
</tr>
<?php
if(count($payment_history)==0){
	?>
<tr>
 <td colspan="5"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}
foreach($payment_history as $key => $val){
?>
<tr>
 <td><?php echo $val['payment_gateway'];?></td>
 <td><?php echo date('Y-m-d H:i:s',$val['paid_date']);?></td>
 <td><?php echo $val['amount'];?></td>
 <td><?php echo $val['transaction_id'];?></td>
 <td><?php echo $val['payment_status'];?></td>

</tr>

<?php
}
?>
</table>

</div>

</div>






</div>