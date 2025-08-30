@extends('layouts.admin')

@section('title')
    核心區 &rarr; 新增核心
@endsection

@section('content-header')
    <h1>新增核心<small>建立一個新的核心以分配給伺服器。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nests') }}">核心區</a></li>
        <li class="active">新增核心</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.egg.new') }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">組態</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pNestId" class="form-label">關聯的核心區</label>
                                <div>
                                    <select name="nest_id" id="pNestId">
                                        @foreach($nests as $nest)
                                            <option value="{{ $nest->id }}" {{ old('nest_id') != $nest->id ?: 'selected' }}>{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">將核心區視為一個類別。您可以在一個核心區中放置多個核心，但請考慮在每個核心區中只放置相互關聯的核心。</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pName" class="form-label">名稱</label>
                                <input type="text" id="pName" name="name" value="{{ old('name') }}" class="form-control" />
                                <p class="text-muted small">一個簡單、易於閱讀的名稱，用作此核心的識別碼。這將是使用者看到的遊戲伺服器類型。</p>
                            </div>
                            <div class="form-group">
                                <label for="pDescription" class="form-label">描述</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                                <p class="text-muted small">此核心的描述。</p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" {{ \Pterodactyl\Helpers\Utilities::checked('force_outgoing_ip', 0) }} />
                                    <label for="pForceOutgoingIp" class="strong">強制傳出 IP</label>
                                    <p class="text-muted small">
                                        強制所有傳出的網路流量的來源 IP NAT 到伺服器主要分配 IP 的 IP。
                                        當節點具有多個公用 IP 位址時，某些遊戲需要此項才能正常運作。
                                        <br>
                                        <strong>
                                            啟用此選項將停用任何使用此核心的伺服器的內部網路，
                                            導致它們無法在內部存取同一節點上的其他伺服器。
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Docker 映像檔</label>
                                <textarea id="pDockerImages" name="docker_images" rows="4" placeholder="quay.io/pterodactyl/service" class="form-control">{{ old('docker_images') }}</textarea>
                                <p class="text-muted small">使用此核心的伺服器可用的 docker 映像檔。每行輸入一個。如果提供多個值，使用者將能夠從此映像檔清單中選取。</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">啟動指令</label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="10">{{ old('startup') }}</textarea>
                                <p class="text-muted small">使用此核心建立的新伺服器應使用的預設啟動指令。您可以視需要為每個伺服器變更此設定。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">程序管理</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>所有欄位都是必填的，除非您從「從中複製設定」下拉式選單中選取一個單獨的選項，在這種情況下，可以將欄位留空以使用該選項的值。</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">從中複製設定</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">無</option>
                                </select>
                                <p class="text-muted small">如果您想預設使用另一個核心的設定，請從上面的下拉式選單中選取它。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">停止指令</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ old('config_stop') }}" />
                                <p class="text-muted small">應傳送至伺服器程序以正常停止它們的指令。如果您需要傳送 <code>SIGINT</code>，您應該在此處輸入 <code>^C</code>。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">日誌組態</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ old('config_logs') }}</textarea>
                                <p class="text-muted small">這應該是日誌檔案儲存位置的 JSON 表示，以及Wings是否應建立自訂日誌。</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">組態檔</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ old('config_files') }}</textarea>
                                <p class="text-muted small">這應該是要修改的組態檔以及應變更哪些部分的 JSON 表示。</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">啟動組態</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ old('config_startup') }}</textarea>
                                <p class="text-muted small">這應該是Wings在啟動伺服器以確定完成時應尋找的值的 JSON 表示。</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success btn-sm pull-right">建立</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    <script>
    $(document).ready(function() {
        $('#pNestId').select2().change();
        $('#pConfigFrom').select2();
    });
    $('#pNestId').on('change', function (event) {
        $('#pConfigFrom').html('<option value="">None</option>').select2({
            data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                return {
                    id: item.id,
                    text: item.name + ' <' + item.author + '>',
                };
            }),
        });
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
    </script>
@endsection
