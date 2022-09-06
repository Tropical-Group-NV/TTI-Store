<?php


$Link = route('backorders');
$totalNew = $model->ListID;

$customerName = (trim($customer->FirstName.' '.$customer->LastName)!=''?($customer->FirstName.' '.$customer->LastName):$customer->FullName);

$item = \App\Models\Item::query()->where('ListID', $model->ListID)->first();

?>
Beste <?= $customerName ?>,<br><br>

Bedankt voor uw backorder. U ontvangt zo gauw mogelijk een email van ons wanneer wij "<?=strtoupper($item->Description)?>" in voorraad hebben.<br><br>

Volg deze link hieronder:<br>

<?= $Link ?><br><br>

Voor vragen kunt u contact opnemen met onze klantenservice op WhatsApp +597 8691600 of bellen naar +597 458666.<br><br>

Bedankt voor het kiezen van Tropical Trade & Industries NV als uw partner en leverancier.
