@extends('layouts.admin')

@section('title')
    查看 Ticket {{ $ticket->id }}
@endsection

@section('content-header')
    <h1>Ticket #{{ $ticket->id }}<small>{{ $ticket->title }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.tickets.index') }}">Tickets</a></li>
        <li class="active">查看 Ticket {{ $ticket->id }}</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="alert
            @if($ticket->status == 'pending')
                alert-warning
            @elseif($ticket->status == 'in-progress')
                bg-primary
            @elseif($ticket->status == 'unresolved')
                alert-danger
            @else
                alert-success
            @endif
        ">
            此 Ticket 目前標記為 <code>{{ $ticket->status }}</code>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <form id="deleteform" action="{{ route('admin.tickets.delete', $ticket->id) }}" method="POST">
                        <div class="pull-left">
                            {!! csrf_field() !!}
                            <button class="btn btn-danger">刪除 Ticket</button>
                        </div>
                    </form>
                    <form id="statusform" action="{{ route('admin.tickets.status', $ticket->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="pull-right">
                            <button id="unresolvedButton" class="btn btn-danger" name="status" value="unresolved">標記為未解決</button>
                            <button id="pendingButton" class="btn btn-warning" style="margin-left: 8px;" name="status" value="pending">標記為待處理</button>
                            <button id="resolvedButton" class="btn btn-success" style="margin-left: 8px;" name="status" value="resolved">標記為已解決</button>
                            <button id="inProgressButton" class="btn btn-info" style="margin-left: 8px;" name="status" value="in-progress">標記為處理中</button>
                        </div>
                    </form>
                 </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>作者</th>
                                <th>內容</th>
                                <th></th>
                                <th></th>
                                <th>訊息已傳送</th>
                            </tr>
                            @foreach ($messages as $message)
                                <tr>
                                @if($message->user_id == 0)
                                    <td>系統訊息 <i class="fa fa-cog text-white"></i></td>
                                @else
                                    <td><a href="{{ route('admin.users.view', $message->user->id) }}">{{ $message->user->email }}</a> @if($message->user->root_admin)<i class="fa fa-star text-yellow"></i>@endif</td>
                                @endif
                                    <td>{{ $message->content }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $message->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">傳送訊息</h3>
                    <form id="messageform" action="{{ route('admin.tickets.message', $ticket->id) }}" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div>
                                        <input type="text" class="form-control" name="content" />
                                        <p class="text-muted"><small>向 Ticket 傳送一則客戶可見的訊息。</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="POST" class="btn btn-default pull-right">傳送訊息</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
