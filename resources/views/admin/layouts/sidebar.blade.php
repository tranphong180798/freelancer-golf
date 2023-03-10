<?php
use App\Constants\BaseConstants;
use App\Tasks\Admin\RoleTask;
use Illuminate\Support\Facades\Request;

$segment_check = Request::segment(2);
$user_role = Request()->user_role;
$user_role_id = Request()->user_role['role_id'];
$is_super_admin = ($user_role_id == BaseConstants::SUPER_ADMIN_ROLE_ID) ? true : false;

$sliderPermission = app(RoleTask::class)
    ->checkPermission('slider-management', [BaseConstants::READ_PERMISSION], $user_role);
$userModulePermission = app(RoleTask::class)
    ->checkPermission('user-management', [BaseConstants::READ_PERMISSION], $user_role);
$orderModulePermission = app(RoleTask::class)
    ->checkPermission('order-management', [BaseConstants::READ_PERMISSION], $user_role);
$pageModulePermission = app(RoleTask::class)
    ->checkPermission('page-management', [BaseConstants::READ_PERMISSION], $user_role);
$postModulePermission = app(RoleTask::class)
    ->checkPermission('post-management', [BaseConstants::READ_PERMISSION], $user_role);
$postCategoryModulePermission = app(RoleTask::class)
    ->checkPermission('post-category-management', [BaseConstants::READ_PERMISSION], $user_role);
$productModulePermission = app(RoleTask::class)
    ->checkPermission('product-management', [BaseConstants::READ_PERMISSION], $user_role);
$productCategoryModulePermission = app(RoleTask::class)
    ->checkPermission('product-category-management', [BaseConstants::READ_PERMISSION], $user_role);
$productVariableModulePermission = app(RoleTask::class)
    ->checkPermission('product-variable-management', [BaseConstants::READ_PERMISSION], $user_role);
$discountCodeModulePermission = app(RoleTask::class)
    ->checkPermission('discount-code-management', [BaseConstants::READ_PERMISSION], $user_role);
$importProductModulePermission = app(RoleTask::class)
    ->checkPermission('import-product-management', [BaseConstants::READ_PERMISSION], $user_role);
$exportProductModulePermission = app(RoleTask::class)
    ->checkPermission('export-product-management', [BaseConstants::READ_PERMISSION], $user_role);
$emailContactModulePermission = app(RoleTask::class)
    ->checkPermission('email-contact-management', [BaseConstants::READ_PERMISSION], $user_role);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{ asset('img/avatar-admin.png') }}" alt="{!! Helpers::get_setting('company_name') !!}"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{!! Helpers::get_setting('company_name') !!}</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Request()->admin_info->avatar == '')
                    <img src="{{ asset('img/avatar-admin.png') }}" class="img-circle elevation-2"
                         alt="{{ Request()->admin_info->name }}">
                @else
                    <img src="{{ asset('images/avatar/' . Request()->admin_info->avatar) }}" class="img-circle elevation-2"
                         alt="{{ Request()->admin_info->name }}">
                @endif
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{ Request()->admin_info->name }}</a>
            </div>
        </div>
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{route('index')}}" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Xem trang ch???</p>
                    </a>
                </li>
                @if($pageModulePermission)
                    <li class="nav-item has-treeview @if(in_array($segment_check, ['pages', 'page'])) menu-open @endif">
                        <a href="javascript:void(0)"
                           class="nav-link @if(in_array($segment_check, ['pages', 'page'])) active @endif">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Page
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.pages')}}"
                                   class="nav-link @if(in_array($segment_check, ['list-pages'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>List Page</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if($postModulePermission || $postCategoryModulePermission)
                    <li class="nav-item has-treeview @if(in_array(
                        $segment_check,
                        [
                            'list-post',
                            'post',
                            'post-categories',
                            'post-category'
]
                    )) menu-open @endif">
                        <a href="javascript:void(0)"
                           class="nav-link @if(in_array(
                                $segment_check,
                                ['list-post', 'post', 'post-categories', 'post-category']
                            )) active @endif">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Tin t???c
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($postModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.posts')}}"
                                       class="nav-link @if(in_array($segment_check, ['list-post'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>T???t c??? tin</p>
                                    </a>
                                </li>
                            @endif
                            @if($postCategoryModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.listPostCategories')}}"
                                       class="nav-link @if(in_array($segment_check, ['post-categories', 'post-category'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Th??? lo???i tin</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($productModulePermission || $productCategoryModulePermission || $productVariableModulePermission)
                    <li class="nav-item has-treeview @if(in_array(
                        $segment_check,
                        [
                            'products',
                            'product',
                            'product-categories',
                            'product-category',
                            'product-variables',
                            'product-variable',
                            'export-products',
                            'import-products',
                            'all-review-products',
                            'review-products',
                            'review-product'
                        ]
                    )) menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if(in_array(
                            $segment_check,
                            [
                                'products',
                                'product',
                                'product-categories',
                                'product-category',
                                'product-variables',
                                'product-variable',
                                'export-products',
                                'import-products',
                                'all-review-products',
                                'review-products',
                                'review-product'
]
                        )) active @endif">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                S???n ph???m
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($productModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.listProduct')}}"
                                       class="nav-link @if(in_array($segment_check, ['products', 'product'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>T???t c??? s???n ph???m</p>
                                    </a>
                                </li>
                            @endif

                            @if($productCategoryModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.listProductCategories')}}"
                                       class="nav-link @if(in_array($segment_check, ['product-categories', 'product-category'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Th??? lo???i s???n ph???m</p>
                                    </a>
                                </li>
                            @endif

                            @if($productVariableModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.listProductVariables')}}"
                                       class="nav-link @if(in_array($segment_check, ['product-variables', 'product-variable'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Bi???n th??? s???n ph???m</p>
                                    </a>
                                </li>
                            @endif

                            @if($exportProductModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.exportProduct')}}"
                                       class="nav-link @if(in_array($segment_check, ['export-products'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Xu???t Excel s???n ph???m</p>
                                    </a>
                                </li>
                            @endif
                            @if($exportProductModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.importProduct')}}"
                                       class="nav-link @if(in_array($segment_check, ['import-products'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>Nh???p s???n ph???m t??? Excel</p>
                                    </a>
                                </li>
                            @endif
                            @if($is_super_admin)
                                <li class="nav-item">
                                    <a href="{{ route('admin.updateCategorySupportSearch') }}"
                                       class="nav-link @if(in_array($segment_check, ['update-category-support-search'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>C???p nh???t Slug danh m???c</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if($orderModulePermission)
                    <li class="nav-item">
                        <a href="{{route('admin.listOrders')}}"
                           class="nav-link @if(in_array($segment_check, ['orders', 'order'])) active @endif">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>????n h??ng</p>
                        </a>
                    </li>
                @endif

                @if($discountCodeModulePermission)
                    <li class="nav-item">
                        <a href="{{route('admin.discountCode')}}"
                           class="nav-link @if(in_array($segment_check, ['discount-codes', 'discount-code'])) active @endif">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>M?? gi???m gi??</p>
                        </a>
                    </li>
                @endif

                @if($emailContactModulePermission)
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link @if(in_array($segment_check, ['email-contact'])) active @endif">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                ????ng k?? t?? v???n
                            </p>
                        </a>
                    </li>
                @endif

                @if($sliderPermission)
                    <li class="nav-item">
                        <a href="{{route('admin.slider')}}"
                           class="nav-link @if(in_array($segment_check, ['sliders', 'slider'])) active @endif">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Banner trang ch???</p>
                        </a>
                    </li>
                @endif

                @if($userModulePermission || $referralHistoryModulePermission)
                    <li class="nav-item has-treeview @if(in_array($segment_check, ['users', 'user'])) menu-open @endif">
                        <a href="javascript:void(0)"
                           class="nav-link @if(in_array($segment_check, ['users', 'user'])) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($userModulePermission)
                                <li class="nav-item">
                                    <a href="{{route('admin.user.index')}}" class="nav-link @if(in_array($segment_check, ['user'])) active @endif">
                                        <i class="fas fa-angle-right nav-icon"></i>
                                        <p>List Users</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($is_super_admin)
                    <li class="nav-item has-treeview @if(in_array($segment_check, ['managers', 'manager'])) menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link @if (in_array($segment_check, ['managers', 'manager'])) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Qu???n l?? t??i kho???n
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.listManagers') }}" class="nav-link @if(in_array($segment_check, ['managers'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Danh s??ch t??i kho???n</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">Ph??n Quy???n</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.listModules') }}" class="nav-link @if(in_array($segment_check, ['modules', 'module'])) active @endif">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>Danh s??ch ch???c n??ng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.listRoles') }}" class="nav-link @if(in_array($segment_check, ['roles', 'role'])) active @endif">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Danh s??ch vai tr??</p>
                        </a>
                    </li>
                    <!-- Setting -->
                    <li class="nav-header">C??i ?????t</li>
                    <li class="nav-item has-treeview
                        @if(in_array($segment_check, [
                            'theme-option',
                            'general-setting',
                            'menu',
                            'social-setting',
                            'smtp-setting',
                            'shipping-setting'
                        ])) menu-open @endif">
                        <a href="javascript:void(0)" class="nav-link
                            @if(in_array($segment_check, ['theme-option', 'general-setting', 'shipping-setting'])) active @endif">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                C??i ?????t v?? c???u h??nh
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.generalSetting') }}" class="nav-link
                                    @if(in_array($segment_check, ['general-setting'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>C??i ?????t chung</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.menu') }}" class="nav-link
                                    @if(in_array($segment_check, ['menu'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Menu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.shippingSetting') }}" class="nav-link
                                    @if(in_array($segment_check, ['shipping-setting'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>C??i ?????t v???n chuy???n</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.smtpSetting') }}" class="nav-link
                                    @if(in_array($segment_check, ['smtp-setting'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>C??i ?????t SMTP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.socialSetting') }}" class="nav-link
                                    @if(in_array($segment_check, ['social-setting'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>C??i ?????t m???ng x?? h???i</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.themeOption') }}" class="nav-link
                                    @if(in_array($segment_check, ['theme-option'])) active @endif">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>C??i ?????t m??? r???ng</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.clearCache')}}" class="nav-link">
                            <i class="nav-icon fas fa-eraser"></i>
                            <p>Xo?? cache trang</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.accountInformation') }}" class="nav-link
                    @if(in_array($segment_check, ['account-information'])) active @endif">
                        <i class="nav-icon far fa-user-circle"></i>
                        <p>Th??ng tin t??i kho???n</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.changePassword')}}" class="nav-link">
                        <i class="nav-icon fas fa-unlock-alt"></i>
                        <p>?????i m???t kh???u</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>????ng xu???t</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
