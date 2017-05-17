<?php $level_list = $user_model->getCollection('savsoft_level'); ?>
<div class="container">

   
 <h3><?php echo $title;?></h3>


  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		<div id="message"></div>
		
		 <form method="post" action="<?php echo site_url('user/insert_group/');?>">
             <table class="table table-bordered">
                 <tr>
                     <td>
                         <input type="text"   class="form-control"   name="group_name" value="" placeholder="Section Name"  required >
                     </td>
                     <td>
                         <select class="form-control" name="level">
                             <option value="0">Select Year/Level</option>
                             <?php foreach ($level_list as $lvl): ?>
                                 <option value="<?php echo $lvl['lid']; ?>"><?php echo $lvl['level_name']; ?></option>
                             <?php endforeach; ?>
                         </select>
                     </td>
                     <td>
                         <button class="btn btn-default" type="submit"><?php echo $this->lang->line('add_new');?></button>
                     </td>
                 </tr>
             </table>
         </form>
	
<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('group_name');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($group_list)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($group_list as $key => $val){
?>
<tr>
 <td><input disabled type="text"   class="form-control"  value="<?php echo $val['group_name'];?>" onBlur="updategroup(this.value,'<?php echo $val['gid'];?>');" ></td>

 <input type="hidden"      value="0" onBlur="updategroupprice(this.value,'<?php echo $val['gid'];?>');" >

 <input type="hidden"   class="form-control"  value="0" onBlur="updategroupvalid(this.value,'<?php echo $val['gid'];?>');" >
<td>
<a href="javascript:remove_entry('user/remove_group/<?php echo $val['gid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>
</tr>

<?php 
}
?>
</table>
</div>

</div>



</div>