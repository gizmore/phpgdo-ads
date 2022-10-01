<?php
namespace GDO\Ads\tpl;
use GDO\UI\GDT_Image;
/** @var $ad \GDO\Ads\GDO_Advertisement **/
$file = $ad->getFile();
$image = GDT_Image::fromFile($file);
?>
<div class="gdo-advertisment">
<?=$image->render()?>
</div>
