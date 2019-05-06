<!-- Sidebar -->
        <div id="sidebar-wrapper" data-id="<?php echo $this->uri->segment('3') ?>">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="" target="_self">
                        Mini Car Inventory
                    </a>
                </li>
                <!-- <li>
                    <a class="<?php echo active_anchor('dashboard'); ?>" target="_self" href="">Dashboard</a>
                </li> -->
                <li>
                    <a class="<?php echo active_anchor('manufacturer'); ?>" href="manufacturer" target="_self">Add Manufacturer</a>
                </li>
                <li>
                    <a class="<?php echo active_anchor('model'); ?>" href="model" target="_self">Add Model</a>
                </li>
                <li>
                    <a class="<?php echo active_anchor('inventory'); ?>" href="inventory" target="_self">View Inventory</a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->