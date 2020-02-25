<table class="table table-bordered table-strip">
<thead>
	<tr>
		<th width="2">#</th>
		<th>location_name</th>
		<th width="100">status</th>
	</tr>	
</thead>
<tbody>


<?php
    $n=1;
          foreach($resultLocation->result() AS $data){ 
		   ?>
		<tr> 
			<td><?php echo $n?></td>
			<td>
			<span class="text-primary" style="font-weight: bold">
			<?php  echo $data->place_name_en?>
			<?php  //echo '<br>'.$data->partner_check_in_location?>
			</span>	
			
			</td>
		    <td>
				imported
			</td>
		</tr> 	  
		<?php
		 $n++;	}

?>
</tbody>	
</table>


<script>
	$('.sk-three-bounce').css('display','none');
</script>