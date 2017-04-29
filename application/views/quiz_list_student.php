 <div class="container">
     <h1>Students Quiz List</h1>
<?php
$logged_in=$this->session->userdata('logged_in');


			?>

 <h3><?php echo $title;?></h3>
    <?php
	if($logged_in['su']=='1'){
		?>
		<div class="row">

  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('quiz/index/0/'.$list_view);?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>


    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
  <p style="float:right;">
  <?php
  if($list_view=='grid'){
	  ?>
	  <a href="<?php echo site_url('quiz/index/'.$limit.'/table');?>"><?php echo $this->lang->line('table_view');?></a>
	  <?php
  }else{
	  ?>
	   <a href="<?php echo site_url('quiz/index/'.$limit.'/grid');?>"><?php echo $this->lang->line('grid_view');?></a>

	  <?php
  }
  ?>
  </p>

  </div>
</div><!-- /.row -->

<?php
	}
?>

  <div class="row">

<div class="col-md-12">
<br>
			<?php
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		?>

<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
<th><?php echo $this->lang->line('noq');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php
if(count($result)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>


	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['quid'];?></td>
 <td><?php echo substr(strip_tags($val['quiz_name']),0,50);?></td>
<td><?php echo $val['noq'];?></td>
 <td>
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>

<?php
if($logged_in['su']=='1'){
	?>

<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php
}
?>
</td>
</tr>

<?php
}
?>
</table>




</div>

</div>
<br><br>

<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('quiz/index/'.$back.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('quiz/index/'.$next.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>

</div>