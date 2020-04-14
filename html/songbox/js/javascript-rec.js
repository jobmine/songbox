let playButton;

var recorder, gumStream;
var chunks=[];
var recordButton = document.getElementById("recordButton");
var InsertSongHere = document.getElementById("insertHere");
recordButton.addEventListener("click", toggleRecording);

function toggleRecording() {
    if (recorder && recorder.state == "recording") {
        recorder.stop(chunks);
        gumStream.getAudioTracks()[0].stop();

    } else {
        navigator.mediaDevices.getUserMedia({
            audio: true
        }).then(function(stream) {
            gumStream = stream;
            recorder = new MediaRecorder(stream);
            recorder.ondataavailable = function(e) {
                chunks.push(e.data);   //note: blob was const; remove let above//
                console.log("chunks gathered");
                const blob = new Blob(chunks, {type:'audio/webm', bitsPerSecond:128000});

                const url = URL.createObjectURL(blob);
                console.log(url);
                ////////formData was here initially///
                console.log(blob.type);
                var link = document.createElement('a');

                //link the a element to the blob
                link.href = url;

                //get current date and time
                var date = new Date();
                // format & pad time
                var hours = date.getHours();
                var minutes = date.getMinutes();
                if (hours<10) hours = "0" + hours;
                if (minutes<10) minutes = "0" + minutes;

                var clipTime = ""+ hours + ":" + minutes;
                var clipDate = date.toISOString().slice(0,10); //put date in a variable for later use
                //////////////////////////
                
                link.download = clipTime+"    //    "+clipDate;
                link.innerHTML = link.download;

                ////////// create audio player element /////
                var preview = document.createElement('audio');
                var div = document.createElement('div');
                preview.controls = true;
                preview.src = url;
                console.log(preview.duration); // get the length of recording.

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
                var getURL = (window.location.search.split('toEdit=')[1]||'').split('&')[0];
                //////check if jQuery is loaded and send audio blob from above to server via AJAX
                    //$(document).ready(function(blob, clipDate, url) {
                    //console.log("jQuery loaded");
                    //////// blob put into FormData var ////
                    var clipData =""
                    clipData = new FormData(); /// create new FormData to put blob into
                    clipData.append('file', blob); /// put blob into FormData var.
                    clipData.append('clipTime', clipTime);
                    clipData.append('clipDate', clipDate);
                    clipData.append('songID', getURL);
                    /////////////////////////////////////
                    for(var pair of clipData.entries()) {
                       console.log(pair[0]+ ', '+ pair[1]);
                    }

                    var xhr=new XMLHttpRequest(clipData);
                    xhr.onload=function(e) {
                      if(this.readyState === 4) {
                          console.log("Server returned: ",e.target.responseText);
                      }
                    };
                    xhr.open("POST","clipSave",true);
                    xhr.send(clipData);
                    // add server-generated name
                    //that includes clip id
                    //var filename = <?php echo $filename;?>;

                    ////start AJAX///
                    // $.ajax({
                    //     type: 'PUT',
                    //     url: '/clipSave',
                    //     data: blob,
                    //     //cache: false,
                    //     processData: false,
                    //     contentType: false,
                    //     success: function(data) {
                    //       alert("AJAX POST success!");
                    //       console.log(data);
                    //     },
                    //     error: function() {
                    //       alert("AJAX error!");
                    //     }
                    // });
                    //////end AJAX ///
                  //});
            };
            recorder.start();
        });
    }
}



//////////////////////////////////

///playButton = document.getElementById("playButton");

//playButton.addEventListener("click", playAudio);
//var audioPlayer = document.getElementById('player');
