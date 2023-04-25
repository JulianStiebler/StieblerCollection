var commandList = ['about', 'useradd', 'sudo', 'help', 'key', 'clear'];
var about = 'about stiebler.tech'
var useradd = 'creates a new user. useradd [USERNAME][PASSWORD]. API-key will be generated.'
var sudo = 'logs into user. sudo [USERNAME][PASSWORD].'
var key = 'prints key if logged in.'
var help = 'list possible terminal commands.';
var clear = 'clear all text in the terminal.';


var user = 'guest@visitor:~$';
var commandHistory = [];
var commandIndex = -1;

function currentBrowser() {
  var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
  var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
  var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
  var is_safari = navigator.userAgent.indexOf("Safari") > -1;
  var is_edge = navigator.userAgent.indexOf("Edge") > -1;
  var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
  if (is_chrome && is_safari && is_edge) {
    is_chrome = false;
    is_safari = false;
  } else if ((is_chrome) && (is_safari)) {
    is_safari = false;
  } else if ((is_chrome) && (is_opera)) {
    is_chrome = false;
  }
  if (is_chrome) {
    return 'Chrome';
  } else if (is_explorer) {
    return 'Internet Explorer';
  } else if (is_firefox) {
    return 'Firefox';
  } else if (is_safari) {
    return 'Safari';
  } else if (is_edge) {
    return 'Edge';
  } else if (is_opera) {
    return 'Opera';
  } else {
    return 'Browser';
  }
}

$(document).ready(function () {
  $("#terminal").on('click', function () {
    $("#terminalInput").focus();
  });

  function sendCommand(input) {
    var command = input.split(' ')[0];
    var secondary = input.split(' ')[1];
    if ((commandList.indexOf(command) === -1 && command != "continue") && command) {
      replaceInput();
      $("#terminalOutput").append('Invalid command \"' + command + '"<br>type "help" for more options<br>');
      addInput();
    }
    if (input === 'ls -la' || input === 'ls -a' || input === 'ls -all' || input === 'ls -l') {
      printAllFiles();
      return;
    }
    switch (command) {
      case 'help':
        printList(commandList);
        break;

      case 'clear':
        clear();
        break;

      case 'about':
        about();
        break;

      case 'useradd':
        viernullvier();
        break;

      case 'sudo':
        viernullvier();
        break;

      case 'key':
        viernullvier();
        break;
    }

  }

  function about(){
    replaceInput();
        $("#terminalOutput").append("## Julian Stiebler<br>" +
                                    '## Musterland<br>' +
                                    '## 12345 Musterstadt<br>' +
                                    '## 12 Musterstraße<br>' + 
                                    '## Your browser: ' + currentBrowser() + '<br>');
    addInput();
  }

  function viernullvier(){
    replaceInput();
        $("#terminalOutput").append("## not avaiable yet.<br>");
    addInput();
  }

  function useradd(){

  }

  function sudo(){

  }

  function key(){

  }

  function clear() {
    replaceInput();
    $("#terminalOutput").empty();
    addInput();
  }

  function printFile(file) {
    if (this[file]) {
      replaceInput();
      $("#terminalOutput").append(this[file] + '<br>');
      addInput();
    } else {
      replaceInput();
      $("#terminalOutput").append('"' + file + '"' + ' is an invalid file name.  Try typing "ls".<br>');
      addInput();
    }
  }

  function printList(list) {
    replaceInput();
    list.forEach(function (result) {
      $("#terminalOutput").append(result + '<br>');
    });
    addInput();
  }

  function printAllFiles() {
    replaceInput();
    allFiles.forEach(function (file) {
      $("#terminalOutput").append(file + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
    });
    $("#terminalOutput").append('<br>');
    addInput();
  }

  function replaceInput() {
    var value = $("#terminalInput").val();
    $("#terminalInput").remove();
    $("#terminalOutput").append(value + '<br>');
  }

  function addInput() {
    $("#terminalOutput").append(user + ' <input id="terminalInput" spellcheck="false"></input>');

    setTimeout(function () {
      $("#terminalInput").focus();
    }, 10);


    $("#terminalInput").keydown(function (e) {
      var command = $("#terminalInput").val();
      if (e.keyCode == 13) {
        sendCommand(command);
        commandHistory.unshift(command);
        commandIndex = -1;
      } else if (e.keyCode == 9) {
        e.preventDefault();
        autoCompleteInput(command);
      } else if (e.keyCode == 38 && commandIndex != commandHistory.length - 1) {
        e.preventDefault();
        commandIndex++;
        $("#terminalInput").val(commandHistory[commandIndex]);
      } else if (e.keyCode == 40 && commandIndex > -1) {
        e.preventDefault();
        $("#terminalInput").val(commandHistory[commandIndex]);
        commandIndex--;
      } else if (e.keyCode == 67 && e.ctrlKey) {
        $("#terminalInput").val(command + '^C');
        replaceInput();
        addInput();
      }
    });
  }

  function autoCompleteInput(command) {
    var command = $("#terminalInput").val();
    var input = $("#terminalInput").val().split(' ');
    var validList = [];
    var fileList = input[0] === 'man' ? commandList : allFiles;

    if (input.length === 2 && input[1] != "") {
      fileList.forEach(function (file) {
        if (file.substring(0, input[1].length) === input[1]) {
          validList.push(file);
        }
      });
      if (validList.length > 1) {
        replaceInput();
        validList.forEach(function (option) {
          $('#terminalOutput').append(option + '   ');
        });
        $('#terminalOutput').append('<br>');
        addInput();
        $("#terminalInput").val(command);
      } else if (validList.length === 1) {
        $("#terminalInput").val(
          command +
          validList[0].substring(input[1].length, validList[0].length));
      }
    } else if (command.length) {
      commandList.forEach(function (option) {
        if (option.substring(0, input[0].length) === input[0]) {
          validList.push(option);
        }
      });
      if (validList.length > 1) {
        replaceInput();
        validList.forEach(function (option) {
          $('#terminalOutput').append(option + '   ');
        });
        $('#terminalOutput').append('<br>');
        addInput();
        $("#terminalInput").val(command);
      } else if (validList.length === 1) {
        $("#terminalInput").val(
          command +
          validList[0].substring(input[0].length, validList[0].length));
      }
    }
  }

  addInput();
});

dragElement(document.getElementById("terminal"));

    function dragElement(elmnt) {
      var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
      if (document.getElementById(elmnt.id + "fileBar")) {
        /* if present, the header is where you move the DIV from:*/
        document.getElementById(elmnt.id + "fileBar").onmousedown = dragMouseDown;
      } else {
        /* otherwise, move the DIV from anywhere inside the DIV:*/
        elmnt.onmousedown = dragMouseDown;
      }

      function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
      }

      function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
      }

      function closeDragElement() {
        /* stop moving when mouse button is released:*/
        document.onmouseup = null;
        document.onmousemove = null;
      }
    }