<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

$template_data['title'] = 'JimDeno.com';
$template_data['meta']['description'] = 'Jim Deno\'s website that was created to express learnings in the field of web development, as well as express opinions about pretty much anything.';
$template_data['user'] = $user;
$template_data['body_id'] = 'home';
load_template('header', $template_data);
?>

<div id="main">
    <div id="content">
		<p> Test </p>
        <p> This page isn't pretty. This page isn't fancy. This page isn't eye-catching. This page works. </p>

        <p>
            As a web developer, I'm all about making things with sound code. Instead of worrying about fancy images,
            design, and animation, I worry about functionality. I'll be the first to admit that I have a lot to learn
            in the area of web development, and the purpose of the site is to explore that.
        </p>

        <p>
            I'll never be content knowing what I know. I'm a person that's constantly looking to challenge the brain.
            Web development is no exception. I could be the best programmer in the world (nowhere close), and that
            wouldn't be enough. I strive to learn as much as I can in the areas of <strong> design</strong>,
            <strong> development</strong>, and <strong> usability </strong>.
        </p>

        <p>
            Although there's nothing here yet, I'll be adding tutorials as I learn and develop new features -- so
            I urge you to check back soon.
        </p>

        <p class="note">
            As a side note - don't worry, this page won't always be so dreadfully boring. I'll be working on the design
            (and maybe even post some tutorials), as I develop the rest of the site.
        </p>
    </div>
</div>

<?php load_template('footer'); ?>
</body>
</html>