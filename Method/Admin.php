<?php
namespace GDO\Ads\Method;

use GDO\UI\MethodPage;
use GDO\Ads\MethodAdsAdmin;

final class Admin extends MethodPage
{
	
	use MethodAdsAdmin;
	
	public function getMethodTitle(): string
	{
		return t('btn_admin');
	}
	
}
