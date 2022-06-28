<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">

            <?php

                foreach ($listMenu as $key => $menu){

                    $id         = $menu['id'];
                    $name       = $menu['name'];
                    $plugin     = $menu['plugin'];
                    $controller = $menu['controller'];
                    $action     = $menu['action'];
                    $cls_icon   = $menu['cls_icon'];
                    $link       = empty($menu['link']) ? "javascript:;" : url($menu['link']);
                    $is_link    = $menu['is_link'];
                    $list_child = isset($menu['list_child']) ? $menu['list_child'] : [];

                    $activeP = "";

                    if($is_link){

                        if(
                            $plugin == $currentFunction['plugin'] &&
                            $controller == $currentFunction['controller'] &&
                            $action == $currentFunction['action']
                        ){
                            $activeP = "menu-item-open menu-item-here";
                        }

                    }else{
                        if($id == $currentFunction['parent_id']){
                            $activeP = "menu-item-open menu-item-here";
                        }
                    }

                    ?>
                    <li class="menu-item menu-item-submenu <?php echo $activeP; ?> " aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ $link }}" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="<?php echo $cls_icon; ?>"></i>
                            </span>
                            <span class="menu-text">{{ __($name) }}</span>

                            @if(!$is_link)
                                <i class="menu-arrow"></i>
                            @endif

                        </a>

                        @if(count($list_child))
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">

                                    <?php
                                        foreach ($list_child as $child){
                                            $child_name = $child['name'];
                                            $child_cls_icon = $child['cls_icon'];
                                            $child_link = !$child['is_link'] || empty($child['link'])? "javascript:;" : url($child['link']);

                                            if(empty($child['link'])){
                                                $child_link = !$child['is_link'] ? "javascript:;" : url($child['plugin'].'/'.$child['controller'].'/'.$child['action']);
                                            }

                                            $activeC = "";

                                            if($currentFunction) {
                                                if($currentFunction['semi_parent_id'] && $child['id'] == $currentFunction['semi_parent_id']){
                                                    $activeC = "menu-item-active";
                                                }else{
                                                    if(
                                                        $child['plugin'] == $currentFunction['plugin'] &&
                                                        $child['controller'] == $currentFunction['controller'] &&
                                                        $child['action'] == $currentFunction['action']
                                                    ){
                                                        $activeC = "menu-item-active";
                                                    }
                                                }
                                            }

                                            ?>

                                                <li class="menu-item <?php echo $activeC; ?>" aria-haspopup="true">
                                                    <a href="{{ $child_link }}" class="menu-link">
                                                        <span class="svg-icon menu-icon submenu-icon">
                                                            <i class="<?php echo $child_cls_icon; ?> "></i>
                                                        </span>

                                                        <span class="menu-text">{{ __($child_name) }}</span>
                                                    </a>
                                                </li>


                                            <?php
                                        }
                                    ?>

                                </ul>
                            </div>
                        @endif

                    </li>
                    <?php
                }
            ?>
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
