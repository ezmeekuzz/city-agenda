
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_dark">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">Dashboard Panel</li>
                            <li class="<?php if($currentpage === 'dashboard') { echo 'active'; } ?>"><a href="/organizer/dashboard" aria-expanded="false"><i class="nav-icon ti ti-dashboard"></i><span class="nav-title">Dashboard</span></a> </li>
                            <li class="<?php if($currentpage === 'addevent') { echo 'active'; } ?>"><a href="/organizer/add-event" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Add Event</span></a> </li>
                            <li class="<?php if($currentpage === 'eventmasterlist') { echo 'active'; } ?>"><a href="/organizer/event-masterlist" aria-expanded="false"><i class="nav-icon ti ti-calendar"></i><span class="nav-title">Event Masterlist</span></a> </li>
                            <li class="<?php if($currentpage === 'ticketmasterlist') { echo 'active'; } ?>"><a href="/organizer/ticket-masterlist" aria-expanded="false"><i class="nav-icon ti ti-ticket"></i><span class="nav-title">Ticket Masterlist</span></a> </li>
                            <li class="<?php if($currentpage === 'mybookings') { echo 'active'; } ?>"><a href="/organizer/my-bookings" aria-expanded="false"><i class="nav-icon ti ti-archive"></i><span class="nav-title">My Bookings</span></a> </li>
                            <li class="<?php if($currentpage === 'mywishlist') { echo 'active'; } ?>"><a href="/organizer/my-wishlist" aria-expanded="false"><i class="nav-icon ti ti-heart"></i><span class="nav-title">My Wishlist</span></a> </li>
                            <li class="<?php if($currentpage === 'paymentmethod') { echo 'active'; } ?>"><a href="/organizer/payment-method" aria-expanded="false"><i class="nav-icon ti ti-money"></i><span class="nav-title">Payment Method</span></a> </li>
                            <li class="<?php if($currentpage === 'editaccount') { echo 'active'; } ?>"><a href="/organizer/edit-account/<?=session()->get('organizer_user_id');?>" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span class="nav-title">Edit Account</span></a> </li>
                            <li>
                                <a href="<?=base_url()?>organizer/logout" aria-expanded="false">
                                    <i class="nav-icon ti ti-power-off"></i>
                                    <span class="nav-title">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>