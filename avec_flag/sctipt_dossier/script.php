<?php
   
    function        read_link($link)
    {
        $regex = '#href="(.*?)"#i';
        $page = '';
        $resource = curl_init();
        curl_setopt( $resource, CURLOPT_URL, $link );
        curl_setopt( $resource, CURLOPT_RETURNTRANSFER, true );
        $page = curl_exec( $resource );

        // if (stripos($link, "readme") != NULL)
            // if (preg_match("#[0-9]#i", $page))
            // if (preg_match("*\d*", $page))
                echo $page."\n";

        $links = array();
        preg_match_all("$regex", $page, $links);
        if (!empty ($links))
        {
            foreach ($links[1] as $link_sup)
            {
                if ($link_sup != "../")
                    read_link($link.$link_sup);
            }
        }
        curl_close( $resource ); 
    }

    $link_start = "http://192.168.202.128/.hidden/";
    read_link($link_start);
?>