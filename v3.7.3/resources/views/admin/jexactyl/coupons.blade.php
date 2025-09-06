@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'coupons'])

@section('title')
    優惠券
@endsection

@section('content-header')
    <h1>優惠券<small>建立和管理優惠券。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
    <form action="{{ route('admin.jexactyl.coupons') }}" method="POST">
        <div class="row">
            <div class="col-xs-12">
                <div class="box @if($enabled) box-success @else box-danger @endif">
                    <div class="box-header with-border">
                        <i class="fa fa-cash"></i>
                        <h3 class="box-title">優惠券系統</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="enabled" class="control-label">狀態</label>
                                <select name="enabled" id="enabled" class="form-control">
                                    <option value="1" @if($enabled) selected @endif>已啟用</option>
                                    <option value="0" @if(!$enabled) selected @endif>已停用</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">儲存</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('admin.jexactyl.coupons.store') }}" method="POST">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">建立優惠券</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="code">代碼</label>
                                <input type="text" name="code" id="code" class="form-control"/>
                                <small>優惠券的唯一代碼。</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="credits">點數</label>
                                <input type="number" name="credits" id="credits" class="form-control"/>
                                <small>兌換時給予的點數金額。</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="expires">到期時間</label>
                                <input type="number" name="expires" id="expires" class="form-control" value="12"/>
                                <small>優惠券到期前的小時數。留空則永不過期。</small>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="uses">最大使用次數</label>
                                <input type="number" name="uses" id="uses" class="form-control" value="1"/>
                                <small>此優惠券可使用的最大次數。</small>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="POST" class="btn btn-default pull-right">建立</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">優惠券</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>代碼</th>
                            <th>點數</th>
                            <th>剩餘使用次數</th>
                            <th>到期時間</th>
                            <th>已過期</th>
                        </tr>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->cr_amount }}</td>
                                <td>{{ $coupon->uses }}</td>
                                <td>{{ $coupon->expires }}</td>
                                <td>@if($coupon->expired) 是 @else 否 @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
