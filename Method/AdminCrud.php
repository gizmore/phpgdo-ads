<?php
namespace GDO\Ads\Method;

use GDO\Ads\GDO_Advertisement;
use GDO\Ads\MethodAdsAdmin;
use GDO\Core\GDO;
use GDO\Form\MethodCrud;

/**
 * Admin method to edit advertisements.
 *
 * @version 7.0.1
 * @author gizmore
 */
final class AdminCrud extends MethodCrud
{

	use MethodAdsAdmin;

	public function gdoTable(): GDO
	{
		return GDO_Advertisement::table();
	}

	public function hrefList(): string
	{
		return href('Ads', 'AdminList');
	}

}
