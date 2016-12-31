<?php if (!isset($_SESSION["admin"])): ?>
	<div id="map_canvas" style="width:100%; height:500px"></div>
<?php endif; ?>
<div class="container">
	<h2>Cari kost!</h2>
	<!-- search -->
	<div class="row">
		<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
			<div class="col-md-7">
				<label for="nama" class="control-label">Nama</label>
				<input type="text" name="nama" class="form-control">
			</div>
			<div class="col-md-5">
				<label for="">Harga</label>
				<div class="input-group">
					<span class="input-group-addon" style="border-right: 0;">Min</span>
					<input type="number" name="min" class="form-control" value="0">
					<span class="input-group-addon" style="border-left: 0; border-right: 0;">Max</span>
					<input type="number" name="max" class="form-control" value="0">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary">Cari...</button>
					</span>
				</div>
			</div>
		</form>
	</div>
	<hr>
	<!-- /search -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover table-condensed table-responsive">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>Harga/3bln</th>
						<th>Harga/6bln</th>
						<th>Harga/tahun</th>
						<th>Status</th>
						<th>Kamar Tersedia</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$query = $connection->query("SELECT * FROM kost WHERE nama LIKE '%$_POST[nama]%' AND (harga_3bulan >= $_POST[min] <= $_POST[max] OR harga_6bulan >= $_POST[min] <= $_POST[max] OR harga_pertahun >= $_POST[min] <= $_POST[max])");
					} else {
						$query = $connection->query("SELECT * FROM kost ORDER BY harga_3bulan, harga_6bulan, harga_pertahun");
					}
					$no = 1;
					?>
					<?php while ($row = $query->fetch_assoc()): ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$row["nama"]?></td>
							<td>Rp.<?=$row["harga_3bulan"]?>,-</td>
							<td>Rp.<?=$row["harga_6bulan"]?>,-</td>
							<td>Rp.<?=$row["harga_pertahun"]?>,-</td>
							<td><span class="label label-success"><?=$row["status"]?></span></td>
							<td><?=$row["tersedia"]?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
