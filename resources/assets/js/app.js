// Genral constants
// These are populated by firebase
var FIRST_SHOW_DATE;
var SHOW_START_HOUR;
var SHOW_END_HOUR;

// Some variables
var countdownInterval;
var inShowSeason = false;

// Import some non-module scripts
require('script-loader!./countdown.min.js');
require('script-loader!./ie10-viewport-bug-workaround.js');

// jQuery and Bootstrap
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

// Firebase
var firebaseConfig = require('./firebase-config');
var firebase = require('firebase/app');
//require('firebase/auth');
require('firebase/database');
firebase.initializeApp(firebaseConfig);
var database = firebase.database();

$(document).ready(function() {

    $('a[href="#"]').on('click', function(e) {
      e.preventDefault();
    });

    $('.now-playing a').popover({
      'placement': 'bottom',
      'animation': true,
      'container': '#infobar',
      'html': true,
      'template': getPopoverWithCustomClass('now-playing-popover')
    });

    database.ref('showData').on('value', function(snapshot) {
        var data = snapshot.val();
        var song = data.nowPlaying;

        SHOW_START_HOUR = data.showStartHour;
        SHOW_END_HOUR = data.showEndHour;
        FIRST_SHOW_DATE = Date.parse(data.firstShowDate);
        LAST_SHOW_DATE = Date.parse(data.lastShowDate);

        var now = new Date();

        // determine if we are in season
        if(now >= FIRST_SHOW_DATE && now <= LAST_SHOW_DATE)
          inShowSeason = true;
        else
          inShowSeason = false;

        if(song)
            updateNowPlaying(song);
        else
            setupCountdownDisplay(now);

    });

    $('#contact').submit(function(e) {
        e.preventDefault();
        var data = {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            message: $('textarea[name=msg]').val(),
            timestamp: firebase.database.ServerValue.TIMESTAMP
        };

        $('#contact button').prop('disabled',true);
        var submission = database.ref('contact').push(data, function(err) {
            $('#contact button').prop('disabled',false);
            if(err) {
                alert("There was a problem with your submission, try again.");
                return;
            }
            $('#contact')[0].reset();
            setTimeout(function(){
                alert('Thanks, we have received your message!');
            },300);
        });

    });

});

function showStartingNow() {
  stopCountdown();
  $('.countdown').show(250);
  $('.countdown .time').text('Starting Now!');
}

function hasShowStarted() {
  if(!inShowSeason) 
    return false;
  var curHour = new Date().getHours();
  return (curHour >= SHOW_START_HOUR && curHour < SHOW_END_HOUR);
}

function setupCountdownDisplay(now) {
  $('.now-playing').hide();
  // if show season has began
  if(inShowSeason) {
    $('.countdown .word').text('Next');
    // If we're in the hour of the show start
    // the show is starting, don't show countdown
    if(hasShowStarted()) {
      showStartingNow();
      return;
    }
    // Once show has ended, start countdown to 6pm the next day
    // countdown.js will automatically adjust for when a day goes to
    // the next month (i.e. October 32 => November 1)
    else if(now.getHours() > SHOW_START_HOUR || now.getHours() > SHOW_END_HOUR) {
      var day = now.getDate()+1;
    }
    // countdown to 6pm today
    else {
      var day = now.getDate();
    }
    var date = new Date(now.getFullYear(), now.getMonth(), day, SHOW_START_HOUR, 0, 0, 0);
  }
  // else, count down to the first show
  else {
    $('.countdown .word').text('First');
    var date = FIRST_SHOW_DATE;
  }
  createCountdown(date);
  $('.countdown').show(250);
}

function createCountdown(date) {
  stopCountdown();
  countdownInterval = countdown(
    date,
    function(ts) {

      if(hasShowStarted()) {
        showStartingNow();
        stopCountdown();
        return;
      }

      var weeks = ts.weeks ? ts.weeks + 'w' : '';
      var days = ts.days? ts.days + 'd' : '';
      var hours = ts.hours ? ts.hours + 'h' : '';
      var minutes = ts.minutes ? ts.minutes + 'm' 
      : (ts.hours != 0 ? '0m' : '');
      var seconds = ts.seconds ? ts.seconds + 's' : '0s';
      var text = [weeks, days, hours, minutes, seconds];
      text = text.join(' ');
      $('.countdown .time').html(text).attr('title',ts.toString());
    },
    countdown.WEEKS|countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS
    );
}

function stopCountdown() {
  clearInterval(countdownInterval);
}

function updateNowPlaying(song) {
  $('.countdown').hide();
  $('.now-playing').show(250);
  $('.now-playing .song').text(song);

  generateYoutubeBtnPopover(song);
}

// Generate a youtube play button and place it 
// into the now playing popover
function generateYoutubeBtnPopover(song) {
  database.ref('songYoutubeIDs/'+song).once('value').then(function(snapshot) {
    var ytID = snapshot.val();
    var popoverContent = '';
    if(ytID) {
      var ytUrl = 'https://youtube.com/watch?v=' + ytID;
      var popoverContent = 
      '<a href="'+ytUrl+'" role="button"' + 
      'class="btn btn-success btn-sm" target="_blank">' + 
      '<span class="glyphicon glyphicon-music"></span> ' + 
      'Listen on YouTube</a> ' +
      '<button class="btn btn-default btn-sm" ' +
      'onclick="$(\'.now-playing a\').click();">' +
      '<span class="glyphicon glyphicon-remove"></span></button>';
    }
    $('.now-playing a').attr('data-content', popoverContent);
  });
}

function getPopoverWithCustomClass(className) {
    return '<div class="popover ' + className + '" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>';
}

module.exports = { firebase };