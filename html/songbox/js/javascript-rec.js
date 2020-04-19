let playButton;
let i=1;
let clipID;

var recorder, gumStream;
var chunks=[];
var recordButton = document.getElementById("recordButton");
var insertSongHere = document.getElementById("insertHere");
recordButton.addEventListener("click", toggleRecording);
recordButton.addEventListener("click", preventDefault);


function preventDefault (event) {
  event.preventDefault();
}

function toggleRecording() {
    if (recorder && recorder.state == "recording") {
        recorder.stop(chunks);
        gumStream.getAudioTracks()[0].stop();

        recordButton.classList.remove("lightcolor");
    } else {
        navigator.mediaDevices.getUserMedia({
            audio: true
        }).then(function(stream) {
            recordButton.classList.add("lightcolor");
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
                //var preview = document.createElement('audio');
                var div = document.createElement('div'); //create div
                //preview.controls = false;
                //preview.src = url;  //set source of audio element to recorded blob
                //console.log(preview.duration); // get the length of recording.

                //somewhat rough way to get the song ID from the URL.
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

                                  // POST data
                                  var xhr=new XMLHttpRequest(clipData);
                                  xhr.onload=function(e) {
                                    if(this.readyState === 4) {
                                        console.log("Server returned: ",e.target.responseText);
                                    }
                                  };
                                  xhr.open("POST","clipSave",false);
                                  xhr.send(clipData);

                                  // GET data - id etc
                                  var xhr=new XMLHttpRequest();
                                  xhr.onload=function(e) {
                                    if(this.readyState === 4) {
                                        console.log("XMLHttp GET request successful");
                                        console.log("Server returned: ",e.target.responseText);
                                        clipID = e.target.responseText;
                                    }
                                  };
                                  xhr.open("GET","clipLoad",false);
                                  xhr.send();

                                  console.log('value of clipID '+clipID);
                                  ////start AJAX/// for some reason XMLHttpRequest worked smoother
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


                                i++; //makeshift clip counter
                                div.setAttribute("id", "divwrapper"+clipID); //set container div ID
                                //preview.setAttribute("id", "audio"+clipID); //set ID of audioplayer
                                insertSongHere.appendChild(div);  //attach below Record button
                                //div.appendChild(preview);  //attach below Record button

                //// add HTML of audio clip. Not preferred method, but 14 diff divs within song card require it
                document.getElementById('divwrapper'+clipID).innerHTML =
                  "<div id='insertHere' class='col-xl-12 col-md-12 mb-4'>"+
                   "<div class='card border-left-primary shadow h-100'>"+
                      "<div class='card-body' id='card-body"+clipID+"'>"+

                        "<div id='audiodiv"+clipID+"'>"+
                          "<audio id='audio"+clipID+"'>"+
                            "<source src='"+url+"' type='audio/webm' controls='controls'>"+
                            "</source>"+
                            "Your browser does not support HTML5 video."+
                          "</audio>"+
                        "</div>"+

                         "<div class='row no-gutters align-items-center'>"+
                            "<div class='col mr-2'>"+
                               "<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>  " + clipTime + " | " + clipDate +      //insert cliptime&clipdate
                                 "<form class='sameline' id='deleteClipForm' name='deleteClipForm' method='GET' action='/simpleformReq/deleteClip/"+clipID+"'> "+  //insert clip id at the end here
                                    "<input type='hidden' name='songID' value='"+getURL+"'>"+
                                    "<button class='transparent pr-3' id='deleteClipButton' name='deleteClip' type='submit'> "+
                                    "<i class='fas fa-trash text-gray-400'></i> "+
                                    "</button>"+
                                 "</form>"+
                               "</div>"+
                               "<div class='row no-gutters align-items-center'>"+
                                  "<div class='col-auto'>"+
                                     "<div class='h5 mb-0 mr-3 font-weight-bold text-gray-800'>Clip " + i + "</div>"+ //insert clip count id
                                  "</div>"+
                                  "<div class='col'>"+
                                     "<div id='progress"+clipID+"' class='progress progress-sm mr-2'>"+
                                        "<div id='progress-bar"+clipID+"' class='progress-bar bg-primary' role='progressbar' style='width: 0%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'></div>"+
                                     "</div>"+
                                  "</div>"+
                               "</div>"+
                            "</div>"+
                            "<div class='col-auto mt-4 ml-2'>"+
                               "<a class='btn-circle playclip' href='javascript:;' onclick=\"document.getElementById('audio"+clipID+"').play()\"><i class='fas fa-play-circle fa-2x'></i></a>"+ //insert clip id here
                               "<a class='btn-circle playclip' href='javascript:;' onclick=\"document.getElementById('audio"+clipID+"').pause()\"><i class='fas fa-pause-circle fa-2x'></i></a>"+ //insert clip id here
                            "</div>"+
                         "</div>"+
                      "</div>"+
                   "</div>"+
                "</div>";
              ///// END of HTML audio clip addition

              sliders();

              // function updateProgress() {
              //    var progressBar = document.getElementById("progress-bar");
              //    var value = 0;
              //    if (player.currentTime > 0) {
              //       value = Math.floor((100 / video.duration) * video.currentTime);
              //    }
              //    progressBar.style.width = value + "%";
              // }


                // 2nd method for creating clip wrapper - create & append elements
                // Too many nested div-s in original template for this to work cleanly. //

                // var playBtn = document.createElement('i');
                // var tinyDivSongRow = document.createElement('div'); // div for songrow
                // var smallerCardDiv = document.createElement('div');
                //
                // playBtn.setAttribute("class", "fas fa-play-circle fa-2x text-primary");
                // playBtn.setAttribute("id", "playButton");
                //
                // smallerCardDiv.setAttribute("class", "card-body");
                // smallerCardDiv.appendChild(link);
                // smallerCardDiv.appendChild(preview);
                // smallerCardDiv.appendChild(playBtn);
                //
                // div.appendChild(smallerCardDiv);
                // div.setAttribute("class", "card border-left-primary shadow h-100 ");
                //

                //place request here if required

            };
            recorder.start();
        });
    }
}


// var thisID=0;
//
//         thisID = parseInt(here.replace(/[^0-9\.]/g, ''), 10);
//
//
// console.log('thisID'+clipID);
/////////////////////////slider audio
function sliders(){
var player = document.getElementById('audio'+clipID);
console.log('audio'+clipID);
console.log(player);

/// slider for audio       ////////////////// code from Adobe Devnet - https://www.adobe.com/devnet/archive/html5/articles/html5-multimedia-pt3.html#articlecontentAdobe_numberedheader_2 // WORKING WITH HTML5 MULTIMEDIA COMPONENTS – PART 3: CUSTOM CONTROLS
player.addEventListener('timeupdate', function() {
   var progressBar = document.getElementById("progress-bar"+clipID);
   var value = 0;
   if (player.currentTime > 0) {
      value = Math.floor((100 / player.duration) * player.currentTime);
   }
   progressBar.style.width = value + "%";
 });
}



// ///////////// Play/pause recordings
//
// var clipPlayer = document.getElementById("background_music");
// var mPlayAction = document.getElementById("playbutton");
//
// var isPlaying = false;
//
// function playAudio() {
//     clipPlayer.play();
//     isPlaying = true;
//     mPlayAction.src = "https://findicons.com/files/icons/1676/primo/128/button_blue_pause.png";
// }
//
// function pauseAudio() {
//     clipPlayer.pause();
//     isPlaying = false;
//     mPlayAction.src = "https://findicons.com/files/icons/1676/primo/128/button_blue_play.png";
// }
// function HandleAudio(){
//   if(isPlaying == true){
//     //Playing already Pause it
//     pauseAudio();
//   }else{
//     //Play the music
//     playAudio();
//   }
// }
