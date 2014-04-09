<?php

//Get station information - not working yet as db stastations table is too old
// $stationInfo = Stastations::Model()->findByPk($data->stationID);

?>
	<?php
		if ($index % 2)
			echo "<tr class='odd'>";
		else
			echo "<tr>";
		//Load the station information
		$statCriteria = new CDbCriteria;
		$statCriteria->condition = 'stationID=:stationID';
		$statCriteria->params = array(':stationID'=>$data->stationID);
		$statCriteria->order = 'transactionDateTime DESC';
		$station = Wallet::Model()->find($statCriteria);
		//Get our time stuff
		$timeLeft = $this->getHumanTime(strtotime("+ $data->duration day",strtotime($data->issued)) - strtotime("+ 5 hour"));
	?>
		<td><?php echo preg_replace('/(.*?\s-\s){1,2}/i','',$station->stationName); ?></td>
		<td><?php echo number_format($data->volRemaining); ?></td>
		<td><?php echo number_format($data->volEntered); ?></td>
		<td><div class='textCenter'><img style='height: 20px; width: 20px;' src='http://image.eveonline.com/Type/<? echo $data->typeID ?>_32.png'><?php echo CHtml::link(CHtml::encode($data->invtypes->typeName), array('wallet/item', 'id'=>$data->typeID)); ?></div></td>
		<td style="text-align: right"><?php echo number_format($data->price,2); ?></td>
		<td><?php echo $timeLeft; ?></td>
	</tr>