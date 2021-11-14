/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/custom-scripts.js ***!
  \****************************************/


(function ($) {
  /** ------------------------------------------------------------------------------
   * Window loading screen
   * ---------------------------------------------------------------------------- */
  if (!window.loadingScreen) {
    window.loadingScreen = function (Action) {
      if (Action == "show") {
        $("body").addClass("ajax-processing");
      }

      if (Action == "hide") {
        $("body").removeClass("ajax-processing");
      }
    };
  }
  /** ------------------------------------------------------------
   * Submit voting form
   * ---------------------------------------------------------- */


  $(document).on("submit", "#voting_form", function (e) {
    e.preventDefault(); // Remove errors

    $('form#voting_form .form-control').each(function () {
      $(this).removeClass("input-error");
    });
    $("#candidateOne").removeClass("input-error");
    $("#candidateTwo").removeClass("input-error");
    $('.input-status-msg').each(function () {
      $(this).html("");
    });
    var formEl = $('form#voting_form');
    var statusDiv = $('#voting_form_status');
    var FrmData = new FormData(formEl[0]);
    $.ajax({
      url: appUrl + "/vote",
      data: FrmData,
      type: 'POST',
      processData: false,
      contentType: false,
      beforeSend: function beforeSend(xhr) {
        statusDiv.html("<p class='msg msg-info msg-full'>Processing, please wait...</p>");
        window.loadingScreen("show");
      },
      complete: function complete(xhr, status) {
        if (xhr.status == 422) {
          window.loadingScreen("hide");
          statusDiv.html('<div class="msg msg-danger msg-full">' + xhr.responseJSON.message + '</div>');
          $.each(xhr.responseJSON.errors, function (i, msg) {
            $('#' + i).addClass('input-error');
            $('#' + i + '_msg').html('<span class="is-error">' + msg + '</span>');
          });
        } else if (xhr.status != 200) {
          console.log(xhr);
          window.loadingScreen("hide");
          console.log('Failed ajax request, Error: ' + xhr.responseJSON.message);
        }
      },
      success: function success(rData) {
        window.loadingScreen("hide"); // let rObj = JSON.parse(rData);

        var rObj = rData;

        if (rObj.status == "success") {
          formEl[0].reset();
          statusDiv.html("<p class='msg msg-success msg-full'>" + rObj.message + "</p>");
        } else {
          statusDiv.html('<div class="msg msg-danger msg-full">' + rObj.message + '</div>');
        }
      }
    });
  });
})(jQuery);
/******/ })()
;