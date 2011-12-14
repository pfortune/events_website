<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php echo $template['title']; ?> - Culture Crawl Ireland</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/global.css?v=2">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css?v=2">
        <script src="<?php echo base_url(); ?>js/libs/modernizr-1.6.min.js"></script>
        
        <?php echo $template['metadata']; ?>


    </head>
    <body>

        <div id="container">
            <header>
                <h1>Culture Crawl Ireland</h1>
                <img src="<?php echo base_url(); ?>images/header.jpg">
                <nav>
                    <ul id="minitabs">
                        <li class="active"><?php echo anchor('', 'Home'); ?></li>
                        <li><?php echo anchor('events', 'Events') ?></li>
                        <li><?php echo anchor('contact', 'Contact') ?></li>
                        <li><?php echo anchor('about', 'About') ?></li>
                    </ul>
                </nav>
            </header>

            <?php echo $template['body']; ?>

            <div class="push"></div>
        </div>

        <footer>
            <nav>
                <ul>
                    <li><a href="http://www.tanks.ie/">Oil Tanks</a></li>
                    <li><a href="http://www.tanks.ie/cPath/1/water-storage-tanks.html">Water Tank</a></li>
                    <li><a href="http://www.tanks.ie/cPath/1/water-storage-tanks.html">Water Tanks</a></li>
                </ul>
            </nav>
        </footer>



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>

        <!--[if lt IE 7 ]>
          <script src="js/libs/dd_belatedpng.js"></script>
          <script> DD_belatedPNG.fix('img, .png_bg'); </script>
	  <![endif]-->
          
      <script>
       var _gaq = [['_setAccount', 'UA-21666192-1'], ['_trackPageview']];
       (function(d, t) {
        var g = d.createElement(t),
            s = d.getElementsByTagName(t)[0];
        g.async = true;
        g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s);
       })(document, 'script');
      </script>
      
        <script type="text/javascript">
        var clicky = { log: function(){ return; }, goal: function(){ return; }};
        var clicky_site_id = 66390704;
        (function() {
          var s = document.createElement('script');
          s.type = 'text/javascript';
          s.async = true;
          s.src = ( document.location.protocol == 'https:' ? 'https://static.getclicky.com/js' : 'http://static.getclicky.com/js' );
          ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
        })();
        </script>

    </body>
</html>