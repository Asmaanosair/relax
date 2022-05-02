$(function () {
  //========================================= Start Menu ===================================
  $('.head-menu').hover(
    function () {
      $('.sub-menu-child').hide()
      $(this).children('.sub-menu-child').show().css({
        display: 'flex',
      })
    },
    function () {
      $('.sub-menu-child').hide()
    },
  )

  //========================================== Start Acive sidebar=====================================
  //   let infoUrl = window.location.href
  //   let infoUrlTarget = infoUrl.split('/')
  // if(infoUrlTarget.length==5)
  //  {

  //      $("." + infoUrlTarget[4]).addClass('active').siblings().removeClass('active')
  // }
  //  else{

  //  }

  //========================================= Start Pricing table ===================================

  $('.show-pricing').on('click', function () {
    let pricingType = '.' + $(this).data('type')
    $('.pricing').hide(1000)
    $('' + pricingType).show(1000)
    $(this).addClass('active-pricing')
    $(this).siblings().removeClass('active-pricing')
  })

  //================================= Start Search Patients ==================================

  $('.search').on('keyup', function () {
    let valueSearch = $(this).val()
    search(valueSearch)
  })

  function search(val) {
    let li = $('.result .name')

    li.each(function () {
      let name = $(this).text()

      if (name.indexOf(val) == -1) {
        $(this).parents('.result').fadeOut(300)
      } else {
        $(this).parents('.result').fadeIn(300)
      }
    })
  }
})
