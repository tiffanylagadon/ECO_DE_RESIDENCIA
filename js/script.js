 let dropdown = document.querySelectorAll("nav ul li a");

        dropdown.forEach((element) => {
            element.addEventListener("click" , (event)=> {
                event.stopPropagation();
                element.nextElementSibling.classList.toggle("show");
            })
        })

/// book a room
(function($){
	function floatLabel(inputType){
		$(inputType).each(function(){
			var $this = $(this);
			// on focus add cladd active to label
			$this.focus(function(){
				$this.next().addClass("active");
			});
			//on blur check field and remove class if needed
			$this.blur(function(){
				if($this.val() === '' || $this.val() === 'blank'){
					$this.next().removeClass();
				}
			});
		});
	}
	// just add a class of "floatLabel to the input field!"
	floatLabel(".floatLabel");
})(jQuery);

//register multi step
$(document).ready(function(){
    		
	$(".multistep-container .form-box .button-row .next").click(function(){
		$(this).parents(".form-box").fadeOut('fast');
		$(this).parents(".form-box").next().fadeIn('fast');
	});
	$(".multistep-container .form-box .button-row .previous").click(function(){
		$(this).parents(".form-box").fadeOut('fast');
		$(this).parents(".form-box").prev().fadeIn('fast');
	});

});

