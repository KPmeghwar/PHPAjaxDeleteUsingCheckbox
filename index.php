<?php
include('db.php');
$res=mysqli_query($con,"select * from student");
?>
<a href="javascript:void(0)" class="link_delete" onclick="delete_all()">Delete</a>
<form method="post" id="frm">
	<table id="customers">
		<tr>
			<th width="15%"><input type="checkbox" onclick="select_all()"  id="delete"/></th>
			<th width="15%">ID</th>
			<th width="70%">Name</th>
		</tr>
		<?php
		while($row=mysqli_fetch_assoc($res)){
			?>
			<tr id="box<?php echo $row['id']?>">
				<td><input type="checkbox" id="<?php echo $row['id']?>" name="checkbox[]" value="<?php echo $row['id']?>"/></td>
				<td><?php echo $row['id']?></td>
				<td><?php echo $row['name']?></td>
			</tr>
			<?php
		}
		?>
	</table>
</form>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  ></script>
<script>
function select_all(){
	if(jQuery('#delete').prop("checked")){
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',true);
		});
	}else{
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',false);
		});
	}
}

function delete_all(){
	var check=confirm("Are you sure?");
	if(check==true){
		jQuery.ajax({
			url:'delete.php',
			type:'post',
			data:jQuery('#frm').serialize(),
			success:function(result){
				jQuery('input[type=checkbox]').each(function(){
					if(jQuery('#'+this.id).prop("checked")){
						jQuery('#box'+this.id).remove();
					}
				});
			}
		});
	}
}
</script>

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 30%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
#frm{
	margin-top:10px;
}
.link_delete{
	font-size: 20px;
    color: black;
    font-family: arial;
}
</style>