<?php
namespace GDO\Ads;

use GDO\Admin\MethodAdmin;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Page;

trait MethodAdsAdmin
{

	use MethodAdmin;

	public function onRenderTabs(): void
	{
		$this->renderAdminBar();
		$this->renderAdsAdminBar();
	}

	public function renderAdsAdminBar(): void
	{
		GDT_Page::instance()->topResponse()->addField(
			GDT_Bar::make()->addFields(
				GDT_Link::make('module_ads')->href(href('Ads', 'AdminList')),
			));
	}

}
