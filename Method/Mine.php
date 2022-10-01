<?php
namespace GDO\Ads\Method;

use GDO\Table\MethodQueryList;
use GDO\Ads\GDO_Advertisement;

/**
 * List your advertisements.
 * 
 * @author gizmore
 * @since 7.0.1
 */
final class Mine extends MethodQueryList
{
	
	public function gdoTable()
	{
		return GDO_Advertisement::table();
	}
	
}
