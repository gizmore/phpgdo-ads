<?php
namespace GDO\Ads;

use GDO\Core\GDT_Enum;

/**
 * An advertisement slot.
 *
 * @author gizmore
 */
final class GDT_AdSlot extends GDT_Enum
{

	public static $DATA = [
		'popup' => [
			'price_per_view' => 6,
		],
		'top' => [
			'price_per_view' => 4,
		],
		'left' => [
			'price_per_view' => 3,
		],
		'bottom' => [
			'price_per_view' => 2,
		],
	];

	protected function __construct()
	{
		parent::__construct();
		$this->name('slot');
		$this->label('slot');
// 		$this->icon('slot');
		$this->notNull();
		$this->enumValues('popup', 'top', 'left', 'footer');
		$this->emptyLabel('choose_slot');
	}

	public static function slots(): array
	{
		return array_keys(self::$DATA);
	}

	public function getPricePerView(): float
	{
		return $this->getData()['price_per_view'];
	}

	public function getData(): array
	{
		return self::$DATA[$this->getVar()];
	}

}
