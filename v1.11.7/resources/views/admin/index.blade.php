@extends('layouts.admin')

@section('title')
    管理
@endsection

@section('content-header')
    <h1>管理概覽<small>快速瀏覽您的面板概況。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">總覽</li>
    </ol>
@endsection

@section('content')
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
                <h3 class="box-title">系統資訊</h3>
</div>
<div class="box-body">
    @if ($version->isLatestPanel())
        <p>您正在執行 Pterodactyl 面板版本 <code>{{ config('app.version') }}</code>。</p>
        <p>您的面板已是最新版本！</p>
        <p class="text-white">
            備註: 你現在正在使用 HimService 所製作的繁體中文翻譯，我們僅在此頁面的下方添加一個本翻譯的 Github 專案按鈕。其餘不做改動，僅翻譯。希望您可以為我們的專案添加星星。<br>
            另外，我們建議您定期檢查面板是否是最新版本。
        </p>
    @else
        <p>您的面板 <strong class="text-danger">不是最新版本！</strong></p>
        <p>
            最新版本為 
            <a href="https://github.com/Pterodactyl/Panel/releases/v{{ $version->getPanel() }}" target="_blank">
                <code>{{ $version->getPanel() }}</code>
            </a>，而您目前執行的版本為 <code>{{ config('app.version') }}</code>。
        </p>
        <p class="text-white">
            備註: 你現在正在使用 HimService 所製作的繁體中文翻譯，我們僅在此頁面的下方添加一個本翻譯的 Github 專案按鈕。其餘不做改動，僅翻譯。希望您可以為我們的專案添加星星。<br>
            另外，我們建議您盡快更新面板以獲得最新功能與安全修補。
        </p>
    @endif
</div>


<style>
.equal-btn {
    width: 100%;
    min-height: 60px; /* 可以調整這個數字控制高度 */
    white-space: normal; /* 讓文字可以換行，不會撐爆按鈕 */
}
</style>

<div class="row text-center">
    <div class="col-xs-6 col-sm-2">
        <a href="{{ $version->getDiscord() }}">
            <button class="btn btn-warning equal-btn">
                <i class="fa fa-fw fa-support"></i> 面板支援 <small>(Discord)</small>
            </button>
        </a>
    </div>

    <div class="col-xs-6 col-sm-2">
        <a href="https://pterodactyl.io">
            <button class="btn btn-primary equal-btn">
                <i class="fa fa-fw fa-link"></i> 翼手龍面板文件
            </button>
        </a>
    </div>

    <div class="col-xs-6 col-sm-2">
        <a href="https://github.com/pterodactyl/panel">
            <button class="btn btn-primary equal-btn">
                <i class="fa fa-fw fa-support"></i> 翼手龍面板 Github
            </button>
        </a>
    </div>

    <div class="col-xs-6 col-sm-2">
        <a href="{{ $version->getDonations() }}">
            <button class="btn btn-success equal-btn">
                <i class="fa fa-fw fa-money"></i> 支持翼手龍面板專案
            </button>
        </a>
    </div>

    <div class="col-xs-6 col-sm-2">
        <a href="https://github.com/HimService/Pterodactyl-Panel-Traditional-Chinese">
            <button class="btn btn-primary equal-btn">
                <i class="fa fa-fw fa-support"></i> 繁體翻譯專案 Github
            </button>
        </a>
    </div>

    <div class="col-xs-6 col-sm-2">
        <a href="https://discord.gg/nn5jeuZHWX">
            <button class="btn btn-primary equal-btn">
                <i class="fa fa-fw fa-support"></i> 翻譯專案支援 <small>(Discord)</small>
            </button>
        </a>
    </div>
</div>


@endsection
