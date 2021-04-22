 var qrcode = new QRCode(document.getElementById("qrcode"), {
      width : 200,
      height : 200,
      useSVG: true
  });

function makeCode () {            
      var elText = document.getElementById("text_qr");

      if (!elText.value) {
          return;
      }
      qrcode.makeCode(elText.value);
  }


  $("#text_qr").
      on("blur", function () {
          makeCode();
      }).
      on("keydown", function (e) {
          if (e.keyCode == 13) {
              makeCode();
          }
      });