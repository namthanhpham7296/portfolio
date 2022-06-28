@extends('layouts.clark')
@section('title', "Clark")
@section('content')
    <?php
    use App\Constant;
        use App\Helpers\BaseService;
        $id = isset($company['id']) && $company['id'] ? $company['id'] : '';
        $fullName = isset($company['full_name']) && $company['full_name'] ? $company['full_name'] : '';
        $introduction = isset($company['introduction']) && $company['introduction'] ? $company['introduction'] : '';
        $birthday = isset($company['birthday']) && $company['birthday'] ? BaseService::formatDateVN($company['birthday']) : '';
        $email = isset($company['email']) && $company['email'] ? $company['email'] : '';
        $phoneNumber = isset($company['phone_number']) && $company['phone_number'] ? $company['phone_number'] : '';
        $address = isset($company['address']) && $company['address'] ? $company['address'] : '';
        $website = isset($company['website']) && $company['website'] ? $company['website'] : '';
        $photo = isset($company['photo']) && $company['photo'] ? $company['photo'] : '';
        $photoPath = $photo != "" ? asset('uploads/'.$id.'/Photo/'.$photo): "";

    ?>
    <style>
        .down-words{
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .resume-wrap{
            min-height: 300px !important;
            max-height: 300px !important;
        }
    </style>
    <section id="home-section" class="hero">
        <div class="home-slider  owl-carousel">
            <div class="slider-item ">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
                        <div class="one-third js-fullheight order-md-last img" style="background-image:url(https://scontent.fsgn2-5.fna.fbcdn.net/v/t1.6435-9/89491765_1630284673777707_6761843090295619584_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=730e14&_nc_ohc=w0a80ILgc_gAX9ez4J9&_nc_ht=scontent.fsgn2-5.fna&oh=00_AT-nix-VL8USAP3jo5Ek7EHq4IwD4Zpj1JP-hJgcx89O1Q&oe=62DE82FC);">
                            <div class="overlay"></div>
                        </div>
                        <div class="one-forth d-flex  align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading">Hello!</span>
                                <h1 class="mb-4 mt-3">I'm <span>Nam Phạm Thanhgit</span></h1>
                                <h2 class="mb-4">Web Developer !</h2>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-item">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row d-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
                        <div class="one-third js-fullheight order-md-last img" style="background-image:url(https://scontent.fsgn2-1.fna.fbcdn.net/v/t1.6435-9/147121958_1929371940535644_6594907539797116366_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=hqlmwaVidjMAX8EwQgn&tn=AP5BjHqel_vcMSzG&_nc_ht=scontent.fsgn2-1.fna&oh=00_AT-1lLpqB_cZ_toLW2a-6cnpq4_6uyS4JXh5kT1TeQ60DA&oe=62DEE597);">
                            <div class="overlay"></div>
                        </div>
                        <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading">Hello!</span>
                                <h1 class="mb-4 mt-3">I'm a <span>web developer</span> based in HO CHI MINH</h1>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-about img ftco-section ftco-no-pb" id="about-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 col-lg-5 d-flex">
                    <div class="img-about img d-flex align-items-stretch">
                        <div class="overlay"></div>
                        <div class="img d-flex align-self-stretch align-items-center" style="background-image:url({{$photoPath}});">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 pl-lg-5 pb-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <h1 class="big">{{__("About")}}</h1>
                            <h2 class="mb-4">{{__("About Me")}}</h2>
                            <p>{{__($introduction)}}.</p>
                            <ul class="about-info mt-4 px-md-0 px-2">
                                <li class="d-flex"><span>{{__("Name")}}:</span> <span>{{$fullName}}</span></li>
                                <li class="d-flex"><span>{{__("Date of birth")}}:</span> <span>{{$birthday}}</span></li>
                                <li class="d-flex"><span>{{__("Address")}}:</span> <span>{{$address}}</span></li>
                                <li class="d-flex"><span>{{__("Email")}}:</span> <span>{{$email}}</span></li>
                                <li class="d-flex"><span>{{__("Phone")}}: </span> <span>{{$phoneNumber}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="counter-wrap ftco-animate d-flex mt-md-3">
                        <div class="text">
                            <p class="mb-4">
                                <span class="number" data-number="{{$countProjects}}">0</span>
                                <span>Project complete</span>
                            </p>
                            <p><a href="{{url('public/cv/PHAM-THANH-NAM-TopCV.vn-240622.220557.pdf')}}" target="_blank"  id="btn-download-cv" data-toggle="tooltip" data-placement="top" title="<?php echo __("Download CV") ?>" class="btn btn-primary py-3 px-3">Download CV</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb" id="resume-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-10 heading-section text-center ftco-animate">
                    <h1 class="big big-2">Resume</h1>
                    <h2 class="mb-4">Resume</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                </div>
            </div>
            @if(count($projects) > 0 )
            <div class="row">
                <div class="col-md-6">
                    <?php
                        for($i = 0; $i < count($projects); $i++){ ?>
                            @if($i % 2 == 0)
                            <div class="resume-wrap ftco-animate">
                                <span class="date">{{$projects[$i]['from_year']}}-{{$projects[$i]['to_year']}}</span>
                                <h2>{{__($projects[$i]['title'])}}</h2>
                                <span class="position">{{__($projects[$i]['subtitle'])}}</span>
                                <p class="mt-4 down-words">{!! \Illuminate\Support\Str::words(strip_tags($projects[$i]['content']), $limit = 150, $end = '...') !!}.</p>
                            </div>
                            @endif
                  <?php }  ?>
                </div>

                <div class="col-md-6">
                    <?php
                    for($i = 0; $i < count($projects); $i++){ ?>
                    @if($i % 2 != 0)
                        <div class="resume-wrap ftco-animate">
                            <span class="date">{{$projects[$i]['from_year']}}-{{$projects[$i]['to_year']}}</span>
                            <h2>{{__($projects[$i]['title'])}}</h2>
                            <span class="position">{{__($projects[$i]['subtitle'])}}</span>
                            <p class="mt-4 down-words">{!! \Illuminate\Support\Str::words(strip_tags($projects[$i]['content']), $limit = 150, $end = '...') !!}.</p>
                        </div>
                    @endif
                    <?php }  ?>
                </div>
            </div>
            @endif
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center ftco-animate">
                    <p><a href="{{url('public/cv/PHAM-THANH-NAM-TopCV.vn-240622.220557.pdf')}}" target="_blank"  id="btn-download-cv" data-toggle="tooltip" data-placement="top" title="<?php echo __("Download CV") ?>" class="btn btn-primary py-3 px-3">Download CV</a></p>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section" id="skills-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big big-2">Skills</h1>
                    <h2 class="mb-4">My Skills</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="row">
                @foreach($skills as $skill)
                <div class="col-md-6 animate-box">
                    <div class="progress-wrap ftco-animate">
                        <h3>{{__($skill['name'])}}</h3>
                        <div class="progress">
                            <div class="progress-bar color-1" role="progressbar" aria-valuenow="{{$skill['rate']}}"
                                 aria-valuemin="0" aria-valuemax="100" style="width:{{$skill['rate']}}%">
                                <span>{{$skill['rate']}}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-project" id="projects-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h1 class="big big-2">Projects</h1>
                    <h2 class="mb-4">Our Projects</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="row">
                <?php

                for($i = 0; $i < count($projects); $i++){ ?>
                    @if($projects[$i]['position'] == 1)
                        <div class="col-md-4">
                            <div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url('../uploads/1/Resumes/{{$projects[$i]['id']}}/Photo/{{$projects[$i]['photo']}}');">
                                <div class="overlay"></div>
                                <div class="text text-center p-4">
                                    <h3><a href="{{$projects[$i]['links']}}" target="_blank">{{$projects[$i]['subtitle']}}</a></h3>
                                    <span>{{$projects[$i]['title']}}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-8">
                            <div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url('../uploads/1/Resumes/{{$projects[$i]['id']}}/Photo/{{$projects[$i]['photo']}}');">
                                <div class='overlay'></div>
                                <div class="text text-center p-4">
                                    <h3><a href="{{$projects[$i]['links']}}" target="_blank">{{$projects[$i]['subtitle']}}</a></h3>
                                    <span>{{$projects[$i]['title']}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                <?php }    ?>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-hireme img margin-top" style="background-image: url(https://pbs.twimg.com/profile_banners/1367748540919771138/1641346469/1500x500)"><div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 ftco-animate text-center">
                    <h2>I'm <span>Available</span> for freelancing</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-5">Hire me</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h1 class="big big-2">Contact</h1>
                    <h2 class="mb-4">Contact Me</h2>
                    <p>Feel free to get in touch with me. I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.</p>
                </div>
            </div>

            <div class="row d-flex contact-info mb-5">
                <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-map-signs"></span>
                        </div>
                        <h3 class="mb-4">Address</h3>
                        <p>{{$address}}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-phone2"></span>
                        </div>
                        <h3 class="mb-4">Contact Number</h3>
                        <p><a href="tel://{{$phoneNumber}}">+84{{substr($phoneNumber, 1)}}</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-paper-plane"></span>
                        </div>
                        <h3 class="mb-4">Email Address</h3>
                        <p><a href="mailto:info@yoursite.com">{{$email}}</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex ftco-animate">
                    <div class="align-self-stretch box p-4 text-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-globe"></span>
                        </div>
                        <h3 class="mb-4">Website</h3>
                        <p><a href="{{$website}}">{{$website}}</a></p>
                    </div>
                </div>
            </div>

            <div class="row no-gutters block-9">
                <div class="col-md-6 order-md-last d-flex">
                   @include('home.contact')
                </div>

                <div class="col-md-6 d-flex">
                    <div class="img" style="background-image: url({{$photoPath}});"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("pagescript")

@endsection
