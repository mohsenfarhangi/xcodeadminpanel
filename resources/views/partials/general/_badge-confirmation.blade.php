<?php
$data       = \App\Http\Core\Util::getConfirmStatus($status ?? '');

?>
<span class="ms-3 badge badge-{{$data['color']}}" {!! $attr ?? '' !!}>{{$data['label']}}</span>
