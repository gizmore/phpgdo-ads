<?php
namespace GDO\Ads;

use GDO\Core\GDO;
use GDO\Core\GDT_AutoInc;
use GDO\Core\GDT_Checkbox;
use GDO\Core\GDT_CreatedAt;
use GDO\Core\GDT_CreatedBy;
use GDO\Core\GDT_DeletedAt;
use GDO\Core\GDT_DeletedBy;
use GDO\Core\GDT_EditedAt;
use GDO\Core\GDT_EditedBy;
use GDO\Core\GDT_Template;
use GDO\Core\GDT_UInt;
use GDO\Date\GDT_Duration;
use GDO\File\GDO_File;
use GDO\File\GDT_ImageFile;
use GDO\Net\GDT_Url;
use GDO\Payment\GDT_Money;
use GDO\Payment\Orderable;
use GDO\Payment\PaymentModule;
use GDO\UI\GDT_Card;
use GDO\User\GDO_User;

/**
 * An advertisement.
 *
 * @since 7.0.1
 * @author gizmore
 */
final class GDO_Advertisement extends GDO implements Orderable
{

	public static function forSlot(string $slot): ?self
	{
		$q = self::table()->select()
			->where('ad_deleted IS NULL')
			->where('ad_views < ad_max_views')
			->where('ad_slot=' . quote($slot))
			->orderRand()
			->first();
		if (!($ad = $q->exec()->fetchObject()))
		{
			$ad = self::defaultForSlot($slot);
		}
		return $ad;
	}

	##############
	### Getter ###
	##############

	private static function defaultForSlot(string $slot): ?self
	{
		return self::table()->select()
			->where('ad_fallback=1')
			->where('ad_slot=' . quote($slot))
			->first()
			->exec()
			->fetchObject();
	}

	public function gdoColumns(): array
	{
		return [
			GDT_AutoInc::make('ad_id'),
			GDT_AdSlot::make('ad_slot')->notNull(),
			GDT_Duration::make('ad_duration')->notNull(),
			GDT_Url::make('ad_url')->allowAll()->notNull(),
			GDT_UInt::make('ad_views')->notNull()->initial('0'),
			GDT_UInt::make('ad_max_views')->notNull(),
			GDT_ImageFile::make('ad_image')->notNull()
				->scaledVersion('popup', 1960, 1280)
				->scaledVersion('top', 1960, 480)
				->scaledVersion('right', 512, 960)
				->scaledVersion('bottom', 1960, 640)
				->scaledVersion('left', 512, 960),
			GDT_Checkbox::make('ad_fallback')->notNull()->initial('0'),
			GDT_Money::make('ad_price'),
			GDT_CreatedAt::make('ad_created'),
			GDT_CreatedBy::make('ad_creator'),
			GDT_EditedAt::make('ad_edited'),
			GDT_EditedBy::make('ad_editor'),
			GDT_DeletedAt::make('ad_deleted'),
			GDT_DeletedBy::make('ad_deletor'),
		];
	}

	##############
	### Static ###
	##############

	public function renderHTML(): string
	{
		return GDT_Template::php('Ads', 'ad_html.php', ['ad' => $this]);
	}

	public function getFilesize(): int
	{
		return $this->getFile()->getSize();
	}

	##############
	### Render ###
	##############

	public function getFile(): GDO_File
	{
		return $this->gdoValue('ad_image');
	}

	public function renderOrderCard()
	{
		return $this->renderCard();
	}

	public function renderCard(): string
	{
		$card = $this->getCard();
		return $card->render();
	}

	#################
	### Orderable ###
	#################

	public function getCard(): GDT_Card
	{
		$card = GDT_Card::make("gdo-ad-{$this->getID()}")->gdo($this);
		return $card;
	}

	public function canPayOrderWith(PaymentModule $module)
	{
		return true;
	}


	public function getOrderPrice()
	{
		$price = $this->getSlotPrice();
		$minutes = $this->getMinutes();
		return round($price * $minutes, 2);
	}


	public function getOrderCancelURL(GDO_User $user)
	{
		return href('Ads', 'Order');
	}


	public function getOrderTitle($iso)
	{
		return t('order_ads_title',);
	}


	public function getOrderSuccessURL(GDO_User $user) {}


	public function onOrderPaid() {}


	public function isPriceWithTax()
	{
		return false;
	}


}
