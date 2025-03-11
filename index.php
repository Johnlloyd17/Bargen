<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- JsBarcode library -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <title>Barcode Generator</title>
</head>

<body>
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <label>Barcode text</label>
                    <input type="text" class="form-control" id="input" placeholder="Enter the data">
                    <br>
                    <input type="button" class="btn btn-success" onclick="generateBarcode()" value="Generate">
                    <input type="button" class="btn btn-success" onclick="downloadBarcode()" value="Download">
                </div>
                <div class="col-lg-8" align="center">
                    <svg style="display:none" id="barcode"></svg>
                </div>
            </div>
        </div>
        <br>
        <script>
            function generateBarcode() {
                var input = document.getElementById("input").value;
                var barcode = document.getElementById("barcode");
                if (input == '') {
                    alert("<<!-- Provide  the data first --!>> ");
                    return false;
                } else {
                    JsBarcode(barcode, input);
                    barcode.style.display = "inline";

                }
            }

            function downloadBarcode(e) {
                const canvas = document.createElement("canvas");
                const svg = document.getElementById("barcode");
                const base64doc = btoa(unescape(encodeURIComponent(svg.outerHTML)));
                const w = parseInt(svg.getAttribute('width'));
                const h = parseInt(svg.getAttribute('height'));
                const img_to_download = document.createElement('img');
                img_to_download.src = 'data:image/svg+xml;base64,' + base64doc;
                console.log(w, h);
                img_to_download.onload = function() {
                    console.log('img loaded');
                    canvas.setAttribute('width', w);
                    canvas.setAttribute('height', h);
                    const context = canvas.getContext("2d");
                    //context.clearRect(0, 0, w, h);
                    context.drawImage(img_to_download, 0, 0, w, h);
                    const dataURL = canvas.toDataURL('image/png');
                    if (window.navigator.msSaveBlob) {
                        window.navigator.msSaveBlob(canvas.msToBlob(), "download.png");
                        e.preventDefault();
                    } else {
                        const a = document.createElement('a');
                        const my_evt = new MouseEvent('click');
                        a.download = 'download.png';
                        a.href = dataURL;
                        a.dispatchEvent(my_evt);
                    }
                    //canvas.parentNode.removeChild(canvas);
                }
            }
        </script>
</body>

</html>