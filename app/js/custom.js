'use strict';

$(document).ready(function() {
	 // setTimeout(function(){
  //       // This hides the address bar:
  //       window.scrollTo(0, 1);
  //   }, 0);

	// вид header при скроллинге
	$(this).on('scroll', function() {
	  let scrollTop = $(window).scrollTop();
	  let header = $('.s-header_r2');

	  if(scrollTop > 102) {
	    header.addClass('js-scrolled');
	  } else {
	    header.removeClass('js-scrolled');
	  }

	});

	// INITS
	let inits = {

    menuLink: $('.menu-nested>ul>li'),

    hoverMenuLink() {
      this.menuLink.mouseover(function(event){
        inits.menuLink.removeClass('hovered');
        $(this).addClass('hovered');
        event.stopPropagation();
      });
      
      this.menuLink.mouseout(function(event){
        $(this).removeClass('hovered');
        // event.stopPropagation();
      });
    },

		hamburgerEngine() {
			$('.hamburger_toogle').click(function(){
				$(this).toggleClass('js-opened');
				$('.hamburger_wrap').toggleClass('js-visible');
				$("body").toggleClass("fixed");
			})
		}
	}

	// inits.woocomerceNotice();
	inits.hamburgerEngine();
  inits.hoverMenuLink();

  // Ajax_search
  let ajaxSearch = {
    inputs: $('.search_form input'),

    init() {
      this.listenInput();
      $('html').click((e) => {
        if(!$(e.target).hasClass('search_wrapper')) $('.search_wrapper').css({display:'none'})
      })
    },

    listenInput() {
      $(this.inputs).each((i, e)=>{
        let wrap = $(e).parent('.search_form').children('.search_wrapper');
        let loader = $(e).next('.lds-dual-ring');
        
        let typingTimer;
        let doneTypingInterval = 500;  //time in ms 

        $(e).keyup(() => {
          clearTimeout(typingTimer);
          let val = $(e).val();

          if (val) {
            typingTimer = setTimeout(() => {
              this.askServer(val, wrap, loader);
            }, doneTypingInterval);
          } else {
            $(wrap).css({display: 'none'});
          }
        });
      })
    },

    askServer(s, wrap, loader) {
      $.ajax({
        type: "POST",
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'ajaxSearch',
            s: s,
        },
        timeout: 6000,
        beforeSend: function (response) {
          $(loader).removeClass('is-hidden');
        },
        complete: function (response) {
          $(loader).addClass('is-hidden');
        },
        // error: function() {
        //   siteAlert('Похоже, отсутствует подключение к интернету');
        // },
        success: function (response) {
          if(response) {
            $(wrap).find('ul').html(response);
            $(wrap).css({display: 'block'});
          } else {
            $(wrap).css({display: 'none'});
          }
        },
      });
    }

  }
  ajaxSearch.init();

	// ******* MENU UNDERLINE ******** //

	let menuUnderLine = {
		highlight: document.querySelector('.t-menu_underline'),
		parent: document.querySelector('.t-menu_list'),
    activePage: (document.querySelector('.js-active-page')) ? document.querySelector('.js-active-page') : document.querySelector('.t-menu_item'),

		init() {
			// this.setHighlightWidth();
      this.selectItem(this.activePage);

      $('.t-menu_item').mouseenter(e => this.selectItem(e.currentTarget));
      $('.t-menu_item').mouseleave(e => this.selectItem(this.activePage));
		},

		selectItem(target) {
		  let targetRect = target.getBoundingClientRect();
		  let parentRect = this.parent.getBoundingClientRect();

		  this.highlight.style.left = `${targetRect.left - parentRect.left}px`;
		  
		  this.setHighlightWidth(target);
		},

		setHighlightWidth(target = null) {
		  let itemTarget = target || document.querySelector('.t-menu_item');

		  itemTarget = itemTarget.querySelector('a');
		  let rect = itemTarget.getBoundingClientRect();
		  this.highlight.style.width = `${rect.width}px`;
		}
	}
	menuUnderLine.init();


	// ******* POP UP Консолидация ******** //

	let popUp = {
		init() {
			this.waitOpen();
			this.waitClose();
		},

		waitOpen() {
			$('.js-popUp-open').each(function(){
		    $(this).click(function(){
		      event.preventDefault();
		      // $('.hamburger_wrap').removeClass('js-visible');
		      $('#popUp').fadeIn('fast');
		      $("body").addClass("fixed"); 
		    })
		  }) 
		},

		waitClose() {
			$(document).mouseup(function (e){
		    if ($('#popUp').is(":visible")
		    	&& !$('.popUp_inner').is(e.target)
		    	&& $('.popUp_inner').has(e.target).length === 0
		    	|| $('.popUp_close').is(e.target)
		    	){
		      popUp.closeAllPopUps();
		    }
		  });
		},

		closeAllPopUps() {
	    $('.popUp').each(function(){
	      $(this).fadeOut('fast');
	    })
	    // $('.hamburger_wrap').removeClass('js-visible');
	    $("body").removeClass("fixed");
	  }
	};
	popUp.init();


	// ******* СЛАЙДЕРЫ ******** //
	let swiperTop = new Swiper('.main-slider', {
	  // Optional parameters
	  speed: 400,
    parallax: true,
    loop: true,
    mousewheel: false,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },

	  pagination: {
	    el: '.swiper-pagination',
      clickable: true,
	  },

	});

  // ---------- слайдер manufacturers -------------
	let sliderManufacturers;
	let engineSliderManufacturers = {
		
		breakpoint: window.matchMedia('(min-width: 768px)'),

		init() {
			this.breakpoint.addListener(this.breakpointChecker);
			this.breakpointChecker(this.breakpoint);
		},

		breakpointChecker(breakpoint) {
	    if ( breakpoint.matches === true ) {
	    	if ( sliderManufacturers !== undefined )
	    		engineSliderManufacturers.disableSwiper();
	    } else {
				engineSliderManufacturers.enableSwiper();
	    }
	  },

		enableSwiper() {
	    sliderManufacturers = new Swiper ('.menu-manufacturers', {
	      loop: true,
	      slidesPerView: 'auto',
	      speed: 400,
		    autoplay: {
		      delay: 3000,
		      disableOnInteraction: false,
		    },
	    });
	  },

	  disableSwiper(){
	  	sliderManufacturers.destroy( true, true );
	  }
	};
	
	engineSliderManufacturers.init();


  // fix manufacturers
  let fixManufacturers = {
    wrap: '.menu-manufacturers_wrapper',
    mw: 768,
    pointFix: null,
    pointBot: null,
    typeFix: null,
    

    init() {
      if(!($(this.wrap).length)) return false;
      this.getPoints();
      this.transformMenu();
      window.onresize = () => {
        $(this.wrap).removeClass('fix-top');
        $(this.wrap).removeClass('fix-bot');

        this.getPoints();
        this.transformMenu();
      }
      $(document).on('scroll', () => {
         this.transformMenu();
      })
    },

    getPoints() {
      if(window.innerWidth < this.mw) return false;
      let sidebar = $('.sidebar')[0].getBoundingClientRect();
      let menu = $('.menu-manufacturers_wrapper')[0].getBoundingClientRect();
      let rightContent = $('.right-content')[0].getBoundingClientRect();
      let hw = window.innerHeight;

      // console.log('Меню: ' + menu.height, 'Окно: ' + hw);

      if ((menu.height + 88) < hw) {
        this.typeFix = 'fix-top';
        this.pointFix = sidebar.top + pageYOffset - 69;
        this.pointBot = rightContent.bottom + pageYOffset - menu.height - 80;

      } else {
        this.typeFix = 'fix-bot';
        this.pointFix = sidebar.top + menu.height + pageYOffset - hw + 19;
        this.pointBot = rightContent.bottom + pageYOffset - hw -1;
      }
    },

    transformMenu() {
      if(window.innerWidth < this.mw) return false;
      if(pageYOffset < this.pointFix) {
        $(this.wrap).removeClass('bottom');
        $(this.wrap).removeClass(this.typeFix);
      }
      if(pageYOffset >= this.pointFix && pageYOffset < this.pointBot) {
        $(this.wrap).removeClass('bottom');
        $(this.wrap).addClass(this.typeFix);
      } 

      if(pageYOffset >= this.pointBot) {
        $(this.wrap).removeClass(this.typeFix);
        $(this.wrap).addClass('bottom');
      }
    }
  };
  fixManufacturers.init();

// ----------------------------------------------------

	let swiperSolutions = new Swiper('.solutions-slider', {
	  // Optional parameters
	  speed: 400,
		slidesPerView: 'auto',
    loop: true,
    mousewheel: false,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
	});


	// актуальный год в футере
	$('#year').html(new Date().getFullYear());

	// клик в мобильном футере

	// $('.s-footer_menu').find('.h6').click(function(){
	// 	event.preventDefault();
	// 	$(this).toggleClass('is-active');
	// })
	let footer = {
		menu: $('.s-footer_menu').find('.h6'),

		click() {
			this.menu.click(function() {

				event.preventDefault();
				isOpened = $(this).hasClass('is-active');
				footer.menu.each((i, e) => $(e).removeClass('is-active'));
				isOpened ? $(this).removeClass('is-active') : $(this).addClass('is-active');
			
			})
		},
	};
	footer.click();

	// КОРЗИНА

	$(document).find('.s-header_cart').click(function(){
		let count = $(this).find('span').text();
		
		if(count === '0') {
			event.preventDefault();
			siteAlert('Ваша корзина пока пуста');
		}
	})


  // ПОДГРУЗКА ПОСТОВ И ТОВАРОВ AJAX
  $('.loader_new_cards').each(function() {
    $(this).on("click", () => upDatePosts(
      $(this).data('page'),
      $(this).data('maxpage'),
      $(this).data('category'),
      $(this).data('search'),
      $(this).data('tag'),
      $(this).data('container'),
      $(this)
    ));
   });

  function upDatePosts(page, maxpage, category, search, tag, recipient, button) {
    
    // $(button).html('<span> Загружаю ... </span>');
    $(button).addClass('is-hidden');

    $.ajax({  
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: ({
        paged: page,
        category: category,
        search: search,
        tag: tag,
        'action': 'get_new_cards'
      }),  
      cache: false,
      success: function(response) {
        contentRecipient = $(button).parents('.js-menu-pages').find(recipient);
        contentRecipient.append(response);
        contentRecipient.find(`[data-page='${page}']`).slideDown('slow');
        // scrollTo(contentRecipient.find(`[data-page='${page}']`));

        page += 1;

        if(page > maxpage) {
          $(button).slideUp().remove();
        } else {
          // $(button).html('<span>Показать еще</span>')
          $(button).removeClass('is-hidden');
          $(button).data('page', page);
        } 
      }, 
    }); 
  };


  // ПОДГРУЗКА КОНТЕНТА РЕШЕНИЯ
  $('.ldr-r-content').each(function() {
    $(this).click(() => loadRContent(
      $(this),
      $(this).data('category'),
      $(this).data('recipient'),
      $(this).data('action'),
    ))
  })

  function loadRContent(button, category, recipient, action) {
    $.ajax({  
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: ({
        category: category,
        action: action
      }),  
      cache: false,
      success: function(response) {
        // console.log(response);
        contentRecipient = $(button).parents('.js-menu-pages').find(recipient);
        contentRecipient.append(response).slideDown('fast');
        // scrollTo(contentRecipient);
        $(button).remove();

      }, 
    }); 
  }
	// ************* MENU ********* //


	// начальные установки

	// Получаем slug запроса
	let cardMenu = $('.js-card-menu-container');
	let isCardMenu = (cardMenu.length != 0);
	let insideContainer = $('.js-card-menu-inside-container');

	// Мобильный  select
	// поставить условие - только на мобильных устройствах, либо отключить fixed
	$('.menu-item a').click(function() {
		$(this).closest('.menu-wrapper').addClass('js-mob-wrapdown');
		$("body").addClass("fixed");
	})


  // ****************** START APP ********************

  if(window.location.hash && stateRender(window.location.hash)) {
  	setTimeout(() => scrollTo('.right-content'), 120);
  } else {
  	stateRender('');
  }

	// if(!stateRender(window.location.hash)) stateRender('');

	$(window).bind('hashchange', function() {
		$('.menu-wrapper').removeClass('js-mob-wrapdown');
		$('body').removeClass('fixed'); // для мобильного selecta
		// если вдруг не нашел
		if(!stateRender(location.hash)) stateRender(''); //тут без scroll
 	});

	function stateRender(slug){
		// console.log(slug);
		if (slug) {
			if(selectMenuItem(slug)) {
				
				cardMenu.fadeOut(100);
				setTimeout(() => insideContainer.fadeIn(100), 100);
				// insideContainer.fadeIn(100);
				// setTimeout(() => scrollTo('.sidebar'), 120);							
				return true;

			} else { 
				return false
			};
			
		} else {

			if(isCardMenu) {
				insideContainer.fadeOut(100);
				setTimeout(() => cardMenu.fadeIn(100), 100);
			} else {
				selectFirstMenuItem();
				// scrollTo('.sidebar');
			}
			return true;
		}
	};

	// меню включается по первой вкладке
	function selectMenuItem(pageLink) {
		let finded = false;
		// // переопределяем активную вкладку
		$('.sidebar').find('li').each(function(){
			
			menuLink = $(this).children('a');
			
			if(menuLink.attr('href') === pageLink) {
				finded = true;

				$(this).addClass('is-open');
				$(this).parents('li').each(function() { 
					$(this).addClass('is-open');
				})

				// отображаем нужное side-menu и закрываем остальные
				$(this).parents('.sidebar').find('.side-menu').addClass('is-hidden');
				$(this).parents('.side-menu').removeClass('is-hidden');

			} else {

				$(this).removeClass('is-open');
			}
		})

		// открываем контент справа
		$('.right-content').find('.js-menu-pages').each(function(){
			// тут без #
			if($(this).data('page') === pageLink.replace("#","")) {
				finded = true;

				let titleText = $(this).data('title');

        if(titleText) {
          let titleDom = $(document).find('.top-title h1'); 
          titleDom.hide().html(titleText).fadeIn();
        }

        let loader = $(this).find('.js-loader');

        // if(loader.length) scrollTo('.sidebar'); // значит конец иерархии

        if($(loader).data('page') === 1) $(loader).click() // Загружаем контент. если нет, то нет
				setTimeout(() => $(this).fadeIn(100), 100);
				// console.log($(this));		
			} else {
				$(this).fadeOut(100);
			}
		})

		return finded;
	}

	function selectFirstMenuItem() {
		let sideMenu = $('.sidebar').find('li');
		let rightContent = $('.right-content').children('.js-menu-pages');

		$(sideMenu).removeClass('is-open');
		$(rightContent).fadeOut(100);

		$(sideMenu[0]).addClass('is-open');
		setTimeout(() => $(rightContent[0]).fadeIn(), 100);;

	}

	$('.js-scrollUp').click(() => {
		setTimeout(() => scrollTo('.right-content'), 150);
		// console.log('hi!');
	});

	// ****************** FORMS ********************
	// обработка форм
	$('.submit').each(function() {
    $(this).click(function(){ 
      let form = $(this).closest('.form');
      $('.error').fadeOut('fast'); 

      // ПРОВЕРКИ

      let error = false; 
      
      // имя
      if($(form).find('input.name').length) {
        let name = $(form).find('input.name');
        if(name.val() == "" || name.val() == " ") {
          $(name).parent().find('.error').fadeIn('fast'); 
          error = true;
        }
      }

                 
      // e-mail
      if($(form).find('input.e-mail').length) {
        let email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/; 
        let email = $(form).find('input.e-mail');
        if (email.val() == "" || email.val() == " "
          || !email_compare.test(email.val())) { 
          $(email).parent().find('.error').fadeIn('fast'); 
          error = true;
        }
      }

      // согласие
      let agree = $(form).find('input.agree');
      if(agree.prop("checked") == false) {
        $(agree).parent().find('.error').fadeIn('fast'); 
        error = true;
      }

      if(error == true) {
        // $('#err-form').slideDown('slow');
        return false;
      }

      //  ОБРАБОТКА И ОТПРАВКА

      let data_string = $(form).serialize();
      // типо отправлено
      let success = $(form).parent().find('.form_send-success');
      let senderror = $(form).parent().find('.form_send-error');

      $.ajax({
        type: "POST",
        url: '/wp-admin/admin-ajax.php',
        data: data_string + '&action=send_mail',
        timeout: 6000,
        error: function(request,error) {
        	// console.log(request);
        	$(form).slideUp('slow');
        	$(senderror).slideDown('slow');

          if (error == "timeout") {

          }
          else {

          }
        },
        success: function(data) {
        	$(form).slideUp('slow');
        	$(success).slideDown('slow');
          // console.log(data);
        }
      });

		  $('.js-return-form').click(function() {
		  	$(success).slideUp('slow');
		  	$(senderror).slideUp('slow');
		  	$(form).slideDown('slow');
		  })

      return false; // stops user browser being directed to the php file
    });
  });

	$('.js-order-submit').each(function() {
    $(this).click(function(){ 
      let form = $(this).closest('.form');
      $('.error').fadeOut('fast'); 

      // ПРОВЕРКИ

      let error = false; 
      
      // имя
      if($(form).find('input.name').length) {
        let name = $(form).find('input.name');
        if(name.val() == "" || name.val() == " ") {
          $(name).parent().find('.error').fadeIn('fast'); 
          error = true;
        }
      }

      // телефон
      if($(form).find('input.phone').length) {
        let phone_compare = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/; 
        let phone = $(form).find('input.phone');
        if (phone.val() == "" || phone.val() == " "
          || !phone_compare.test(phone.val())) { 
          $(phone).parent().find('.error').fadeIn('slow'); 
          error = true;
        }
      }
            
      // e-mail
      if($(form).find('input.e-mail').length) {
        let email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/; 
        let email = $(form).find('input.e-mail');
        if (email.val() == "" || email.val() == " "
          || !email_compare.test(email.val())) { 
          $(email).parent().find('.error').fadeIn('fast'); 
          error = true;
        }
      }

      // Компания
      if($(form).find('input.company').length) {
        let company = $(form).find('input.company');
        if(company.val() == "" || company.val() == " ") {
          $(company).parent().find('.error').fadeIn('fast'); 
          error = true;
        }
      }

      // согласие
      let agree = $(form).find('input.agree');
      if(agree.prop("checked") == false) {
        $(agree).parent().find('.error').fadeIn('fast'); 
        error = true;
      }

      if(error == true) {
        // $('#err-form').slideDown('slow');
        return false;
      }

      //  ОБРАБОТКА И ОТПРАВКА
      let fields = $(form).serializeArray();
      let user = $(this).data('user');
      // типо отправлено
      let success = $(form).parent().find('.form_send-success');
      let senderror = $(form).parent().find('.form_send-error');

      $.ajax({
        type: "POST",
        url: '/wp-admin/admin-ajax.php',
        // data: data_string + '&action=ajax_order',
        data: {
            'action': 'ajax_order',
            'fields': fields,
            'user_id': user,
        },
        timeout: 6000,
        error: function(request,error) {
        	// console.log(request);
        	$(form).slideUp('slow');
        	$(senderror).slideDown('slow');
        },
        success: function(data) {
        	$(form).slideUp('slow');
          $(success).find('.second-line').text(data);
        	$(success).slideDown('slow');
        }
      });

		  $('.js-return-form').click(function() {
		  	$(success).slideUp('slow');
		  	$(senderror).slideUp('slow');
		  	$(form).slideDown('slow');
		  })

      return false; // stops user browser being directed to the php file
    });
  });

  $('.agree').click(function(){
  	let submit = $(this).parents('form').find('.form__btn button');

		($(this).prop('checked')) ?
  	submit.addClass('is-checked') : submit.removeClass('is-checked');
  })

  $('.js-finish-order').click(function() {
  	window.location = "/products";
  })

  $('form label').click((e) => $(e.target).prev().focus())
  	

  // AJAX ADD TO CART

	$(document).on('click', '.single_add_to_cart_button', function (e) {
    e.preventDefault();

    var $thisbutton = $(this),
		    $form = $thisbutton.closest('form'),
		    id = $thisbutton.val(),
		    product_qty = $form.find('input[name=quantity]').val() || 1,
		    product_id = $form.find('input[name=product_id]').val() || id,
		    variation_id = $form.find('input[name=variation_id]').val() || 0;

    var data = {
      action: 'woocommerce_ajax_add_to_cart',
      product_id: product_id,
      product_sku: '',
      quantity: product_qty,
      variation_id: variation_id,
    };

    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

    $.ajax({
      type: 'post',
      // url: wc_add_to_cart_params.ajax_url,
      url: "/wp-admin/admin-ajax.php",
      data: data,
      beforeSend: function (response) {
        $thisbutton.addClass('op-5');
        // $thisbutton.text('Загружаю...');
      },
      complete: function (response) {
        $thisbutton.removeClass('op-5');
        // $thisbutton.text('Добавить в Корзину');
      },
      error: function() {
      	siteAlert('Похоже, отсутствует подключение к интернету');
      },
      success: function (response) {
        if (!response.error) {
          $(document).find('.s-header_cart-count').find('span').text(response.cart_count);
        };

        siteAlert(response.message);
      },
    });

    return false;
  });

	// FUNCTIONS

	function siteAlert(message) {
		let alert = $('.alert').text('');
		// alert.text(message).addClass('is-visible');
		alert.html(message).fadeIn(150);
		// setTimeout(() => alert.removeClass('is-visible'), 3000);
		setTimeout(() => alert.fadeOut(150), 3000);
	};

	function scrollTo(anchor) {
    let scrollTop = ($(window).scrollTop());
    let scrollGoal = $(anchor).offset().top - 57;
    // console.log(anchor);
    // if (scrollTop > scrollGoal) {
      $("html, body").animate({
         scrollTop: scrollGoal
      }, {
         duration: 500,
         easing: "swing"
      }); 
    // }
	};

  // ****************** PAGE SEARCH ********************

  let pageSearch = {
    tabs: $('.page-search .tab'),
    contents: $('.tab-content'),

    listen() {
      $(this.tabs).each((i, e)=>{
        $(e).click(()=>{
          $(this.tabs).removeClass('js-active');
          $(e).addClass('js-active');

          $(this.contents).removeClass('js-active');
          $(this.contents[i]).addClass('js-active');
        })
      })
    },
  }
  pageSearch.listen();
});

