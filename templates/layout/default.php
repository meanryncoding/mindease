<?php
//$cakeDescription = $system_name;
use Cake\Core\Configure;
use Cake\Routing\Router;

$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>

    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="title" content="<?= $this->fetch($meta_title) ?: $metaTitle ?>">
    <meta name="keyword" content="<?= $this->fetch($meta_keyword) ?: $metaKeywords ?>">
    <meta name="subject" content="<?= $this->fetch($meta_subject) ?: $metaSubject ?>">
    <meta name="copyright" content="<?= $this->fetch($meta_copyright) ?: $metaCopyright ?>">
    <meta name="description" content="<?= $this->fetch($meta_desc) ?: $metaDescription ?>">
    <!-- SEO Meta Tags -->
    <?php
    echo $this->Html->meta('title', $meta_title) . "\n";
    echo $this->Html->meta('keyword', $meta_keyword) . "\n";
    echo $this->Html->meta('subject', $meta_subject) . "\n";
    echo $this->Html->meta('copyright', $meta_copyright) . "\n";
    echo $this->Html->meta('description', $meta_desc) . "\n";
    ?>

    <!-- Subject and Copyright Meta Tags -->
    <meta name="subject" content="<?php echo $meta_subject; ?>">
    <meta name="copyright" content="<?php echo $meta_copyright; ?>">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:image" content="URL to your image">
    <meta property="og:url" content="https://<?php echo $domain_name; ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $meta_title; ?>">
    <meta name="twitter:description" content="<?php echo $meta_desc; ?>">
    <meta name="twitter:image" content="URL to your image">
    <meta name="twitter:site" content="@yourtwitterhandle">



    <title><?= $system_abbr ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monomaniac+One&family=Protest+Guerrilla&family=Roboto+Condensed&family=Roboto:wght@100;300;400;500&family=Victor+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
    //Meta info
    //echo $this->Html->meta('title', $meta_title, ['block' => true]);
    //echo $this->Html->meta('keyword', $meta_keyword, ['block' => true]);
    //echo $this->Html->meta('subject', $meta_subject, ['block' => true]);
    //echo $this->Html->meta('copyright', $meta_copyright, ['block' => true]);
    //echo $this->Html->meta('description', $meta_desc, ['block' => true]);
    //echo $this->Html->css('core');
    //echo $this->Html->css('theme-default');
    echo $this->Html->css('style');
    //Vendors
    //echo $this->Html->css('perfect-scrollbar.css');
    //Helpers
    echo $this->Html->script('color-modes.js');
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js');
    //Bottom JS
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']);
    //echo $this->Html->script('custom.js', ['block' => 'scriptBottom']);
    //echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>

<body>

    <?php if ($ribbon_status == true) : ?>
        <?php echo $this->element('ribbon'); ?>
    <?php endif; ?>

    <?php if ($notification_status == true) : ?>
        <?php echo $this->element('notification_bar'); ?>
    <?php endif; ?>

    <!-- Wrapper -->
    <div class="wrapper text-body-secondary">
        <!-- Sidebar -->
<?php if ($this->Identity->isLoggedIn()): ?>
    <?php echo $this->element('menu/sidebar'); ?>
<?php endif; ?>
        <!-- Page Content -->
        <div class="content-fluid">
            <!-- Navbar -->
            <?php echo $this->element('menu/topbar'); ?>
            <!-- OffCanvas -->
            <?php echo $this->element('offcanvas'); ?>
            <!-- Content -->
            <div class="content">

                <!-- Container -->
                <div class="container">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>


            <!-- Footer -->
           <footer class="pt-4 pb-3">
    <div class="text-center border-top pt-3">
        <p class="text-muted mb-0" style="font-size: 0.85rem;">
            © <?php echo date('Y'); ?> <?php echo $system_name; ?> — UiTM Student Mental Wellness Portal
        </p>
    </div>
</footer>
            <!-- / Footer -->
        </div>
    </div>



    <!-- / Layout wrapper -->
    <?= $this->fetch('scriptBottom') ?>

    <!-- jQuery CDN - Slim version (=without AJAX)
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> -->
    <!-- Bootstrap JS 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>