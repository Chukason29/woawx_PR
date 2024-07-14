$(document).ready(function() {
    $(window).scroll(function() {
        $('.animated-element').each(function() {
            var position = $(this).offset().top + 95;
            var scroll = $(window).scrollTop();

            if (position < scroll + $(window).height()) {
				//$(this).addClass('animate__animated');
				$(this).addClass('visible');
            }
        });
        $('.header')
    });
});

const menuIcon = document.getElementById("menu-icon");
const menuNav = document.getElementById("menu-nav");
const closeMenu = document.getElementById("close-menu");
const openMenu = document.getElementById("open-menu");

function toggleMenu() {
    if (!menuNav.classList.contains("show-menu")) {
        menuNav.classList.add("show-menu");
        menuNav.classList.remove("hide-menu");
    } else {
        menuNav.classList.add("hide-menu");
        menuNav.classList.remove("show-menu");
    }
}

//toggling through the menu system
openMenu.addEventListener("click", toggleMenu);
closeMenu.addEventListener("click", toggleMenu);



// Form Section

$(document).ready(function(){
    $('#contact').click(function(event){
        $('#contact').attr('disabled', 'disabled');
        event.preventDefault();
        var formData = $('#contact-form').serialize();
        $.ajax({
            url: 'contact.php',
            method: 'post',
            data : formData + '&action=contact',
            beforeSend: function(){
                $('#loader').show();
            }
            }).done(function(result){
                if(result.length > 0){
                    $('#loader').hide();
                    $('#result').html(result);
                    $('#contact').removeAttr('disabled');
                }
                event.stopImmediatePropagation();
                return false;
            })
    })    
})