@extends("Layouts.metronic_v7")
@section('title', $title)
@section("content")

    <style>
        .modal-open, .modal-open body {
            overflow: hidden !important;
        }

        .thumbnail-site {
            width: 80px;
            height: 32px;
            border-radius: 4px !important;
        }

        .image-input{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

    </style>
    @include('admin.elements.Site.subheader')

    <div class="tab-content">
        <div class="tab-pane fade " id="tab_menu" role="tabpanel">
            @include('Admin.Elements.Site.Menu.menu_list')
        </div>
        <div class="tab-pane fade " id="tab_resume" role="tabpanel">
            @include('Admin.Elements.Site.Resume.content')
        </div>
        <div class="tab-pane fade " id="tab_skill" role="tabpanel">
            @include('Admin.Elements.Site.Skill.content')
        </div>
    </div>
    <script>
        var searchTableMenu,
            searchTableResume,
            searchTableSkill;
        var titleAdd = "{{__("New")}}",
            titleEdit = "{{__("Edit")}}";
        function displayTab(tabId){
            if(tabId == "tab_menu"){
                searchTableMenu.ajax.reload();
            }else if(tabId == 'tab_resume'){
                searchTableResume.ajax.reload();
            }else if(tabId == 'tab_skill'){
                searchTableSkill.ajax.reload();
            }
        }
        // show selected tab using cookie
        $(function() {

            var value = getCookie('selected-tab');
            var value = (value != '') ? value : '#tab_menu';
            displayTab(value.substring(1, value.length));
            if(value != ''){
                $('#div-site ul li').each(function(){
                    var links = $(this).find('a'),
                        tabId = links.attr('href').substring(1, links.attr('href').length);//remove # character
                    // console.log(tabName);
                    if(links.attr('href') == value){
                        links.addClass('active btn-active');
                        $('.tab-pane').each(function(){
                            if($(this).attr('id') == tabId){
                                $(this).addClass('show active');
                            } else {
                                $(this).removeClass('show active');
                            }
                        });
                    } else {
                        links.removeClass('active btn-active');
                    }
                })
            }

            $(document).on("click", ".nav-link", function(e){
                var value = $(e.target).attr('href');
                tabId = value.substring(1, value.length);//remove # character
                setCookie('selected-tab', value, 3);
                $('#div-site ul li').each(function(){
                    var links = $(this).find('a');
                    links.removeClass('active btn-active');
                });
                $(this).addClass('active btn-active');
                displayTab(tabId);
            });

        });
    </script>
@endsection

@section("pagescript")
    <script>
        $(document).on('hidden.bs.modal', '.modal', function () {
            $('.modal:visible').length && $(document.body).addClass('modal-open');
        });
    </script>
@endsection

