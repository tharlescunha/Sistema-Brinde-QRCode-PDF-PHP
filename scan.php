<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Five Senses Scan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tela.css">
  </head>
  <body>
    <div id="interface" class="container-fluid">


      <div class="row">
        <div class="col-sm center">
          <p id="result"></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm center item">
          <span id="botao" onclick="botao()">
            <i class="material-icons iconbutton">camera_alt</i>
            Scan Now
          </span>
        </div>
      </div>
    </div>

    <script src="js/html5-qrcode.min.js" charset="utf-8"></script>
    <script type="text/javascript">


      function botao(){

        Html5Qrcode.getCameras().then(devices => {
          console.log(devices.length);
          if (devices && devices.length) {

            if(devices.length == 1){
              var cameraId = devices[0].id;
            }else{
              var cameraId = devices[1].id;
            }

            const html5QrCode = new Html5Qrcode(/* element id */ "reader", /* verbose= */ true);
            html5QrCode.start(
              cameraId,
              {
                fps: 10,
                qrbox: 300
              },
              qrCodeMessage => {
                location.replace(qrCodeMessage)
                html5QrCode.stop().then(ignore => {
                // QR Code scanning is stopped.
                }).catch(err => {
                // Stop failed, handle it.
                });
              },
              errorMessage => {
                // parse error, ignore it.
              })
            .catch(err => {
              // Start failed, handle it.
            });

          }
        }).catch(err => {
          // handle err
        });
      }


    </script>
  </body>
</html>
