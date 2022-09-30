<?php
namespace GDO\Ads;

use GDO\Core\GDO_Module;

/**
 * Feature own advertisements on a GDOv7 Website.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 7.0.1
 */
final class Module_Ads extends GDO_Module
{
	public int $priority = 95;
	
	public function getClasses() : array
	{
		return [
			GDO_Advertisement::class,
			GDO_AdvertisementImage::class,
		];
	}
	
	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
		];
	}

	############
	### Init ###
	############
	public function onLoadLanguage() : void
	{
		$this->loadLanguage('lang/ads');
	}
	
}
