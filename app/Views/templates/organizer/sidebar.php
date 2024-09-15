
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_dark">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">Dashboard Panel</li>
                            <li class="<?php if($currentpage === 'dashboard') { echo 'active'; } ?>"><a href="/organizer/dashboard" aria-expanded="false"><i class="nav-icon ti ti-dashboard"></i><span class="nav-title">Dashboard</span></a> </li>
                            <li class="<?php if($currentpage === 'addevent' || $currentpage === 'eventmasterlist' || $currentpage === 'ticketmasterlist') { echo 'active'; } ?>">
                                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                    <i class="nav-icon fa fa-calendar"></i>
                                    <span class="nav-title">Event</span>
                                </a>
                                <ul aria-expanded="false" class="custom-style">
                                    <li class="<?php if($currentpage === 'addevent') { echo 'active'; } ?>"><a href='/organizer/add-event'>Add Event</a></li>
                                    <li class="<?php if($currentpage === 'eventmasterlist') { echo 'active'; } ?>"> <a href='/organizer/event-masterlist'>Event Masterlist</a></li>
                                    <li class="<?php if($currentpage === 'ticketmasterlist') { echo 'active'; } ?>"> <a href='/organizer/ticket-masterlist'>Ticket Masterlist</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($currentpage === 'mybookings') { echo 'active'; } ?>"><a href="/organizer/my-bookings" aria-expanded="false"><i class="nav-icon ti ti-archive"></i><span class="nav-title">My Bookings</span></a> </li>
                            <li class="<?php if($currentpage === 'mywishlist') { echo 'active'; } ?>"><a href="/organizer/my-wishlist" aria-expanded="false"><i class="nav-icon ti ti-heart"></i><span class="nav-title">My Wishlist</span></a> </li>
                            <li>
                                <a href="<?=base_url()?>organizer/logout" aria-expanded="false">
                                    <i class="nav-icon ti ti-power-off"></i>
                                    <span class="nav-title">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>