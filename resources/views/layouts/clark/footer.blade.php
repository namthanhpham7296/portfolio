<?php
    $email = isset($company['email']) && $company['email'] ? $company['email'] : '';
    $name = isset($company['name']) && $company['name'] ? $company['name'] : '';
    $phoneNumber = isset($company['phone_number']) && $company['phone_number'] ? $company['phone_number'] : '';
    $address = isset($company['address']) && $company['address'] ? $company['address'] : '';
?>
<style>
    .block-23 ul li .icon{
        min-width: 40px !important;
    }
</style>
<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">About</h2>
                    <p>Feel free to get in touch with me. I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="https://twitter.com/luizpham726"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.facebook.com/icez.young/"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.instagram.com/_tnam0702/"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Links</h2>
                    <ul class="list-unstyled">
                        @foreach($siteMenu as $menu)
                            <?php
                            $name = isset($menu['name']) && $menu['name'] ? $menu['name'] : '';
                            $url = isset($menu['url']) && $menu['url'] ? $menu['url'] : '';
                            ?>
                                <li><a href="{{$url}}"><span class="icon-long-arrow-right mr-2"></span>{{$name}}</a></li>
                        @endforeach


                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Services</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Developer</a></li>
                        <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Development</a></li>
                        <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Data Analysis</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">{{$address}}</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{$phoneNumber}}</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{$email}}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">{{$name}}</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>
