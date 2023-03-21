<?php
namespace GDO\Ads;

use GDO\File\GDO_File;

/**
 * Install the advertisements module.
 *
 * @author gizmore
 */
final class Install
{

	public static function onInstall(Module_Ads $module): void
	{
		self::installDefaultSlots($module);
	}

	private static function installDefaultSlots(Module_Ads $module): void
	{
		foreach (GDT_AdSlot::slots() as $slot)
		{
			if (!GDO_Advertisement::forSlot($slot))
			{
				self::installSlot($module, $slot);
			}
		}
	}

	private static function installSlot(Module_Ads $module, string $slot): void
	{
		$name = "default_{$slot}.gif";
		$path = $module->filePath("data/{$name}");
		$file = GDO_File::fromPath($name, $path);
		$file->insert();
	}

}
