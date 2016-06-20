(function($){
	class Modal{
		constructor(element){
			this.element = $(element);
			this.element.on('click', '.modal__close', ev => {
				ev.preventDefault();
				this.close();
			});
		} 
		show(){
			this.element.addClass('modal--visible');
		}
		close(){
			this.element.removeClass('modal--visible');
		}
	}
	$.fn.modal = function(){
		return this.each(function() {
			let modal = new Modal(this);
			modal.show();
		});
	};

})(jQuery);