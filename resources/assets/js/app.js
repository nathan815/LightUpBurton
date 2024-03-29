// Genral constants - these are populated by firebase
var FIRST_SHOW_DATE;
var SHOW_START_HOUR;
var SHOW_END_HOUR_WEEKDAY;
var SHOW_END_HOUR_WEEKEND;

// JS Day of Week
// Sunday = 0, Saturday = 7
var DAY_FRIDAY = 6;

// Some variables
var countdownInterval;
var inShowSeason = false;

// Import some non-module scripts
require('script-loader!./plugins/countdown.min.js');
require('script-loader!./plugins/ie10-viewport-bug-workaround.js');

// Bootstrap
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

    $(document).scroll(function() {
      var $this = $(this);
      var $bar = $('#infobar');
      var origOpacity =  $bar.data('origOpacity') || $bar.css('opacity');
      $bar.data('origOpacity', origOpacity)
      var scroll = $this.scrollTop();
      var opacity = 1 -  scroll*0.05;
      if(opacity > origOpacity) 
        opacity = origOpacity;
      $bar.css('opacity', opacity);
    });

    database.ref('showData').on('value', function(snapshot) {
        var data = snapshot.val();
        var song = data.nowPlaying;

        SHOW_START_HOUR = data.showStartHour;
        SHOW_END_HOUR_WEEKDAY = data.showEndHourWeekday;
        SHOW_END_HOUR_WEEKEND = data.showEndHourWeekend;
        FIRST_SHOW_DATE = Date.parse(data.firstShowDate);
        LAST_SHOW_DATE = Date.parse(data.lastShowDate);

        if(data.showCancelled) {
          showIsCancelled();
          return;
        }

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

    $('.gallery-load-more').click(function() {
      var $btn = $(this);
      var $parent = $(this).closest('.gallery');
      var type = $parent.attr('data-type');
      var $lastChild = $('.gallery-item-container:last-of-type', $parent);
      var lastId = $lastChild.attr('data-id');
      var year = $parent.attr('data-year');
      year = year ? year : 'all';

      if(!lastId) 
        return;

      $btn.prop('disabled',true).data('origtext', $btn.text()).text('Loading...');
      
      $.ajax({
        method: 'GET',
        url: '/gallery/load/' + type + '/' + year + '/' + lastId,
        success: function(data) {
          if(!data) {
            $btn.text('You have reached the end.')
            return;
          }
          $('.gallery[data-type="'+type+'"] .items').append(data);
          $btn.prop('disabled',false).text($btn.data('origtext'));
        },
        error: function() {
          alert('Sorry, could not load more '+type);
        }
      });

    });

});

function showStartingNow() {
  stopCountdown();
  $('.countdown').show(250);
  $('.countdown .time').text('Playing Now!');
  $('.home-countdown').addClass('playing');
}

function showIsCancelled() {
  $('.countdown').show(250)
    .addClass('cancelled')
    .html('<em>Tonight\'s Show Cancelled</em>');
}

function hasShowStarted() {
  if(!inShowSeason) 
    return false;
  var d = new Date();
  var curHour = d.getHours();
  var curDay = d.getDay();
  return (
    curHour >= SHOW_START_HOUR && 
    (
      (curDay < DAY_FRIDAY && curHour < SHOW_END_HOUR_WEEKDAY) || 
      (curDay >= DAY_FRIDAY && curHour < SHOW_END_HOUR_WEEKEND)
    )
  );
}

function setupCountdownDisplay(now) {
  $('.now-playing').hide();
  $('.home-countdown').removeClass('playing');
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
    else if((now.getDay() >= DAY_FRIDAY && now.getHours() > SHOW_END_HOUR_WEEKEND) || 
      (now.getDay() < DAY_FRIDAY && now.getHours() > SHOW_END_HOUR_WEEKDAY))
    {
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
      var minutes = ts.minutes ? ts.minutes + 'm' : '';
      //: (ts.hours != 0 ? '0m' : '');
      var seconds = ts.seconds ? ts.seconds + 's' : '';
      var text = [weeks, days, hours, minutes, seconds];
      text = text.join(' ');
      $('.home-countdown #weeks').text(ts.weeks);
      $('.home-countdown #days').text(ts.days);
      $('.home-countdown #hours').text(ts.hours);
      $('.home-countdown #minutes').text(ts.minutes);
      $('.home-countdown #seconds').text(ts.seconds);
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
  database.ref('songYoutubeIDs').child(song).once('value').then(function(snapshot) {
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