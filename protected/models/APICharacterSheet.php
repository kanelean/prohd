<?php
class APICharacterSheet extends EVEXMLData
{
	public function apiAttributes()
	{
		return array(
			'url'=>'http://api.eve-online.com/char/CharacterSheet.xml.aspx',
			'cacheID'=>'APICharacterSheet',
			'primaryID'=>'characterID',
			'keys'=>array('keyID','vCode','characterID'),
			'cacheOverride'=>900,
		);
	}
}
?>