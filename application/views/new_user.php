<div class="container">


	<h3><?php echo $title;?></h3>



	<div class="row">
		<form method="post" action="<?php echo site_url('user/insert_user/');?>">

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
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label>
							<input type="text" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
							<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php echo $this->lang->line('password');?>" required >
						</div>
						<div class="form-group">
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('first_name');?></label>
							<input type="text"  name="first_name"  class="form-control" placeholder="<?php echo $this->lang->line('first_name');?>"   autofocus>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('last_name');?></label>
							<input type="text"   name="last_name"  class="form-control" placeholder="<?php echo $this->lang->line('last_name');?>"   autofocus>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label>
							<input type="text" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
						</div>
						<div class="form-group">
							<label>Select Section</label>
							<select class="form-control" name="gid" id="gid" onChange="getexpiry();">
								<?php
								foreach($group_list as $key => $val){
									?>

									<option value="<?php echo $val['gid'];?>"><?php echo $val['group_name'];?> </option>
									<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label   ><?php echo $this->lang->line('account_type');?></label>
							<select class="form-control" name="su">
								<option value="0">Student</option>
								<option value="2">Teacher</option>
								<option value="1">Admin</option>
							</select>
						</div>


						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>

					</div>
				</div>




			</div>
		</form>
	</div>





</div>
<script>
	getexpiry();
</script>