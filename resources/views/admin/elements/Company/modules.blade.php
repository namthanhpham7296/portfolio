<style>
    .module-border{
        border: 1px solid mediumblue;
    }
</style>

<div class="row">

    <?php
    foreach ($listModules as $key => $item){
    $code = $item->code;
    $url = url($code.'/dashboard/index');
    ?>
    <div class="col-lg-6 col-xl-6 mb-5">
        <!--begin::Iconbox-->
        <div class="card card-custom wave mb-8 mb-lg-0 module-border">
            <div class="card-body">
                <div class="d-flex align-items-center p-5">
                    <div class="mr-6">
														<span class="svg-icon svg-icon-4x svg-icon-success">
															<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<circle fill="#000000" cx="9" cy="15" r="6"></circle>
																	<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
																</g>
															</svg>
                                                            <!--end::Svg Icon-->
														</span>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="{{ $url }}" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">{{ $item->name }}</a>
                        <div class="text-dark-75">
                            {{ $item->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Iconbox-->

    </div>
    <?php
    }
    ?>



</div>

