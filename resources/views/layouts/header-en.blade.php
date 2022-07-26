@php
    $user_id=auth()->user()->id;
    $permission =App\Permission::where('user_id',$user_id)->first();
@endphp
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <!--<a href="index" class="logo text-center">Admiria</a>-->
            <a href="index" class="logo"><img src="{{asset('public/uploads/posts')}}" height="36" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>

                <li>
                    <a href="{{url('/admin')}}" class="waves-effect"><i class=" mbri-edit"></i><span> {{trans('admin.dashboard')}}</span></a>
                </li>

                @if($permission->addclient =="yes" ||
                $permission->addinreciept =="yes" ||
                $permission->addoutreciept =="yes" ||
                $permission->recieptsarchieve =="yes" ||
                $permission->clientsArchieve =="yes" ||
                $permission->operationsonclients =="yes" ||
                $permission->operationsonclientsarchieve =="yes" ||
                $permission->clientaccountstatement =="yes")

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mbri-edit"></i> <span> {{trans('admin.ClientandprojectList')}} </span> </a>
                    <ul class="list-unstyled">
                        @if($permission->clientsArchieve == 'yes')
                        <li><a href="{{url('mainclient')}}"> {{trans('admin.setmainclients')}}</a></li>
                        @endif

                        @if($permission->addclient == 'yes')
                        <li><a href="{{url('client/create')}}"> {{trans('admin.addClient')}}</a></li>
                        @endif

                        @if($permission->addinreciept == 'yes')
                        <li><a href="{{url('recipts/create')}}"> {{trans('admin.addinreciept')}}</a></li>
                        @endif

                        @if($permission->addoutreciept == 'yes')
                        <li><a href="{{url('recipt/createout')}}"> {{trans('admin.addoutreciept')}}</a></li>
                        @endif

                        @if($permission->recieptsarchieve == 'yes')
                        <li><a href="{{url('recipts')}}"> {{trans('admin.recieptsArchieve')}}</a></li>
                        @endif

                        @if($permission->operationsonclients == 'yes')
                        <!-- <li><a href="#"> {{trans('admin.operationsonclients')}}</a></li> -->
                        @endif

                        @if($permission->operationsonclientsarchieve == 'yes')
                        <li><a href="{{url('client')}}"> {{trans('admin.operationsOnClientsArchieve')}}</a></li>
                        @endif

                        @if($permission->clientaccountstatement == 'yes')
                        <li><a href="{{url('account')}}"> {{trans('admin.ClientAccountStatement')}}</a></li>
                        @endif

                    </ul>
                </li>
                @endif

                @if($permission->websitepanel == 'yes')
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mbri-edit"></i> <span> {{trans('admin.websiteControll')}} </span> </a>
                        <ul class="list-unstyled">
                            <li class="">
                                <a href="{{url('maindata')}}"> {{trans('admin.maindata')}}</a>

                            </li>

                            <li class="">
                                <a href="{{url('latestnews')}}">{{trans('admin.latestnews')}}</a>

                            </li>

                            <li class="">
                                <a href="{{url('slider')}}">{{trans('admin.slider')}}</a>

                            </li>

                            <li class="">
                                <a href="{{url('mainservices')}}"> {{trans('admin.mainservices')}}</a>
                            </li>

                            <li class="">
                                <a href="{{url('category')}}"> {{trans('admin.categories')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('works')}}"> {{trans('admin.featuredworks')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('services')}}"> {{trans('admin.Services')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('about')}}"> {{trans('admin.whoweare')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('managerword')}}"> {{trans('admin.managerhint')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('parteners')}}"> {{trans('admin.parteners')}}</a>

                            </li>
                            <li class="">
                                <a href="{{url('map')}}"> {{trans('admin.map')}}</a>

                            </li>

                        </ul>
                    </li>
                @endif

                @if($permission->controllpanel == 'yes')
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="mbri-edit"></i> <span> {{trans('admin.Controlpanel')}} </span> </a>
                        <ul class="list-unstyled">
                            <li class="">
                                <a href="{{url('users')}}"> {{trans('admin.employeesandperSettings')}}</a>

                            </li>


                            <li class="">
                                <a href="{{url('projecttypes')}}"> {{trans('admin.projectTypeSettings')}}</a>

                            </li>

                            <li class="">
                                <a href="{{url('userstatistics')}}"> {{trans('admin.userstatistics')}}</a>

                            </li>

                            <li class="">
                                <a href="{{url('branch')}}"> {{trans('admin.branchs')}}</a>

                            </li>
                            @if($permission->inbox == 'yes')

                                <li class="">
                                    <a href="{{url('inbox')}}">  {{trans('admin.inbox')}}</a>

                                </li>
                                <li class="">
                                    <a href="{{url('sms')}}"> اعدادات الرسائل</a>

                                </li>
                            @endif
                            <li>
                                <a href="{{url('thirdparty')}}"> {{trans('admin.thirdparty')}}</a>
                            </li>
                            <li>
                                <a href="{{url('transactionstypes')}}"> {{trans('admin.transactionstype')}}</a>
                            </li>
                            <li class="">
                                <a href="{{url('sendall')}}"> {{trans('admin.sendall')}}</a>

                            </li>
                        </ul>
                    </li>
                @endif

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mbri-edit"></i> <span> {{trans('admin.transactions')}} </span> </a>
                    <ul class="list-unstyled">

                        <li>
                            <a href="{{url('transactions')}}">{{trans('admin.transactions')}} </a>
                        </li>
                        <li>
                            <a href="{{url('importcreate')}}">{{trans('admin.createimporttransaction')}} </a>
                        </li>
                        <li>
                            <a href="{{url('transactions/create')}}  ">{{trans('admin.createexporttransaction')}} </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->
