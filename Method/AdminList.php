<?php
namespace GDO\Ads\Method;

use GDO\Table\MethodQueryList;
use GDO\Ads\GDO_Advertisement;
use GDO\Ads\MethodAdsAdmin;
use GDO\Core\GDO;

/**
 * Admin overview of advertisements.
 * 
 * @author gizmore
 * @version 7.0.1
 */
final class AdminList extends MethodQueryList
{

	use MethodAdsAdmin;
	
	public function gdoTable() : GDO
	{
		return GDO_Advertisement::table();
	}
	
}
