<div class="flex w-full items-center justify-center">
    {{QrCode::size(200)->generate(asset('/') . 'galleries/qr-scan/' . $record->slug)}}
</div>
