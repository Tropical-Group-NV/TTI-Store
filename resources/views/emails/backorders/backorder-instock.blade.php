<?php
$Link = route('backorders');

$customerName = (trim($customer->FirstName.' '.$customer->LastName)!=''?($customer->FirstName.' '.$customer->LastName):$customer->FullName);

$item = \App\Models\Item::query()->where('ListID', $model->ListID)->first();

?>
Beste <?= $customerName ?>,<br><br>

<?=strtoupper($item->Description)?> is nu in voorraad. Volg deze link hieronder om uw bestelling te bevestigen:<br>

<?= $Link ?><br><br>

Voor vragen kunt u contact opnemen met onze klantenservice op WhatsApp +597 8691600 of bellen naar +597 458666.<br><br>

Bedankt voor het kiezen van Tropical Trade & Industries NV als uw partner en leverancier.
