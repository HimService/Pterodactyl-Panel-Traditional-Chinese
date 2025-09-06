@extends('layouts.admin')

@section('title')
    伺服器 — {{ $server->name }}: 刪除
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>從面板中刪除此伺服器。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">伺服器</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">刪除</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">安全刪除伺服器</h3>
            </div>
            <div class="box-body">
                <p>此操作將嘗試從面板和節點刪除伺服器。如果其中任何一個報告錯誤，該操作將被取消。</p>
                <p class="text-danger small">刪除伺服器是不可逆的操作。<strong>所有伺服器資料</strong>（包括檔案和使用者）將從系統中移除。</p>
            </div>
            <div class="box-footer">
                <form id="deleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button id="deletebtn" class="btn btn-danger">安全刪除此伺服器</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">強制刪除伺服器</h3>
            </div>
            <div class="box-body">
                <p>此操作將嘗試從面板和節點刪除伺服器。如果節點沒有回應或報告錯誤，刪除將繼續進行。</p>
                <p class="text-danger small">刪除伺服器是不可逆的操作。<strong>所有伺服器資料</strong>（包括檔案和使用者）將從系統中移除。如果節點報告錯誤，此方法可能會在您的節點上留下懸空檔案。</p>
            </div>
            <div class="box-footer">
                <form id="forcedeleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="force_delete" value="1" />
                    <button id="forcedeletebtn"" class="btn btn-danger">強制刪除此伺服器</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#deletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: '您確定要刪除此伺服器嗎？此操作無法復原，所有資料將立即被刪除。',
            showCancelButton: true,
            confirmButtonText: '刪除',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#deleteform').submit()
        });
    });

    $('#forcedeletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: '您確定要刪除此伺服器嗎？此操作無法復原，所有資料將立即被刪除。',
            showCancelButton: true,
            confirmButtonText: '刪除',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#forcedeleteform').submit()
        });
    });
    </script>
@endsection
