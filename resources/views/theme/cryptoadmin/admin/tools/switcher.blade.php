<div id="guard-switcher" class="text-center">
    <div class="align-middle mt-10">
        <a href="{{route('login')}}">
            @if(Auth::guard('web')->check())
                <span class="badge badge-pill badge-success"> User </span>
            @else
                <span class="badge badge-pill badge-default"> User </span>
            @endif
        </a>
    </div>
    <div class="align-middle mt-2">
        <a href="{{route('member.login')}}">
            @if(Auth::guard('member')->check())
                <span class="badge badge-pill badge-success">Member</span>
            @else
                <span class="badge badge-pill badge-default">Member</span>
            @endif
        </a>
    </div>
    <div class="align-middle mt-2">
        <a href="{{route('admin.login')}}">
            @if(Auth::guard('admin')->check())
                <span class="badge badge-pill badge-success">Admin</span>
            @else
                <span class="badge badge-pill badge-default">Admin</span>
            @endif
        </a>
    </div>
</div>

@if(Auth::guard('admin')->check())
    @php
        $users = App\Models\User::get();
        $members = App\Models\Member::get();
        $admins = App\Models\Admin::get();
    @endphp
    <div id="guard-switcher-user" class="text-center">
        <div class="align-middle mt-10">
            User:
            <select class="form-control">
                <option>Select...</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}" {{$user->id==Auth::guard('web')->user()->id? "selected":""}}>{{$user->name}}</option>
                @endforeach
            </select>

            Member:
            <select class="form-control">
                <option>Select...</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}" {{$member->id==Auth::guard('member')->user()->id? "selected":""}}>{{$member->name}}</option>
                @endforeach
            </select>
            Admin:
            <select class="form-control">
                <option>Select...</option>
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}" {{$admin->id==Auth::guard('admin')->user()->id? "selected":""}}>{{$admin->name}}</option>
                @endforeach
            </select>
        </div>


    </div>
@endif


<style type="text/css">
    #guard-switcher{
        position:fixed;
        top: 100px;
        bottom: 0px;
        right: 0px;
        width: 60px;
        height: 100px;
        background: lightgrey;
        border: lightgrey solid 1px;
        z-index: 99;
    }

    #guard-switcher-user{
        position:fixed;
        bottom: 150px;
        right: 0px;
        width: 100px;
        height: 200px;
        background: lightgrey;
        border: lightgrey solid 1px;
        z-index: 99;
    }
</style>

<div class="side-bar">
    <a href="#" class="icon-qq">xxx</a>
    <a href="#" class="icon-chat">微信<div class="chat-tips"><i></i>
            <img style="width:138px;height:138px;" src="" alt="微信订阅号"></div></a>
    <a target="_blank" href="" class="icon-blog">微博</a>
</div>
<style>
    .side-bar {width: 66px;position: fixed;top: 230px;right: 0px;font-size: 0;line-height: 0;z-index: 100;}
    /*.side-bar a,.chat-tips i {background: url('right_bg.png') no-repeat;}*/
    .side-bar a {width: 66px;height: 66px; display: inline-block;background-color: #ddd; margin-bottom: 2px;}
    .side-bar a:hover {background-color: #669fdd;}
    .side-bar .icon-qq {background-position: 0 -62px;}
    .side-bar .icon-chat {background-position: 0 -130px;position: relative;}
    .side-bar .icon-blog {background-position: 0 -198px;}
    .side-bar .icon-mail {background-position: 0 -266px;}


    .side-bar .icon-chat:hover .chat-tips {display: block;}
    .chat-tips {padding: 20px;border: 1px solid #d1d2d6;position: absolute;right: 78px;top: -55px;background-color: #fff;display: none;}
    .chat-tips i {width: 9px;height: 16px;display: inline-block;position: absolute;right: -9px;top: 80px;background-position:-88px -350px;}
    .chat-tips img {width: 138px;height: 138px;}
</style>
