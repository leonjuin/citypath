<ul class="left-menu-list left-menu-list-root list-unstyled">

    <li class="left-menu-list-submenu">
        <a class="left-menu-link" href="javascript: void(0);">
            <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
            Applications
        </a>
        <ul class="left-menu-list list-unstyled">
            <li>
                <a class="left-menu-link" href="{{url('/admin/user')}}">
                    Users
                </a>
            </li>                    
        </ul>
    </li>

    <li class="left-menu-list-separator"><!-- --></li>
 
    <!-- Start of modification -->
    <li class="left-menu-list-submenu">
        <a class="left-menu-link" href="javascript: void(0);">
            <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
            Admin Management
        </a>
        <ul class="left-menu-list list-unstyled">
            <li>
                <a class="left-menu-link" href="{{url('/admin/request-approval')}}">
                    Admin Approval
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="{{url('/admin/list')}}">
                    Admin Listing
                </a>
            </li>            
            <li>
                <a class="left-menu-link" href="{{url('/admin/logs')}}">
                    Admin Log
                </a>
            </li>                        
        </ul>
    </li>
    <li class="left-menu-list-separator"><!-- --></li>

    <li class="left-menu-list-submenu">
        
        <a class="left-menu-link" href="javascript: void(0);">
            <i class="left-menu-link-icon icmn-cog util-spin-delayed-pseudo"><!-- --></i>
            <span class="menu-top-hidden">App</span> Settings
        </a>
        <ul class="left-menu-list list-unstyled">
            <li>
                <div class="left-menu-item">
                    <div class="left-menu-block">
                        <div class="left-menu-block-item">
                            <small></small>
                        </div>
                        <div class="left-menu-block-item">
                            <span class="font-weight-600">Maintenance:</span>
                        </div>
                        <div class="left-menu-block-item">
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                <div class="btn-group">
                                    <label class="btn btn-default">
                                        <input type="radio" name="rd-maintenance" value="on" autocomplete="off"> On
                                    </label>
                                </div>
                                <div class="btn-group">
                                    <label class="btn btn-default">
                                        <input type="radio" name="rd-maintenance" value="off" autocomplete="off"> Off
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>    
</ul>