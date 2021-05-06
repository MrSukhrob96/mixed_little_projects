<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <title><?=$title?></title>
</head>
<style>*{font-family: serif; font-size: 14px;}.active {color: #fff;}</style>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <a href="http://192.168.10.96/check_terors/" class="navbar-brand"><img src="./public/img/logo.png" alt="" style="width: 2.5rem; height: 2.5rem"></a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" style="margin-left: 2rem;">
                <a class="nav-link active" href="http://192.168.10.96/check_terors/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link active" href="result" tabindex="-1" aria-disabled="true">Result</a>
            </li>
        </ul>
    </div>
</nav>

<?php print_r($content); ?>



<style>
.loader_content{
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    position: absolute;
    background-color: rgba(0, 0, 0, .7);
    z-index: 1;
    display: none;
    justify-content: center;
    align-items: center;
    transition: 1s linear;
}
.loader{
    margin: 0px auto;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 3px solid #000;
    border-top: 3px solid #fff;
    animation: load .25s infinite forwards ease-in-out;
    box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, .6);
}

@keyframes load {
    0%{
        transform: rotate(0deg);
    }
    100%{
        transform: rotate(360deg);
    }
}

</style>

<div class="loader_content">
    <div class="loader"></div>
</div>

<script>
window.addEventListener('load', function(e) {
    document.querySelector('.loader_content').style.display = 'flex';
});

setTimeout(()=>{
    document.querySelector('.loader_content').style.display = 'none';
}, 400);


</script>

</body>

</html>