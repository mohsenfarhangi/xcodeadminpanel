<?php
$status = \App\Http\Core\Data::getUsersStatus($model->status);
$label  = $status['label'];
$state  = $status['state'];

?>

<div class="bg-light-{{ $state }} text-{{ $state }} rounded text-center p-1">{{ $label }}</div>
