function startRecognizer(){
    if ('webkitSpeechRecognition' in window) {
      var recognition = new webkitSpeechRecognition();
      recognition.lang = 'ru';

      recognition.onresult = function (event) {
        var result = event.results[event.resultIndex];
        var span_text = document.getElementById("text");
        span_text.innerHTML = "";
        span_text.innerHTML = result[0].transcript;
      };

      recognition.onend = function() {
        console.log('Распознавание завершилось.');
      };

      recognition.start();
    } else alert('webkitSpeechRecognition не поддерживается :(')
  }
 