<!DOCTYPE html>
<html lang="en">
<head>
    <title>Link2Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Generate QR codes from links or texts to scan on a mobile device">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<h1>Link to Mobile</h1>
<label>
    Recovery data (Optional)
</label>
<div class="links">[ <a href="/">High</a> | <a href="/?q=Q">Normal</a> | <a href="/?q=M">Medium</a> | <a href="/?q=L">Low</a> ]</div>
<label for="link">
    Link
</label>
<input type="text" value="" id="link" placeholder="https://www.link2mobile.com">
<label for="qrcode">
    Scan barcode with your phone
</label>
<div id="qrcode"></div>
<script src="libs/merge.js"></script><?php
$correctLevel = $_REQUEST['q'] ?? 'H';
$correctLevels = [
    'H',
    'Q',
    'M',
    'L'
];
if (!in_array($correctLevel, $correctLevels)) {
    $correctLevel = 'H';
}
?>
<script>
    var screenWide = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (screenWide > 512) {
        screenWide = 512;
    } else if (screenWide <= 480) {
        screenWide = 300;
    }
    var qrcode = new QRCode("qrcode", {
        text: "https://www.link2mobile.com",
        width: screenWide,
        height: screenWide,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.<?=$correctLevel?>
    });
    $(document).ready(function () {
        $('#qrcode img').attr('alt', "Scan me to visit https://www.link2mobile.com");
    });
    $('#link').on('keydown, keyup', function (e) {
        if (e.ctrlKey || e.metaKey) {
            setTimeout(function () {
                qrcode.clear();
                qrcode.makeCode($(this).val());
                $('#qrcode img').attr('alt', "Scan me to visit " + $('#link').val());
            }, 50);
        } else {
            qrcode.clear();
            qrcode.makeCode($(this).val());
            $('#qrcode img').attr('alt', "Scan me to visit " + $('#link').val());
        }
    });
</script>
<style>
    body {
        font-family: Helvetica, Verdana, Arial, serif;
    }

    #link, #qrcode, footer, h1, label, div.links {
        display: block;
        text-align: center;
        width: 512px;
        margin: auto;
        padding: 10px
    }

    label {
        text-align: left;
        font-weight: 700
    }

    #link {
        border-radius: 4px;
        border: 2px solid rgba(0, 0, 0, .4);
        font-size: 14px;
        line-height: 18px;
        height: 20px;
        text-align: left
    }

    #qrcode {
        margin-top: 10px;
        border-radius: 4px;
        border: 2px solid rgba(0, 0, 0, .2)
    }

    footer {
        margin-top: 20px;
        font-size: 12px
    }

    a {
        color: #000;
        text-decoration: none;
    }

    #qrcode img {
        margin: auto;
    }

    @media (min-width: 320px) and (max-width: 480px) {
        #link, #qrcode, footer, h1, label, div.links {
            width: 300px;
        }

        #qrcode {
            border: 0;
            margin: auto;
        }
    }
</style>
<footer>
    Nothing is saved on the server, no tracking cookies etc, no background mining<br>
    &copy; <a href="https://www.ekonomiapi.se">EkonomiAPI</a> <?= date('Y') ?>
    <br><br>
</footer>
</body>
</html>