<table id="varukorg-tabell">
	        	
	<?php 
		$sum = 0;
		while($c = mysqli_fetch_assoc($cart)){ 
			$sqlitem = "SELECT Image, Name FROM Items WHERE ID = '$c[Items_ID]'";
			$item = mysqli_query($conn, $sqlitem);
			$i = mysqli_fetch_assoc($item); ?>

			<tr>
				<td><p>Varunummer </p></td>
				<td><p><?php echo $shop; echo '<br>' ; ?> </p></td>
				<td><img src="<?php echo $i['Image']; ?>" height="50" width="50"></td>
				<td><p><?php echo $i['Name']; echo '<br>' ; ?> </p></td>
				<td><p><?php echo $c['Price'];echo " Kr"; ?> </p></td>


			
			</tr>
			<?php $sum = $sum + $c['Price']; ?>
	<?php } ?>
	<tr>
		<td><h3>Summa: </h3></td>
		<td><p><?php echo $sum;  ?> Kr</p></td>
			
	</tr>
</table>