var ca_gridview = {
		// Set cookie
		set_cookie: function (c_name, value, expiredays) {
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + expiredays);
			document.cookie = c_name + "=" + escape(value) + ((expiredays === null) ? "" : ";expires=" + exdate.toUTCString());
		},

		// Return cookie value
		get_cookie: function (c_name) {
			var c_start = '',
				c_end = '';
			if (document.cookie.length > 0) {
				c_start = document.cookie.indexOf(c_name + "=");
				if (c_start !== -1) {
					c_start = c_start + c_name.length + 1;
					c_end = document.cookie.indexOf(";", c_start);
					if (c_end === -1){
						c_end = document.cookie.length;
					}
					return unescape(document.cookie.substring(c_start, c_end));
				}
			}
			return "";
		},

		// Check existance of cookie
		chk_cookie: function (c_name) {
			var value = ca_gridview.get_cookie(c_name);
			if (value !== null && value !== "") {
				return true;
			} else {
				return false;
			}
		},

		// Make sure if user hides search, let it remain hidden
		_set_user_settings: function () {
			var value = ca_gridview.get_cookie('ca_filter');

			if (value !== null && value !== '') {
				if (value === 'hide') {
					$('ca_filter_button').className = 'ca_filter_unhide';
					$('ca_filter_button').innerHTML = "Search";
					$('ca_filter').hide();
				} else if (value === 'unhide') {
					$('ca_filter_button').className = 'ca_filter_hide';
					$('ca_filter_button').innerHTML = "&nbsp;";
					$('ca_filter').show();
				}
			}
		},

		// All the page links and ordering links of grid should submit the form
		_page_link_submit: function (anchor) {
			Event.observe($(anchor), 'click', function (event) {
				// Cancel click event and replace it with submit button event
				Event.stop(event);

				$('frm_ca_gridview').action = $(anchor).href;
				$('frm_ca_gridview').submit();
			});
		},

		// Track event handlers
		_event_handlers: function () {
			// Observe search button
			if ($('btn_srch') !== null) {
				Event.observe($('btn_srch'), 'click', function (event) {
					$('frm_ca_gridview').action = $('flt_action').value;
					$('frm_ca_gridview').submit();
				});
			}

			// Observe reset search button
			if ($('btn_srch_reset') !== null) {
				Event.observe($('btn_srch_reset'), 'click', function (event) {
					$('ca_filter').select('input, select').each(function (n) {
						if (n.type !== 'button') {
							$(n).setValue('');
						}
					});
					$('frm_ca_gridview').submit();
				});
			}

			// Observe anchor links button
			$$('.pagenavi').each(function (n) {
				$(n).select('a').each(function (a) {
					ca_gridview._page_link_submit(a);
				});
			});

			$$('.ca_gridview_ordering').each(function (a) {
				ca_gridview._page_link_submit(a);
			});

			// Observe save button
			Event.observe(document.frm_ca_gridview, 'click', function (event) {
				var elt = Event.element(event);

				if ('A' === elt.tagName) {
					var str = elt.href;
					str.sub(/save_.*/, function (match) {
						var field = match[0].substr(5);
						$('primary_key').value = $('primary_key_' + field).value;
						$('table_name').value = $('table_name_' + field).value;
						$('field').value = field;
						$('frm_ca_gridview').action += "/save/enable";
						$('frm_ca_gridview').submit();
					});
				}
			});

			// Observe click all checkbox
			if ($('ca_checkall') !== null) {
				Event.observe($('ca_checkall'), 'click', function (event) {
					var elt = Event.element(event);
					if (elt.checked === true) {
						$$('#ca_checkbox').each(function (box) {
							box.checked = true;
						});
					} else {
						$$('#ca_checkbox').each(function (box) {
							box.checked = false;
						});
					}
				});
			}

			// Observe filter hide and unhide, user's setting saved as cookie
			if ($('ca_filter_button') !== null) {
				Event.observe($('ca_filter_button'), 'click', function (event) {
					$('ca_filter').toggle();
					if ($('ca_filter_button').hasClassName('ca_filter_hide')) {
						$('ca_filter_button').className = 'ca_filter_unhide';
						$('ca_filter_button').innerHTML = "Search";
						ca_gridview.set_cookie('ca_filter', 'hide');
					} else {
						$('ca_filter_button').className = 'ca_filter_hide';
						$('ca_filter_button').innerHTML = "&nbsp;";
						ca_gridview.set_cookie('ca_filter', 'unhide');
					}
				});
			}
		},

		init: function () {
			// Check for cooking and user setting
			ca_gridview._set_user_settings();
			ca_gridview._event_handlers();
		}
	};

document.observe("dom:loaded", function () {
	// Initalize grid view
	ca_gridview.init();
});