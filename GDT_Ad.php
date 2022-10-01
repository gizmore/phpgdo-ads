<?php
namespace GDO\Ads;

use GDO\Core\GDT_Object;

/**
 * An advertisement referenced object.
 * 
 * @author gizmore
 */
final class GDT_Ad extends GDT_Object
{
	protected function __construct()
	{
		parent::__construct();
		$this->table(GDO_Advertisement::table());
		$this->label('advertisement');
		$this->icon('image');
	}

}
