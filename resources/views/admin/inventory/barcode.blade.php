<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .modal-lg {
            width: 670px;
        }
    </style>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
</head>
<body>
    <div id="scanner-container" style="height:500px"></div>

    <script>
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanner-container"),
                constraints: {
                    width: 640,
                    height: 480,
                    facingMode: "environment"
                }
            },
            decoder: {
                readers: ["ean_reader", "upc_reader"]
            }
        }, function(err) {
            if (err) {
                console.error(err);
                return;
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        Quagga.onDetected(function(result) {
            console.log("Barcode detected and decoded : [" + result.codeResult.code + "]");
        });
    </script>
</body>
</html>    