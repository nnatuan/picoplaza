<?php
	$this->load->view('excel_header1');
?>
<h1 style="text-align:center;font-size:16px;"><?php echo $lbl_form_title; ?></h1>
<table width="100%" border="1" >
	<thead>
		<tr>
			<th width="150px"> 										
				<?php echo $lbl_nid ?>			</th>
			<th width="150px"> 
				<?php echo $lbl_banner_images?>		</th>
			<th width="200px"> 
				<?php echo $lbl_status ?>		</th>
			<th> 
				<?php echo $lbl_user01; ?>			</th>
			<th width="150px"> 
				<?php echo $lbl_date01; ?>			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($data_view as $data):
		?>
		<tr>
			<td><?php echo Fview_text($data['nid']) ; ?> </td>
			<td><?php echo Fview_text($data['cbanner_images']); ?></td>
			<td><?php echo Fview_text($data['nstatus']) ; ?></td>
			<td><?php echo Fview_text($data['nid_user01']) ; ?></td>
			<td><?php echo Fview_date($data['ddate01']) ; ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
