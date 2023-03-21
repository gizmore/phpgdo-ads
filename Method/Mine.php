<?php
namespace GDO\Ads\Method;

use GDO\Ads\GDO_Advertisement;
use GDO\Table\MethodQueryList;

/**
 * List your advertisements.
 *
 * @since 7.0.1
 * @author gizmore
 */
final class Mine extends MethodQueryList
{

	public function gdoTable()
	{
		return GDO_Advertisement::table();
	}

}
