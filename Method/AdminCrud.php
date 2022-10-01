<?php
namespace GDO\Ads\Method;

use GDO\Ads\GDO_Advertisement;
use GDO\Form\MethodCrud;
use GDO\Ads\MethodAdsAdmin;
use GDO\Core\GDO;

/**
 * Admin method to edit advertisements.
 * 
 * @author gizmore
 * @version 7.0.1
 */
final class AdminCrud extends MethodCrud
{

	use MethodAdsAdmin;
	
	public function gdoTable() : GDO
	{
		return GDO_Advertisement::table();
	}
	
	public function hrefList(): string
	{
		return href('Ads', 'AdminList');
	}
	
}
