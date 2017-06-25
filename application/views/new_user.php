<div class="wrapper">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
			<div style="padding:30px;">
				<h2 class="text-left">Add new user </h2>
				<form>
					<div class="form-group">
						<label class="control-label" for="inputEmail">User ID</label>
						<input class="form-control" type="text" name="email" placeholder="User ID" id="inputEmail">
					</div>
					<div class="form-group">
						<label class="control-label" for="inputPassword">Password </label>
						<input class="form-control" type="password" name="password" placeholder="Password" id="inputPassword">
					</div>
					<div class="form-group">
						<label class="control-label" for="inputFirstName">First Name </label>
						<input class="form-control" type="text" name="first_name" placeholder="First Name" id="inputFirstName">
					</div>
					<div class="form-group">
						<label class="control-label" for="inputLastName">Last Name </label>
						<input class="form-control" type="text" name="last_name" placeholder="Last Name" id="inputLastName">
					</div>
					<div class="form-group">
						<label class="control-label" for="inputContactNumber">Contact Number </label>
						<input class="form-control" type="text" name="contact_no" placeholder="Contact Number" id="inputContactNumber">
					</div>
					<div class="form-group">
						<label class="control-label" for="inputContactNumber">Select Group </label>
						<select class="form-control" name="gid" id="gid" onChange="getexpiry();">
							<?php
							foreach($group_list as $key => $val){
								?>

								<option value="<?php echo $val['gid'];?>"><?php echo $val['group_name'];?> (<?php echo $this->lang->line('price_');?>: <?php echo $val['price'];?>)</option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="su">Account type </label>
						<select class="form-control" name="su" id="su">
							<option value="0" selected="">Student</option>
							<option value="2">Teacher</option>
							<option value="1" selected="">Admin</option>
						</select>
					</div>
					<ul class="list-inline pull-right">
						<li>
							<button class="btn btn-primary" type="button">Submit </button>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
</div>

<!--
<div class="container">

   
 <h3><?php /*echo $title;*/?></h3>
   
 

  <div class="row">
     <form method="post" action="<?php /*echo site_url('user/insert_user/');*/?>">
	
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	
	
	
			<?php
/*		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		*/?>
		
		
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php /*echo $this->lang->line('email_address');*/?></label>
					<input type="text" id="inputEmail" name="email" class="form-control" placeholder="<?php /*echo $this->lang->line('email_address');*/?>" required autofocus>
			</div>
			<div class="form-group">	  
					<label for="inputPassword" class="sr-only"><?php /*echo $this->lang->line('password');*/?></label>
					<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php /*echo $this->lang->line('password');*/?>" required >
			 </div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php /*echo $this->lang->line('first_name');*/?></label>
					<input type="text"  name="first_name"  class="form-control" placeholder="<?php /*echo $this->lang->line('first_name');*/?>"   autofocus>
			</div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php /*echo $this->lang->line('last_name');*/?></label>
					<input type="text"   name="last_name"  class="form-control" placeholder="<?php /*echo $this->lang->line('last_name');*/?>"   autofocus>
			</div>
				<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php /*echo $this->lang->line('contact_no');*/?></label>
					<input type="text" name="contact_no"  class="form-control" placeholder="<?php /*echo $this->lang->line('contact_no');*/?>"   autofocus>
			</div>
            <div class="form-group">
                <label><?php /*echo $this->lang->line('select_group'); */?></label>
                <select class="form-control" name="gid" id="gid" onChange="getexpiry();">
                    <?php
/*                    foreach($group_list as $key => $val){
                        */?>

                        <option value="<?php /*echo $val['gid'];*/?>"><?php /*echo $val['group_name'];*/?> (<?php /*echo $this->lang->line('price_');*/?>: <?php /*echo $val['price'];*/?>)</option>
                        <?php
/*                    }
                    */?>
                </select>
            </div>

            <div class="form-group">
                <label   ><?php /*echo $this->lang->line('account_type');*/?></label>
                <select class="form-control" name="su">
                    <option value="0">Student</option>
                    <option value="2">Teacher</option>
                    <option value="1">Admin</option>
                </select>
            </div>

 
	<button class="btn btn-default" type="submit"><?php /*echo $this->lang->line('submit');*/?></button>
 
		</div>
</div>-->
 
 
 
 
</div>
      </form>
</div>

 



</div>
<script>
getexpiry();
</script>