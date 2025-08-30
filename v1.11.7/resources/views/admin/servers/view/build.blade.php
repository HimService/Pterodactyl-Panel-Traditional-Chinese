@extends('layouts.admin')

@section('title')
    伺服器 — {{ $server->name }}: 組建詳細資訊
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>控制此伺服器的 IP 分配和系統資源。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">伺服器</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">組建組態</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <form action="{{ route('admin.servers.view.build', $server->id) }}" method="POST">
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">資源管理</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                        <label for="cpu" class="control-label">CPU 限制</label>
                        <div class="input-group">
                            <input type="text" name="cpu" class="form-control" value="{{ old('cpu', $server->cpu) }}"/>
                            <span class="input-group-addon">%</span>
                        </div>
                        <p class="text-muted small">系統上的每個<em>虛擬</em>核心區（執行緒）都被視為 <code>100%</code>。將此值設為 <code>0</code> 將允許伺服器不受限制地使用 CPU 時間。</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">CPU 核心區綁定</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="{{ old('threads', $server->threads) }}"/>
                        </div>
                        <p class="text-muted small"><strong>進階：</strong> 輸入此程序可以運行的特定 CPU 核心區，或留空以允許所有核心區。這可以是單個數字，也可以是逗號分隔的列表。例如：<code>0</code>、<code>0-1,3</code> 或 <code>0,1,3,4</code>。</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">已分配記憶體</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="{{ old('memory', $server->memory) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">此容器允許的最大記憶體量。將此值設為 <code>0</code> 將允許容器使用無限的記憶體。</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">已分配虛擬記憶體</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="{{ old('swap', $server->swap) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">將此值設為 <code>0</code> 將停用此伺服器上的虛擬記憶體。設為 <code>-1</code> 將允許無限的虛擬記憶體。</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">硬碟空間限制</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="{{ old('disk', $server->disk) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">如果伺服器使用的空間超過此數量，將不允許開機。如果伺服器在運行時超過此限制，它將被安全地停止並鎖定，直到有足夠的可用空間。設為 <code>0</code> 以允許無限的硬碟使用。</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">Block IO 權重</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="{{ old('io', $server->io) }}"/>
                        </div>
                        <p class="text-muted small"><strong>進階</strong>：此伺服器相對於系統上其他<em>正在運行的</em>容器的 IO 效能。值應介於 <code>10</code> 和 <code>1000</code> 之間。</code></p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">OOM Killer</label>
                        <div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pOomKillerEnabled" value="0" name="oom_disabled" @if(!$server->oom_disabled)checked @endif>
                                <label for="pOomKillerEnabled">啟用</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pOomKillerDisabled" value="1" name="oom_disabled" @if($server->oom_disabled)checked @endif>
                                <label for="pOomKillerDisabled">停用</label>
                            </div>
                            <p class="text-muted small">
                                啟用 OOM Killer 可能會導致伺服器程序意外退出。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">應用程式功能限制</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="database_limit" class="control-label">資料庫限制</label>
                                    <div>
                                        <input type="text" name="database_limit" class="form-control" value="{{ old('database_limit', $server->database_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">允許使用者為此伺服器建立的資料庫總數。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">IP 分配限制</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', $server->allocation_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">允許使用者為此伺服器建立的 IP 分配總數。</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">備份限制</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="{{ old('backup_limit', $server->backup_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">可以為此伺服器建立的備份總數。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">IP 分配管理</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pAllocation" class="control-label">遊戲連接埠</label>
                                <select id="pAllocation" name="allocation_id" class="form-control">
                                    @foreach ($assigned as $assignment)
                                        <option value="{{ $assignment->id }}"
                                            @if($assignment->id === $server->allocation_id)
                                                selected="selected"
                                            @endif
                                        >{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">將用於此遊戲伺服器的預設連線位址。</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">分配額外連接埠</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        @foreach ($unassigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">請注意，由於軟體限制，您無法將不同 IP 上的相同連接埠分配給同一台伺服器。</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">移除額外連接埠</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        @foreach ($assigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">只需從上面的列表中選擇您要移除的連接埠。如果您想在一個已被使用的不同 IP 上分配一個連接埠，您可以從左側選擇它並在此處刪除它。</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary pull-right">更新組建組態</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pAddAllocations').select2();
    $('#pRemoveAllocations').select2();
    $('#pAllocation').select2();
    </script>
@endsection
