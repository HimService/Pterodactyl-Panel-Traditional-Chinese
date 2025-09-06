@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'approvals'])

@section('title')
    使用者核准
@endsection

@section('content-header')
    <h1>使用者核准<small>允許或拒絕建立帳戶的請求。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
    <form action="{{ route('admin.jexactyl.approvals') }}" method="POST">
        <div class="row">
            <div class="col-xs-12">
                <div class="box
                    @if($enabled == 'true')
                        box-success
                    @else
                        box-danger
                    @endif
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-users"></i>
                        <h3 class="box-title">核准系統 <small>決定核准系統是啟用還是停用。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">已啟用</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option @if ($enabled == 'false') selected @endif value="false">已停用</option>
                                        <option @if ($enabled == 'true') selected @endif value="true">已啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否必須由管理員核准才能使用面板。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label" for="webhook">Webhook 網址</label>
                                <input name="webhook" id="webhook" class="form-control" value="{{ $webhook }}">
                                <p class="text-muted"><small>提供當使用者需要核准時要使用的 Discord Webhook 網址。</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="box box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">儲存變更</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-list"></i>
                    <h3 class="box-title">核准請求 <small>允許或拒絕建立帳戶的請求。</small></h3>
                    <form id="massdenyform" action="{{ route('admin.jexactyl.approvals.all', 'deny') }}" method="POST">
                        {!! csrf_field() !!}
                        <button id="denyAllBtn" class="btn btn-danger pull-right">全部拒絕</button>
                    </form>
                    <form id="massapproveform" action="{{ route('admin.jexactyl.approvals.all', 'approve') }}" method="POST">
                        {!! csrf_field() !!}
                        <button id="approveAllBtn" class="btn btn-success pull-right">全部核准</button>
                    </form>
                 </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>使用者 ID</th>
                                <th>電子郵件</th>
                                <th>使用者名稱</th>
                                <th>已註冊</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <code>{{ $user->id }}</code>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <code>{{ $user->username }}</code> ({{ $user->name_first }} {{ $user->name_last }})
                                    </td>
                                    <td>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <form id="approveform" action="{{ route('admin.jexactyl.approvals.approve', $user->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button id="approvalApproveBtn" class="btn btn-xs btn-default">
                                                <i class="fa fa-check text-success"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form id="denyform" action="{{ route('admin.jexactyl.approvals.deny', $user->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            <button id="approvalDenyBtn" class="btn btn-xs btn-default">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#approvalDenyBtn').on('click', function (event) {
        event.preventDefault();

        swal({
            type: 'error',
            title: '拒絕此請求？',
            text: '這將立即從面板中移除此使用者。',
            showCancelButton: true,
            confirmButtonText: '拒絕',
            confirmButtonColor: 'red',
            closeOnConfirm: false
        }, function () {
            $('#denyform').submit()
        });
    });

    $('#approvalApproveBtn').on('click', function (event) {
        event.preventDefault();

        swal({
            type: 'success',
            title: '核准此請求？',
            text: '此使用者將立即獲得面板的存取權限。',
            showCancelButton: true,
            confirmButtonText: '核准',
            confirmButtonColor: 'green',
            closeOnConfirm: false
        }, function () {
            $('#approveform').submit()
        });
    });

    $('#approveAllBtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '核准所有使用者？',
            text: '這將核准所有等待核准的使用者。',
            showCancelButton: true,
            confirmButtonText: '全部核准',
            confirmButtonColor: 'green',
            closeOnConfirm: false
        }, function () {
            $('#massapproveform').submit()
        });
    });

    $('#denyAllBtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '拒絕所有使用者？',
            text: '這將拒絕所有等待核准的使用者。',
            showCancelButton: true,
            confirmButtonText: '全部拒絕',
            confirmButtonColor: 'red',
            closeOnConfirm: false
        }, function () {
            $('#massdenyform').submit()
        });
    });
    </script>
@endsection
