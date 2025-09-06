@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'index'])

@section('title')
    Jexactyl 設定
@endsection

@section('content-header')
    <h1>Jexactyl 設定<small>為面板設定 Jexactyl 特定設定。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')

    <div class="row">
        <div class="col-xs-12">
            <div class="box
                @if($version->isLatestPanel())
                    box-success
                @else
                    box-danger
                @endif
            ">
                <div class="box-header with-border">
                    <i class="fa fa-code-fork"></i> <h3 class="box-title">軟體版本 <small>驗證 Jexactyl 是否為最新版本。</small></h3>
                </div>
                <div class="box-body">
                    @if ($version->isLatestPanel())
                        您正在執行 Jexactyl <code>{{ config('app.version') }}</code>。
                        <p class="text-white">
                            備註: 你現在正在使用 HimService 所製作的繁體中文翻譯，我們僅在此頁面的下方添加一個本翻譯的 Github 專案按鈕和一個支援用的 Discord 按鈕，其餘不做改動，僅翻譯。希望您可以為我們的專案添加星星。
                        </p>
                    @else
                        Jexactyl 不是最新版本。<code>{{ config('app.version') }} (目前) -> <a href="https://github.com/jexactyl/jexactyl/releases/v{{ $version->getPanel() }}" target="_blank">{{ $version->getPanel() }}</a> (最新)</code>
                        <p class="text-white">
                            備註: 你現在正在使用 HimService 所製作的繁體中文翻譯，我們僅在此頁面的下方添加一個本翻譯的 Github 專案按鈕和一個支援用的 Discord 按鈕，其餘不做改動，僅翻譯。希望您可以為我們的專案添加星星。
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-server"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">伺服器總數</span>
                        <span class="info-box-number">{{ count($servers) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-wifi"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">分配總數</span>
                        <span class="info-box-number">{{ $allocations }}</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">總記憶體使用量</span>
                        <span class="info-box-number">{{ $used['memory'] }} MB of {{ $available['memory'] }} MB</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-hdd-o"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">總硬碟使用量</span>
                        <span class="info-box-number">{{ $used['disk'] }} MB of {{ $available['disk'] }} MB </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart"></i> <h3 class="box-title">資源利用率 <small>已用資源總量概覽。</small></h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-4">
                        <canvas id="servers_chart" width="100%" height="50">
                            <p class="text-muted">此圖表無可用資料。</p>
                        </canvas>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <canvas id="ram_chart" width="100%" height="50">
                            <p class="text-muted">此圖表無可用資料。</p>
                        </canvas>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <canvas id="disk_chart" width="100%" height="50">
                            <p class="text-muted">此圖表無可用資料。</p>
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="row" style="margin-top:15px;">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">面板/翻譯專案-支援</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a href="{{ $version->getDiscord() }}">
                            <div class="info-box hover-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-support"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">面板支援</span>
                                    <span class="info-box-number">Discord</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a href="https://docs.jexactyl.com/#/README">
                            <div class="info-box hover-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-link"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jexactyl面板文件</span>
                                    <span class="info-box-number">&nbsp;</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a href="https://github.com/Jexactyl/Jexactyl">
                            <div class="info-box hover-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-github"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jexactyl面板 Github</span>
                                    <span class="info-box-number">&nbsp;</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a href="https://github.com/HimService/Pterodactyl-Panel-Traditional-Chinese/tree/Jexactyl">
                            <div class="info-box hover-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-github"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">繁體翻譯專案 Github</span>
                                    <span class="info-box-number">&nbsp;</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a href="https://discord.gg/nn5jeuZHWX">
                            <div class="info-box hover-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-support"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">翻譯專案支援</span>
                                    <span class="info-box-number">Discord</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-box {
    cursor: pointer;
    transition: transform 0.2s;
}
.hover-box:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
</style>


@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/chartjs/chart.min.js') !!}
    {!! Theme::js('js/admin/statistics.js') !!}
@endsection
