/* function setupCalendars() {
  Calendar.setup(
    {
      dateField: 'date_val',
      triggerElement: 'date'
    }
  )
}

window.onload = function() {
  var date_val = document.getElementById('date_val');
  
  var curr_date = getUrlVars()['d'];
  if(curr_date)
    date_val.value = curr_date;

  date_val.onchange = function() {
    location.assign('http://localhost' + location.pathname + '?d=' + date_val.value);
  }

  setupCalendars();
} */

function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
  });
  return vars;
}

function showFriend(id) {
  open('http://www.facebook.com/' + id, '', 'height=' + screen.height + ',width=' + screen.width);
}

// Setup the jQuery UI DatePicker calendar
$(function() {
  var date_val = $("#date-val");
  date_val.datepicker();
  date_val.datepicker("option", "showAnim", "");
  date_val.datepicker("option", "dateFormat", "dd/mm/yy");
  date_val.val("Choose a date");
});

window.onload = function() {
  var date_val = document.getElementById("date-val");
  
  date_val.onchange = function() {
    var urlDate = date_val.value;
    urlDate = urlDate.replace('/','');
    urlDate = urlDate.replace('/','');
    location.assign('https://itwwf.com' + location.pathname + '?d=' + urlDate);
  }
}

$(document).ready(function() {
  $("#refresh").click(function() {
    location.reload();
  });
});
