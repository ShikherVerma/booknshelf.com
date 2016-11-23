var $input = $('<div class="modal-body"><input type="text" class="form-control" placeholder="Message"></div>')

$(document).on('click', '.js-msgGroup', function () {
  $('.js-msgGroup, .js-newMsg').addClass('hide')
  $('.js-conversation').removeClass('hide')
  $('.modal-title').html('<a href="#" class="js-gotoMsgs">Back</a>')
  $input.insertBefore('.js-modalBody')
})

$(function () {

  $(window).on('resize', function () {
    var instance = $('[data-toggle="popover"]').data('bs.popover')
    if (instance) {
      instance.options.viewport.padding = 20
    }
  })

  $('[data-toggle="popover"]').popover({
    template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
    title: '',
    html: true,
    trigger: 'manual',
    placement:'bottom',
    viewport: {
      selector: 'body',
      padding: 20
    },
    content: function () {
      var $nav = $('.app-navbar .navbar-nav:last-child').clone()
      return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
    }
  })

  $('[data-toggle="popover"]').on('click', function (e) {
    e.stopPropagation()

    if ($('[data-toggle="popover"]').data('bs.popover').tip().hasClass('in')) {
      $('[data-toggle="popover"]').popover('hide')
      $(document).off('click.app.popover')

    } else {
      $('[data-toggle="popover"]').popover('show')

      setTimeout(function () {
        $(document).one('click.app.popover', function () {
          $('[data-toggle="popover"]').popover('hide')
        })
      }, 1)
    }
  })

})

$(document).on('click', '.js-gotoMsgs', function () {
  $input.remove()
  $('.js-conversation').addClass('hide')
  $('.js-msgGroup, .js-newMsg').removeClass('hide')
  $('.modal-title').html('Messages')
})

$(document).on('click', '[data-action=growl]', function (e) {
  e.preventDefault()

  $('#app-growl').append(
    '<div class="alert alert-dark alert-dismissible fade in" role="alert">'+
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">×</span>'+
      '</button>'+
      '<p>Click the x on the upper right to dismiss this little thing. Or click growl again to show more growls.</p>'+
    '</div>'
  )
})

$(document).on('focus', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    $(this).animate({
      width: 300
    })
  }
})

$(document).on('blur', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    var $this = $(this).animate({
      width: 180
    })
  }
})
