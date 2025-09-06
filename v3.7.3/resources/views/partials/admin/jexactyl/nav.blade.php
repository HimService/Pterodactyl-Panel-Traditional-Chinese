@section('jexactyl::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li @if($activeTab === 'index') class="active "@endif>
                        <a href="{{ route('admin.index') }}">主頁</a>
                    </li>
                    <li @if($activeTab === 'appearance') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.appearance') }}">外觀</a>
                    </li>
                    <li @if($activeTab === 'mail') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.mail') }}">郵件</a>
                    </li>
                    <li @if($activeTab === 'advanced') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.advanced') }}">進階</a>
                    </li>

                    <li style="margin-left: 5px; margin-right: 5px;"><a>-</a></li>

                    <li @if($activeTab === 'store') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.store') }}">商店</a>
                    </li>
                    <li @if($activeTab === 'registration') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.registration') }}">註冊</a>
                    </li>
                    <li @if($activeTab === 'approvals') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.approvals') }}">審核</a>
                    </li>
                    <li @if($activeTab === 'server') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.server') }}">伺服器設定</a>
                    </li>
                    <li @if($activeTab === 'referrals') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.referrals') }}">推薦</a>
                    </li>
                    <li @if($activeTab === 'alerts') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.alerts') }}">警報</a>
                    </li>
                    <li @if($activeTab === 'coupons') class="active" @endif>
                        <a href="{{ route('admin.jexactyl.coupons') }}">兌換碼</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
