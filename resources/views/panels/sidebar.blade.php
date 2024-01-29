<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
$userAccountType = null;
if ($user) {
    $userAccountType = $user->role_id;
}
?>
<div class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu.accordion menu-shadow"
    data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="mr-auto nav-item">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <span class="brand-logo">


                    </span>

  <img src="{{ asset('images/logo/infoseclogo.png') }}" alt="infosec" style="width: 100px; height: 50px;">

                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="pr-0 nav-link modern-nav-toggle" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- Foreach Admin menu item starts --}}
            @if ($userAccountType === 1)

                @if (isset($menuData[0]))
                    @foreach ($menuData[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                    class="d-flex align-items-center btn-flat-dark"
                                    target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- Foreach Manager menu item starts --}}
                @if (isset($menuDataManager[0]))
                    @foreach ($menuDataManager[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                    class="d-flex align-items-center btn-flat-dark"
                                    target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- Foreach Manager menu item starts --}}
                @if (isset($menuDataSupervisor[0]))
                    @foreach ($menuDataSupervisor[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                    class="d-flex align-items-center btn-flat-dark"
                                    target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif

            @elseif ($userAccountType === 2)
                @if (isset($menuData[0]))
                    @foreach ($menuData[0]->staffmenu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                   class="d-flex align-items-center btn-flat-dark"
                                   target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- Foreach Manager menu item starts --}}
                @if (isset($menuDataManager[0]))
                    @foreach ($menuDataManager[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                   class="d-flex align-items-center btn-flat-dark"
                                   target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- Foreach Manager menu item starts --}}
                @if (isset($menuDataSupervisor[0]))
                    @foreach ($menuDataSupervisor[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('' . $menu->navheader) }}</span>
                                <i data-feather="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                   class="d-flex align-items-center btn-flat-dark"
                                   target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <span class="material-symbols-outlined">{{ $menu->icon }}</span>
                                    <span class="menu-title text-truncate">{{ __('' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels.submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif

            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
