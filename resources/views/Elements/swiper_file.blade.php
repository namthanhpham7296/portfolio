<div class="swiper-container full-width list-file-content">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        @foreach($dataFile as $fileInfo)
            @include("Elements.item_preview", ["fileInfo" => $fileInfo])
        @endforeach
    </div>
    <!-- If we need pagination -->

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
</div>
