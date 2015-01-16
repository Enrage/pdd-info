$(document).ready(function() {
	$('.bilet').find('div:first').show();

	$('.paginat a').on('click', function() {
		if($(this).attr('class') == 'nav-active') return false;

		var link = $(this).attr('href');
		var prevActive = $('.paginat > a.nav-active').attr('href');

		$('.paginat > a.nav-active').removeClass('nav-active');
		$(this).addClass('nav-active');

		$(prevActive).fadeOut(25, function() {
			$(link).fadeIn();
		});
		return false;
	});

	/*$('.next').click(function() {
		var link = $('.paginat a').attr('href');
		var prevActive = $('.paginat > a.nav-active').attr('href');
		var next = $('.paginat a').next();
		$('.paginat > a.nav-active').removeClass('nav-active');
		$(next).addClass('nav-active');
		$(prevActive).fadeOut(25, function() {
			$(link).fadeIn();
		});
		console.log(next);
	});*/
	$('.next').click(function() {
        var length = $('.paginat a').length - 1;
        $('.paginat a').each(function(index) {
            if($(this).hasClass('nav-active') && index != length) {
                $(this).removeClass('nav-active')
                  .next('a').addClass('nav-active');
                $('.question').fadeOut(25).eq(index+1).fadeIn();
                return false;
            } else if (index == length) {
                $(this).removeClass('nav-active');
                $('.paginat').find('a').first().addClass('nav-active');
                $('.question').fadeOut(25).eq(0).fadeIn();
                return false;
            }
        });
    });

	/*$('.next').click(function() {
        var prevActive = $('.paginat').find('a.nav-active');
        var next = prevActive.next('a');
        // if(!next) {
        // 	next = $('.paginat').find('a:first');
        // }
        console.log(prevActive);
        $('.question').fadeOut(25); // Скрывает все тексты, с нужным классом
        prevActive.removeClass('nav-active');
        next.addClass('nav-active');
        $('.paginat a').each(function(index) { // Перебирает все ссылки
            if($(this).hasClass('nav-active')) { // Если находит ссылку с классом active
                $('.question').eq(index).fadeIn(); // То показывает блок с классом .text-block, который стоит по счёту (переменная index) таким же как активная ссылка
            }
        });*/
    // });



    /*$('.next').click(function() {
    	var link = $('.paginat a').attr('href');
        var prevActive = $('.paginat a.nav-active').attr('href');
        // var prevActive = $('.paginat a.nav-active').attr('href');
        var next = prevActive.next(); // Выбираем следующую ссылку в блоке
        // prevActive.removeClass('nav-active');
        // next.addClass('nav-active');
        $('.paginat a.nav-active').removeClass('nav-active');
		$(next).addClass('nav-active');
        $(prevActive).fadeOut(25, function() {
			$(next).fadeIn();
			console.log(next);
		});
    });*/

    /*$('.next').click(function() {
       $('.paginat').find('a.nav-active').removeClass('nav-active').next('a').addClass('nav-active');
    });*/



	$('#btn').click(function() {
		var test = +$('#id_bilet').text();
		var res = {'test':test};
		$('.question').each(function() {
			var id = $(this).data('id');
			res[id] = $('input[name=question-' + id + ']:checked').val();
		});
		$.ajax({
			url: 'index.php?option=bilet',
			type: 'POST',
			data: res,
			cache: false,
			success: function(html) {
				$('.content').html(html);
			},
			error: function() {
				alert('Error');
			}
		});
	});
});