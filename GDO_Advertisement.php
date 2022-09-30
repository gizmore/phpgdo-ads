<?php
namespace GDO\Ads;

use GDO\Core\GDO;
use GDO\Core\GDT_AutoInc;
use GDO\Core\GDT_UInt;
use GDO\Core\GDT_CreatedBy;
use GDO\Core\GDT_CreatedAt;
use GDO\File\GDT_ImageFile;

/**
 * An advertisement.
 * 
 * @author gizmore
 * @since 7.0.1
 */
final class GDO_Advertisement extends GDO
{
	public function gdoColumns(): array
	{
		return [
			GDT_AutoInc::make('ad_id'),
			GDT_AdSlot::make('ad_slot'),
			GDT_UInt::make('ad_views')->notNull()->initial('0'),
			GDT_UInt::make('ad_max_views')->notNull(),
			GDT_CreatedAt::make('ad_created'),
			GDT_CreatedBy::make('ad_creator'),
		];
	}
	
}
