(function( $ ) {
	$(document).ready(function() {
		$('a.icon-maker').on( 'click', function(e) {
			var icon_name = $(this).children().attr('class');
			var html = '<i class="' + icon_name + '"></i>';
			var css = build_css()
			$('input[name="back_to_the_top_options[label]"]').val(html);
			$('.backtothetop-viewer').html(html + css);
		});

		function build_html() {
			var css = build_css()
			$('.backtothetop-viewer').html( $('input[name="back_to_the_top_options[label]"]').val() + css );
		}

		function build_css() {
			var css = '<style>';
			css += 'a#backtothetop-fixed {';
			css += 'display: inline-block;';
			if ($('input[name="back_to_the_top_options[font-size]"]').val()) {
				css += 'font-size: ' + encode($('input[name="back_to_the_top_options[font-size]"]').val()) + '%;';
			}
			if ($('input[name="back_to_the_top_options[font-weight]"]').val()) {
				css += 'font-weight: ' + encode($('input[name="back_to_the_top_options[font-weight]"]').val()) + ';';
			}
			if ($('input[name="back_to_the_top_options[font-color]"]').val()) {
				css += 'color: ' + encode($('input[name="back_to_the_top_options[font-color]"]').val()) + ';';
			}
			css += 'text-decoration: none;text-align: center;line-height: 1.2;';

			css += '}';
			css += 'a#backtothetop-fixed:hover {';
			if ($('input[name="back_to_the_top_options[font-hover-color]"]').val()) {
				css += 'color: ' + encode($('input[name="back_to_the_top_options[font-hover-color]"]').val()) + ';';
			}
			css += '}';
			css += 'a#backtothetop-fixed .dashicons {';
			css += 'font-size: 100%;';
			if ($('input[name="back_to_the_top_options[font-weight]"]').val()) {
				css += 'font-weight: ' + encode($('input[name="back_to_the_top_options[font-weight]"]').val()) + ';';
			}
			css += 'text-decoration: none;';
			css += 'font-weight: none;';
			css += 'line-height: 1.2;';
			css += 'vertical-align: text-bottom;';
			css += 'padding: 0;';
			css += 'margin: 0;';
			css += 'display: inline;';
			css += 'width: auto;';
			css += 'height: auto;';
			css += '-webkit-transition: 0;';
			css += 'transition: 0;';
			css += '}';

			css += 'a#backtothetop-fixed .fa {';
			css += 'font-size: 100%;';
			css += '}';

			if ($('textarea[name="back_to_the_top_options[custom-css]"]').val()) {
				css += encode($('textarea[name="back_to_the_top_options[custom-css]"]').val());
			}

			css += '</style>';

			return css;
		}

		function encode(str) {
			return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
		}

		function decode(str) {
			return str.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"').replace(/&#39;/g, '\'').replace(/&amp;/g, '&');
		}

		function fixed_display() {
			var fixed_display = $('input[name="back_to_the_top_options[fixed-display]"]:checked').val();
			if (fixed_display == 'bottom-right') {
				$('input[name="back_to_the_top_options[fixed-top]"], input[name="back_to_the_top_options[fixed-left]"]').attr('disabled', 'disabled');
				$('input[name="back_to_the_top_options[fixed-bottom]"], input[name="back_to_the_top_options[fixed-right]"]').removeAttr('disabled');
			}
			else if (fixed_display == 'bottom-left') {
				$('input[name="back_to_the_top_options[fixed-top]"], input[name="back_to_the_top_options[fixed-right]"]').attr('disabled', 'disabled');
				$('input[name="back_to_the_top_options[fixed-bottom]"], input[name="back_to_the_top_options[fixed-left]"]').removeAttr('disabled');
			}
			else if (fixed_display == 'top-right') {
				$('input[name="back_to_the_top_options[fixed-bottom]"], input[name="back_to_the_top_options[fixed-left]"]').attr('disabled', 'disabled');
				$('input[name="back_to_the_top_options[fixed-top]"], input[name="back_to_the_top_options[fixed-right]"]').removeAttr('disabled');
			}
			else if (fixed_display == 'top-left') {
				$('input[name="back_to_the_top_options[fixed-bottom]"], input[name="back_to_the_top_options[fixed-right]"]').attr('disabled', 'disabled');
				$('input[name="back_to_the_top_options[fixed-top]"], input[name="back_to_the_top_options[fixed-left]"]').removeAttr('disabled');
			}

		}

		$('input[name="back_to_the_top_options[label]"]').on( 'change', build_html );
		$('input[name="back_to_the_top_options[font-size]"]').on( 'change', build_html );
		$('input[name="back_to_the_top_options[font-weight]"]').on( 'change', build_html );
		$('input[name="back_to_the_top_options[font-color]"]').on( 'change', build_html );
		$('input[name="back_to_the_top_options[font-hover-color]"]').on( 'change', build_html );
		$('textarea[name="back_to_the_top_options[custom-css]"]').on( 'change', build_html );
		$('input[name="back_to_the_top_options[fixed-display]"]').on( 'change', fixed_display );

		$('input[name="back_to_the_top_options[font-color]"]').wpColorPicker({
			change: function(event, ui) {
				$('a#backtothetop-fixed').css( 'color', ui.color.toString() );
			}
		});

		$('input[name="back_to_the_top_options[font-hover-color]"]').wpColorPicker({
			// change: function(event, ui) {
			// 	alert(ui.color.toString());
			// 	$('a#backtothetop-fixed:hover').css( 'color', ui.color.toString() );
			// }
		});

		build_html();
		fixed_display();
	});

} )( jQuery );
