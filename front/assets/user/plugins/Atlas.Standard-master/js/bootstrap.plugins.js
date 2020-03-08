//Responsive Tabs
(function ($) {
  'use strict';

  $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function (e) {
    var $target = $(e.target);
    var $tabs = $target.closest('.nav-tabs-responsive');
    var $current = $target.closest('li');
    var $parent = $current.closest('li.dropdown');
    $current = $parent.length > 0 ? $parent : $current;
    var $next = $current.next();
    var $prev = $current.prev();
    var updateDropdownMenu = function ($el, position) {
      $el
      	.find('.dropdown-menu')
        .removeClass('pull-xs-left pull-xs-center pull-xs-right')
      	.addClass('pull-xs-' + position);
    };

    $tabs.find('>li').removeClass('next prev');
    $prev.addClass('prev');
    $next.addClass('next');

    updateDropdownMenu($prev, 'left');
    updateDropdownMenu($current, 'center');
    updateDropdownMenu($next, 'right');
  });

})(jQuery);

//Placement functions
(function ($) {
  // goTo
  // use: $("#element").goTo();
  $.fn.goTo = function () {
    var fromTop = 90;
    $('html, body').animate({
      scrollTop: $(this).offset().top - fromTop
    }, 'fast');
    return this; // for chaining...
  }
  // end goTo     
  //center
  $.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
  }
  //end center

  //Textbox cursor to end
  $.fn.cursorAtEnd = function () {
    return this.each(function () {
      $(this).focus()
      // If this function exists...
      if (this.setSelectionRange) {
        // ... then use it (Doesn't work in IE)
        // Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
        var len = $(this).val().length * 2;
        this.setSelectionRange(len, len);
      } else {
        // ... otherwise replace the contents with itself
        // (Doesn't work in Google Chrome)
        $(this).val($(this).val());
      }
      // Scroll to the bottom, in case we're in a tall textarea
      // (Necessary for Firefox and Google Chrome)
      this.scrollTop = 999999;
    });
  };
})(jQuery);

//Font-Awesome 'beautiful' checkbox
function faCheckbox() {
  $('.input-group-addon.beautiful').each(function () {
    var $widget = $(this),
        $input = $widget.find('input'),
        type = $input.attr('type');
    settings = {
      checkbox: {
        on: { icon: 'fa fa-2x fa-check-circle-o' },
        off: { icon: 'fa fa-2x fa-circle-o' }
      },
      radio: {
        on: { icon: 'fa fa-2x fa-dot-circle-o' },
        off: { icon: 'fa fa-2x fa-circle-o' }
      }
    };

    if ($widget.children('span[disabled="disabled"]').length > 0) {
      var $input = $widget.children('span[disabled="disabled"]').find('input');
      $input.unwrap();
      $widget.addClass('not-allowed');
    }

    if ($widget.children('span').length == 0) {
      $widget.prepend('<span class="' + settings[type].off.icon + '"></span>');
    }

    $widget.on('click', function () {
      if (!$input.is('[disabled="disabled"]')) {
        $input.prop('checked', !$input.is(':checked'));
        updateDisplay();
      }
    });

    function updateDisplay() {
      var isChecked = $input.is(':checked') ? 'on' : 'off';

      $widget.find('.fa').attr('class', settings[type][isChecked].icon);
      if (isChecked === "on") {
        $widget.closest('.input-group').find('.beautiful').css("color", "#00CC00");
      } else {
        $widget.closest('.input-group').find('.beautiful').css("color", "inherit");
      }
    }
    updateDisplay();
  });
}

//Second Level Dropdown
function secondLevelDropdown() {
  $(".dropdown-menu > li > a.trigger").on("click", function (e) {
    var current = $(this).next();
    var grandparent = $(this).parent().parent();
    if ($(this).hasClass('left-caret') || $(this).hasClass('right-caret'))
      $(this).toggleClass('right-caret left-caret');
    grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
    grandparent.find(".sub-menu:visible").not(current).hide();
    current.toggle();
    e.stopPropagation();
  });
  $(".dropdown-menu > li > a:not(.trigger)").on("click", function () {
    var root = $(this).closest('.dropdown');
    root.find('.left-caret').toggleClass('right-caret left-caret');
    root.find('.sub-menu:visible').hide();
  });
}

/* Adds tooltip where the data-toggle is set */
function registerTooltips() {
  $('[data-toggle="tooltip"]').tooltip({ placement: 'top', trigger: 'hover' });  
  $('[data-toggle="tooltip-bottom"]').tooltip({ placement: 'bottom', trigger: 'hover' });
  /* Don't Show Tooltips on Touch Devices and open dropdowns */
  $('[data-toggle="tooltip-bottom"], [data-toggle="tooltip"]').on('show.bs.tooltip shown.bs.dropdown', function (e) {
    if ('ontouchstart' in document.documentElement || $(this).hasClass('open')) {
      $(this).tooltip('hide');
      e.preventDefault();
    }
  });
  $(document).popover({
    selector: '[data-toggle=popover-focus]',
    trigger: 'focus'
  });
  $('[data-toggle="popover"]').popover();
  $('[data-toggle=popover-form]').popover({
    content: function () {
      var idString = '_popoverform';

      $('[data-rename]').each(function () {
        $(this).attr('id', $(this).attr('id').replace(idString, ''));
        $(this).attr('name', $(this).attr('name').replace(idString, ''));
      });


      var html = $('[data-popover-content]').html();

      $('[data-rename]').each(function () {
        $(this).attr('id', $(this).attr('id') + idString);
        $(this).attr('name', $(this).attr('name') + idString);
      });

      return html;
    }
  });
  $('[data-toggle=popover-hover]').popover({
    trigger: 'hover'
  });
}

/* popover dismiss click */
$(document).on("click", ".popover .close", function () {
  $(this).parents(".popover").popover('hide');
});

/* DateTimePicker */
function registerDateTimePicker() {

  var dp = $('[data-datetime="date"]');
  var tp = $('[data-datetime="time"]');
  var dtp = $('[data-datetime="both"]');
  var dtps = $('[data-datetime="both-side"]');

  dp.datetimepicker({
    format: 'MM/DD/YYYY',
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'bottom'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  tp.datetimepicker({
    format: 'LT',
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'bottom'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  dtp.datetimepicker({
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'bottom'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  dtps.datetimepicker({
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'bottom'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true,
    sideBySide: true
  });

  var dpa = $('[data-datetime="date-auto"]');
  var tpa = $('[data-datetime="time-auto"]');
  var dtpa = $('[data-datetime="both-auto"]');
  var dtpsa = $('[data-datetime="both-side-auto"]');

  dpa.datetimepicker({
    format: 'MM/DD/YYYY',
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'auto'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  tpa.datetimepicker({
    format: 'LT',
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'auto'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  dtpa.datetimepicker({
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'auto'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true
  });

  dtpsa.datetimepicker({
    showClose: true,
    widgetPositioning: {
      horizontal: 'auto',
      vertical: 'auto'
    },
    icons: {
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-chevron-up',
      down: 'fa fa-chevron-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-dot-circle-o',
      clear: 'fa fa-trash',
      close: 'fa fa-times'
    },
    ignoreReadonly: true,
    sideBySide: true
  });
}
/* End DateTimePicker */

/* File Picker */
$(document).on('change', '.btn-file :file', function () {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

  input.trigger('fileselect', [numFiles, label]);
});

function filePickerSelect() {

  $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

    console.log('here');

    var input = $(this).parents('.input-group').find(':text'),
        log = numFiles > 1 ? numFiles + ' files selected' : label;

    console.log(input);
    console.log(log);

    if (input.length) {
      input.val(log);
    } else {
      if (log) alert(log);
    }

  });
}
/* End File Picker */

/* Run Functions */
$(document).ready(function () {
  faCheckbox();
  registerTooltips();
  registerDateTimePicker();
  secondLevelDropdown();
  filePickerSelect();
});
/* End Run Functions */