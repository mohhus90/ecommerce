
<?php
    function lang($phrase){
        static $lang = array(
            //nav-bar
            'home'          =>'Home',
            'Category'      =>'Category',
            'Edit Profile'  =>'Edit Profile',
            'Setting'       =>'Setting',
            'Logout'        =>'Logout',
            'Items'         =>'Items',
            'Members'       =>'Members',
            'Statistics'    =>'Statistics',
            'Logs'          =>'Logs',
            ''              =>'',

        );
        return $lang[$phrase];
    }
?>