@extends('layouts.admin')

@section('title')
    票務列表
@endsection

@section('content-header')
    <h1>Tickets<small>查看系統上的所有票務。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">票務</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('admin.tickets.index') }}" method="POST">
            <div class="box @if($enabled == 'true') box-success @else box-danger @endif">
                <div class="box-header with-border">
                    <i class="fa fa-ticket"></i> <h3 class="box-title">票務系統 <small>切換設定是否可以使用票務</small></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">允許建立票務？</label>
                            <div>
                                <select name="enabled" class="form-control">
                                    <option @if ($enabled == 'false') selected @endif value="false">禁用</option>
                                    <option @if ($enabled == 'true') selected @endif value="true">啟用</option>
                                </select>
                                <p class="text-muted"><small>決定使用者是否可以透過客戶端介面建立 Ticket。</small></p>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                                <label class="control-label">票單最大數量</label>
                                <div>
                                    <input type="text" class="form-control" name="max" value="{{ $max }}" />
                                    <p class="text-muted"><small>設定使用者可以建立的票單最大數量。</small></p>
                                </div>
                            </div>
                    </div>
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="POST" class="btn btn-default pull-right">儲存變更</button>
                </div>
            </div>
        </form>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">票單列表</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>票單 ID</th>
                            <th>客戶電子郵件</th>
                            <th>標題</th>
                            <th>建立於</th>
                            <th></th>
                        </tr>
                        @foreach ($tickets as $ticket)
                            <tr data-ticket="{{ $ticket->id }}">
                                <td><a href="{{ route('admin.tickets.view', $ticket->id) }}">{{ $ticket->id }}</a></td>
                                <td><a href="{{ route('admin.users.view', $ticket->client_id) }}">{{ $ticket->user->email ?? 'N/A' }}</a></td>
                                <td style="
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    max-width: 32ch;
                                "><code title="{{ $ticket->title }}">{{ $ticket->title }}</code></td>
                                <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @if($ticket->status == 'pending')
                                        <span class="label label-warning">待處理</span>
                                    @elseif($ticket->status == 'in-progress')
                                        <span class="label label-primary">處理中</span>
                                    @elseif($ticket->status == 'unresolved')
                                        <span class="label label-danger">未解決</span>
                                    @else
                                        <span class="label label-success">已解決</span>
                                    @endif
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
