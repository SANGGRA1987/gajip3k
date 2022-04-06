<table >
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
		</tr>
	</thead>
	<?php foreach ($results as $key): ?>
		<tr>
			<td><?php echo $key->kode; ?></td>
			<td><?php echo $key->nama; ?></td>
			<td><?php echo $key->harga; ?></td>
		</tr>
	<?php endforeach ?>	
</table>