@extends('layouts.admin')

@section('title')
    {{ $node->name }}: 配置
@endsection

@section('content-header')
    <h1>{{ $node->name }}<small>您的Wings配置檔。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nodes') }}">節點</a></li>
        <li><a href="{{ route('admin.nodes.view', $node->id) }}">{{ $node->name }}</a></li>
        <li class="active">配置</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="{{ route('admin.nodes.view', $node->id) }}">關於</a></li>
                <li><a href="{{ route('admin.nodes.view.settings', $node->id) }}">設定</a></li>
                <li class="active"><a href="{{ route('admin.nodes.view.configuration', $node->id) }}">配置</a></li>
                <li><a href="{{ route('admin.nodes.view.allocation', $node->id) }}">分配</a></li>
                <li><a href="{{ route('admin.nodes.view.servers', $node->id) }}">伺服器</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">配置檔</h3>
            </div>
            <div class="box-body">
                <pre class="no-margin">{{ $node->getYamlConfiguration() }}</pre>
            </div>
            <div class="box-footer">
                <p class="no-margin">此檔案應放置在您的Wings根目錄中 (通常是 <code>/etc/pterodactyl</code>)，並命名為 <code>config.yml</code>。</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">自動部署</h3>
            </div>
            <div class="box-body">
                <p class="text-muted small">
                    使用下方的按鈕產生自訂部署指令，該指令可用於透過單一指令在目標伺服器上設定 wings。
                </p>
            </div>
            <div class="box-footer">
                <button type="button" id="configTokenBtn" class="btn btn-sm btn-default" style="width:100%;">產生指令</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#configTokenBtn').on('click', function (event) {
        $.ajax({
            method: 'POST',
            url: '{{ route('admin.nodes.view.configuration.token', $node->id) }}',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        }).done(function (data) {
            swal({
                type: 'success',
                title: '指令已建立。',
                text: '<p>若要自動設定您的節點，請執行下列指令：<br /><small><pre>cd /etc/pterodactyl && sudo wings configure --panel-url {{ config('app.url') }} --token ' + data.token + ' --node ' + data.node + '{{ config('app.debug') ? ' --allow-insecure' : '' }}</pre></small></p>',
                html: true
            })
        }).fail(function () {
            swal({
                title: '錯誤',
                text: '建立您的指令時發生錯誤。',
                type: 'error'
            });
        });
    });
    </script>
@endsection
