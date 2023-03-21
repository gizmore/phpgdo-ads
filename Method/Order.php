<?php
namespace GDO\Ads\Method;

use GDO\Ads\GDO_Advertisement;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;

/**
 * Order an advertisement.
 *
 * @author gizmore
 *
 */
final class Order extends MethodForm
{

	public function createForm(GDT_Form $form): void
	{
		$table = GDO_Advertisement::table();
		$form->addFields(
			$table->gdoColumn('ad_slot'),
			$table->gdoColumn('ad_image'),
			$table->gdoColumn('ad_duration'),
			GDT_AntiCSRF::make(),
		);
		$form->actions()->addField(GDT_Submit::make());
	}

}
