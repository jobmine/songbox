let playButton;
let blob;

var recorder, gumStream;
var chunks=[];
var recordButton = document.getElementById("recordButton");
var InsertSongHere = document.getElementById("insertHere");
recordButton.addEventListener("click", toggleRecording);

function toggleRecording() {
    if (recorder && recorder.state == "recording") {
        recorder.stop();
        gumStream.getAudioTracks()[0].stop();
    } else {
        navigator.mediaDevices.getUserMedia({
            audio: true
        }).then(function(stream) {
            gumStream = stream;
            recorder = new MediaRecorder(stream);
            recorder.ondataavailable = function(e) {
                var url = URL.createObjectURL(e.data);
                chunks.push(e.data);   //note: blob was const; remove let above//
                blob = new Blob(chunks, { type:'audio/webm', bitsPerSecond:128000});
    	          console.log(Blob.type);
               var link = document.createElement('a');

             	//link the a element to the blob
             	link.href = url;
             	link.download = new Date();
             	link.innerHTML = link.download;
                var preview = document.createElement('audio');
                var div = document.createElement('div');
                preview.controls = true;
                preview.src = url;

                //creating a bunch of nested div-s. Gave up on following the Bootstrap template halfway through..//
                  preview.setAttribute("id", "player"); //set ID of audioplayer
                var playBtn = document.createElement('i');
                var tinyDivSongRow = document.createElement('div'); // div for songrow
                var smallerCardDiv = document.createElement('div');

                playBtn.setAttribute("class", "fas fa-play-circle fa-2x text-primary");
                playBtn.setAttribute("id", "playButton");

                smallerCardDiv.setAttribute("class", "card-body");
              	smallerCardDiv.appendChild(link);
                smallerCardDiv.appendChild(preview);
                smallerCardDiv.appendChild(playBtn);
                //smallerCardDiv.appendChild(tinyDivSongRow); //temporary solution, this is supposed to be a whole row

                div.appendChild(smallerCardDiv);
                div.setAttribute("class", "card border-left-primary shadow h-100 ");
              	InsertSongHere.appendChild(div);

                //////check if jQuery is loaded and send audio blob from above to server via AJAX
                  $(document).ready(function(blob) {
                    console.log("jQuery loaded");

                    ////start AJAX///
                      $.ajax({
                        type: "POST",
                        data: {"audio":blob},
                        url: "{{ @BASE }}/clipSave",

                        success: function (textStatus, status) {
                            console.log(textStatus);
                            console.log(status);
                        },
                        error: function(xhr, textStatus, error) {
                            console.log(xhr.responseText);
                            console.log(xhr.statusText);
                            console.log(textStatus);
                            console.log(error);
                        }
                      });
                    //////end AJAX ///

                  });

            };
            recorder.start();
        });
    }
}



//////////////////////////////////

///playButton = document.getElementById("playButton");

//playButton.addEventListener("click", playAudio);
//var audioPlayer = document.getElementById('player');
