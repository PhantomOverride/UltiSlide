<?php

	require_once("php/config.php");
?>
<div id="removeItems">
	<?php
		try{
			$pdo = DataBase::GetPDO();
		}
		catch(Exception $error){
			echo $error;
		}

		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

		$sql = "SELECT * FROM `mkSlide`";
		$sth = $pdo->prepare($sql);
		if(!$sth){
			var_dump($pdo->errorInfo());
		}
		else{
			$sth->execute();
		}

		$res = $sth->fetchAll();
	?>
	<table>
		<thead>
			<tr>
				<th> ID </th>
				<th> Content </th>
				<th> Remove IT</th>
			</tr>
		</thead>
		<tbody>
			<?php
				for($i = 0; $i < count($res); ++$i){
					$current = $res[$i];
					echo<<<TABLEROW
					<tr>
						<td>{$current->id}</td>
						<td>{$current->data}</td>
						<!-- Fuck security Ill remove it with GET!.... Probably should change this someday -->
						<td><a href="php/remove.php?id={$current->id}"> Remove </a></td>
					</tr>
TABLEROW;
				}
			?>
		</tbody>
	</table>
</div>
