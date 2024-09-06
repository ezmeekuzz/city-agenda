
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_dark">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">Dashboard Panel</li>
                            <li class="<?php if($currentpage === 'dashboard') { echo 'active'; } ?>"><a href="/admin/dashboard" aria-expanded="false"><i class="nav-icon ti ti-dashboard"></i><span class="nav-title">Dashboard</span></a> </li>
                            <li class="<?php if($currentpage === 'adduser' || $currentpage === 'usermasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-users"></i>
                                    <span class="nav-title">Users</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'adduser') { echo 'active'; } ?>"><a href='/admin/add-user'>Add User</a></li>
                                    <li class="<?php if($currentpage === 'usermasterlist') { echo 'active'; } ?>"> <a href='/admin/user-masterlist'>User Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'addstate' || $currentpage === 'statemasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-map-o"></i>
                                    <span class="nav-title">States</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'addstate') { echo 'active'; } ?>"><a href='/admin/add-state'>Add State</a></li>
                                    <li class="<?php if($currentpage === 'statemasterlist') { echo 'active'; } ?>"> <a href='/admin/state-masterlist'>State Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'addcity' || $currentpage === 'citymasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-map-o"></i>
                                    <span class="nav-title">Cities</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'addcity') { echo 'active'; } ?>"><a href='/admin/add-city'>Add City</a></li>
                                    <li class="<?php if($currentpage === 'citymasterlist') { echo 'active'; } ?>"> <a href='/admin/city-masterlist'>City Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'addcategory' || $currentpage === 'categorymasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-list"></i>
                                    <span class="nav-title">Category</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'addcategory') { echo 'active'; } ?>"><a href='/admin/add-category'>Add Category</a></li>
                                    <li class="<?php if($currentpage === 'categorymasterlist') { echo 'active'; } ?>"> <a href='/admin/category-masterlist'>Category Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'addblog' || $currentpage === 'blogmasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-thumb-tack"></i>
                                    <span class="nav-title">Blog</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'addblog') { echo 'active'; } ?>"><a href='/admin/add-blog'>Add Blog</a></li>
                                    <li class="<?php if($currentpage === 'blogmasterlist') { echo 'active'; } ?>"> <a href='/admin/blog-masterlist'>Blog Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'addevent' || $currentpage === 'eventmasterlist' || $currentpage === 'ticketmasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-calendar"></i>
                                    <span class="nav-title">Event</span>
                                </a>
                                <ul aria-expanded="false">
                                    <li class="<?php if($currentpage === 'addevent') { echo 'active'; } ?>"><a href='/admin/add-event'>Add Event</a></li>
                                    <li class="<?php if($currentpage === 'eventmasterlist') { echo 'active'; } ?>"> <a href='/admin/event-masterlist'>Event Masterlist</a></li>
                                    <li class="<?php if($currentpage === 'ticketmasterlist') { echo 'active'; } ?>"> <a href='/admin/ticket-masterlist'>Ticket Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'messages') { echo 'active'; } ?>"><a href="/admin/messages"><i class="nav-icon ti ti-envelope"></i><span class="nav-title">Messages</span></a> </li>
                            <li class="<?php if($currentpage === 'subscribers') { echo 'active'; } ?>"><a href="/admin/subscribers"><i class="nav-icon ti ti-user"></i><span class="nav-title">Subscribers</span></a> </li>
                            <li>
                                <a href="<?=base_url()?>admin/logout" aria-expanded="false">
                                    <i class="nav-icon ti ti-power-off"></i>
                                    <span class="nav-title">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>