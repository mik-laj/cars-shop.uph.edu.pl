'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function ($) {
	var Modal = function () {
		function Modal(element) {
			var _this = this;

			_classCallCheck(this, Modal);

			this.element = $(element);
			this.element.on('click', '.modal__close', function (ev) {
				ev.preventDefault();
				_this.close();
			});
		}

		_createClass(Modal, [{
			key: 'show',
			value: function show() {
				this.element.addClass('modal--visible');
			}
		}, {
			key: 'close',
			value: function close() {
				this.element.removeClass('modal--visible');
			}
		}]);

		return Modal;
	}();

	$.fn.modal = function () {
		return this.each(function () {
			var modal = new Modal(this);
			modal.show();
		});
	};
})(jQuery);
//# sourceMappingURL=modal.js.map
