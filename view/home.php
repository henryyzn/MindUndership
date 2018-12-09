<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#">
    <meta name="msapplication-navbutton-color" content="#">
    <meta name="apple-mobile-web-app-status-bar-style" content="#">
	<title>Mind Undership</title>
	<!--link rel="icon" type="image/png" href="assets/images/icons/favicon.png"/-->
	<link rel="stylesheet" href="assets/css/stylesheet.css">
    <link rel="stylesheet" href="assets/css/bases.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/keyframes.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <script src="assets/public/js/jquery-3.3.1.min.js"></script>
    <script src="assets/public/js/responsiveslides.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</head>
<body>
    <?php require_once("components/navbar.php")?>
    <header id="index-header-wrapper" class="m-t-70px m-auto">
        <section class="brd-30px">
            <h2 class="p-b-10px">O que é o Lorem Ipsum?</h2>
            <h3 class="p-b-20px">A passagem do Lorem Ipsum usada desde 1500</h3>
            <p class="p-b-20px">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão.</p>
            <div class="generic-button">
                <span>See More</span>
            </div>
        </section>
        <figure>
            <img src="assets/images/covers/cover.jpg" alt="">
        </figure>
    </header>
    <div class="main brd-30px">
        <div class="generic-grid">
            <?php
                for($i = 0; $i < 12; $i++){
            ?>
            <div class="index-card">
                <figure><img src="" alt=""></figure>
                <h2></h2>
                <h3></h3>
                <p></p>
                <span></span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>
