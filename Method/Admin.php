<?php
namespace GDO\Ads\Method;

use GDO\Ads\MethodAdsAdmin;
use GDO\UI\MethodPage;

final class Admin extends MethodPage
{

	use MethodAdsAdmin;

	public function getMethodTitle(): string
	{
		return t('btn_admin');
	}

}
