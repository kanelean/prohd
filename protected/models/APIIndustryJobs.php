<?php
class APIIndustryJobs extends EVEXMLData
{
	public function apiAttributes()
	{
		return array(
			'url'=>'http://api.eve-online.com/char/IndustryJobs.xml.aspx',
			'cacheID'=>'APIIndustryJobs',
			'primaryID'=>'characterID',
			'keys'=>array('keyID','vCode','characterID'),
			'storageTable'=>'industryJobs',
		);
	}
	public function storeData($walletID)
	{
		$attributes = $this->apiAttributes();	
		//Retrieve the XML dataset
		$industryJobs = $this->getEVEData($walletID);	
		$character = Characters::Model()->findByPk($walletID);
		if(!(isset($industryJobs->error)))
		{
			foreach ($industryJobs->result->rowset->row as $row)
			{		
				$exist = IndustryJobs::Model()->exists('jobID=:jobID',array(':jobID'=>$row->attributes()->jobID));
				if (!$exist)
				{
						$jobRow = new IndustryJobs;
						$jobRow->jobID = $row->attributes()->jobID;
						$jobRow->assemblyLineID = $row->attributes()->assemblyLineID;
						$jobRow->containerID = $row->attributes()->containerID;
						$jobRow->installedItemID = $row->attributes()->installedItemID;
						$jobRow->installedItemLocationID = $row->attributes()->installedItemLocationID;
						$jobRow->installedItemQuantity = $row->attributes()->installedItemQuantity;
						$jobRow->installedItemProductivityLevel = $row->attributes()->installedItemProductivityLevel;
						$jobRow->installedItemMaterialLevel = $row->attributes()->installedItemMaterialLevel;
						$jobRow->installedItemLicensedProductionRunsRemaining = $row->attributes()->installedItemLicensedProductionRunsRemaining;
						$jobRow->outputLocationID = $row->attributes()->outputLocationID;
						$jobRow->installerID = $row->attributes()->installerID;
						$jobRow->save();
				}
			}
		}
	}
	public function getMembersAsArray($groupID)
	{
		$members = TrackingGroupMembers::Model()->findAll('trackingGroupID=:groupID',array(':groupID'=>$groupID));
		foreach ($members as $member)
		{
			$memberArray[] = $member->characterID;
		}
		
		return $memberArray;
	}
}
?>