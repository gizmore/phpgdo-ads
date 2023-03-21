<?php
namespace GDO\Ads\Method;

use GDO\Ads\GDO_Advertisement;
use GDO\Ads\MethodAdsAdmin;
use GDO\Core\GDO;
use GDO\Table\MethodQueryList;

/**
 * Admin overview of advertisements.
 *
 * @version 7.0.1
 * @author gizmore
 */
final class AdminList extends MethodQueryList
{

	use MethodAdsAdmin;

	public function gdoTable(): GDO
	{
		return GDO_Advertisement::table();
	}

}
