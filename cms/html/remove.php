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
				<th> Remove? </th>
			</tr>
		</thead>
		<tbody>
			<?php
				for($i = 0; $i < count($res); ++$i){
					$current = $res[$i];
                                        $cid = htmlentities($current->id);
                                        $cdata = htmlentities($current->data);
					echo<<<TABLEROW
					<tr>
						<td>{$cid}</td>
						<td>{$cdata}</td>
						<td><a href="php/remove.php?id={$cid}"> Remove </a></td>
					</tr>
TABLEROW;
				}
			?>
		</tbody>
	</table>
</div>
