<!DOCTYPE html>
<head>
    <title> <?=$title?> </title>
    <?php
    if (isset($meta)) {
        foreach ($meta as $name => $content) {
            echo '<meta name="' . $name . '" content="' . $content . '" />';
        }
    }
    ?>

    <link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />

    <!--[if !IE 7]>
        <style type="text/css">
            #wrap { display:table; height:100%; }
        </style>
    <![endif]-->
    <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body<?=isset($body_id) ? ' id="' . $body_id . '"' : '';?>>
	<noscript>
		<div>Please enable Javascript for this site to function properly.</div>
	</noscript>
    <div id="container">
        <div id="header-container">
            <header>
                <h1><a href="/">JimDeno.com</a></h1>
            </header>
        </div>

        <div id="navigation-bar-container">
            <div id="navigation-bar">
                <ul>
                    <li id="home-link"><a href="/index.php">home</a></li>
                    <li id="blog-link"><a href="/blog.php">blog</a></li>
                    <li id="portfolio-link"><a href="#">portfolio</a></li>
                    <li id="contact-link"><a href="/contact.php">contact</a></li>
                    <?php if ($user->loggedIn) {
                        if ($user->role == 'Administrator') {
                            echo '<li id="admin-link"><a href="/admin/">admin</a></li>';
                        }
                        echo '<li id="logout-link"><a href="/admin/logout.php">logout</a></li>';
                    } ?>
                </ul>
            </div>
        </div>