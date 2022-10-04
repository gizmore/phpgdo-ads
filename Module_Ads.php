<?php
namespace GDO\Ads;

use GDO\Core\GDO_Module;
use GDO\Date\GDT_Duration;
use GDO\UI\GDT_Page;
use GDO\Core\GDT_Checkbox;
use GDO\Core\GDT_Filesize;
use GDO\UI\GDT_Link;
use GDO\User\GDO_User;

/**
 * Feature own advertisements on a GDOv7 Website.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 7.0.1
 */
final class Module_Ads extends GDO_Module
{
	public int $priority = 95;
	
	public function getDependencies() : array
	{
		return [
			'Payment',
		];
	}
	
	public function getFriendencies() : array
	{
		return [
			'PaymentBank',
			'PaymentCredits',
			'PaymentPaypal',
		];
	}
	
	public function getClasses() : array
	{
		return [
			GDO_Advertisement::class,
		];
	}
	
	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
			GDT_Filesize::make('ads_max_filesize')->min(1*1024)->max(2*1024*1024)->initial('128kb'),
			GDT_Duration::make('ads_min_duration')->min(10)->max(1800)->initial('30'),
			GDT_Duration::make('ads_max_duration')->min(10)->max(1800)->initial('300'),
			GDT_Checkbox::make('ads_slot_popup')->initial('0'),
			GDT_Checkbox::make('ads_slot_top')->initial('1'),
			GDT_Checkbox::make('ads_slot_left')->initial('1'),
			GDT_Checkbox::make('ads_slot_bottom')->initial('1'),
			GDT_Checkbox::make('hook_sidebar')->initial('1'),
		];
	}
	
	private function cfgMinDur() : int { return $this->getConfigValue('ads_min_duration'); }
	private function cfgMaxDur() : int { return $this->getConfigValue('ads_maxn_duration'); }
	
	public function cfgMaxFilesize() : int { return $this->getConfigValue('ads_max_filesize'); }
	public function cfgMinDuration() : int { return min([$this->cfgMinDur(), $this->cfgMaxDur()]); }
	public function cfgMaxDuration() : int { return max([$this->cfgMinDur(), $this->cfgMaxDur()]); }
	public function cfgSlotPopup() : bool { return $this->cfgSlot('popup'); }
	public function cfgSlotTop() : bool { return $this->cfgSlot('top'); }
	public function cfgSlotLeft() : bool { return $this->cfgSlot('left'); }
	public function cfgSlotBottom() : bool { return $this->cfgSlot('bottom'); }
	public function cfgSlot(string $pos) : bool { return $this->getConfigValue('ads_slot_'.$pos); }
	public function cfgHookSidebar() : bool { return $this->getConfigValue('hook_sidebar'); }
	
	############
	### Init ###
	############
	public function onInstall() : void
	{
		Install::onInstall($this);
	}
	
	public function onLoadLanguage() : void
	{
		$this->loadLanguage('lang/ads');
	}
	
	public function onIncludeScripts() : void
	{
		$this->addJS('js/gdo7-ads.js');
		$this->addCSS('css/gdo7-ads.css');
	}

	############
	### Hook ###
	############
	public function onInitSidebar() : void
	{
		$this->onInitAds();
		if ($this->cfgHookSidebar())
		{
			if (GDO_User::current()->isAuthenticated())
			{
				$menuPayment = GDT_Page::instance()->rightBar()->getField('menu_payment');
				$menuPayment->addField(GDT_Link::make('order_advertisement')->href(href('Ads', 'Order')));
			}
		}
	}

	/**
	 * Load all advertisements into their slots.
	 */
	private function onInitAds()
	{
		$page = GDT_Page::instance();
		foreach (GDT_AdSlot::slots() as $slot)
		{
			if ($this->cfgSlot($slot))
			{
				if ($ad = GDO_Advertisement::forSlot($slot))
				{
					$cont = $page->getSlot($slot);
					$cont->addField($ad);
				}
			}
		}
	}
	
}
