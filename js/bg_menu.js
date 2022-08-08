window.addEventListener('load', e => {
	// Prevent auto-collapsing
	ZABBIX.MenuMain.collapseExpanded = function(from_level) {
		return(false);
	}

	// Store expanded menu item in profiles table
	function updateBGMenuUserProfile(idx, value, idx2) {
		return sendAjaxData('zabbix.php?action=bgmenuprofile.update', {
			data: { 
				idx: idx,
				'value_int': value,
				idx2: idx2
			}
		});
	}

	// Get all expanded menu items from profiles table
	// Make them expaned directly in HTML by adding 'is-expanded' class
	function getBGMenuUserProfile(main_menu) {
		var url = new Curl('zabbix.php?action=bgmenuprofile.get');
		url.setArgument('output', 'ajax');
		jQuery.ajax({
			type: 'post',
			url: url.getUrl(),
			data: {},
			success: function(resp) {
				for (var el of main_menu[0].childNodes) {
					if (resp.indexOf('web.bgmenu.'+el.id) != -1) {
						el.classList.add('is-expanded');
					}
				}
			}
		});
	}

	// Add our own events
	function bg_expand (e) {
		// Add menu item id to profiles table (i.e. marking it as 'expanded')
		updateBGMenuUserProfile('web.bgmenu.'+e.target.id, 0, [0]);
	}
	function bg_collapse (e) {
		// Remote menu item is from profiles table (i.e. marking it as 'collapsed')
		updateBGMenuUserProfile('web.bgmenu.'+e.target.id, 1, [0]);
	}
	for (const item of ZABBIX.MenuMain._items) {
		if (item.hasSubmenu()) {
			item.on(MENUITEM_EVENT_EXPAND, bg_expand);
			item.on(MENUITEM_EVENT_COLLAPSE, bg_collapse);
		}
	}

	// Get main menu into the variable
	var main_menu = document.getElementsByClassName('menu-main');
	// Expand all menu items that were expanded before the last page reload
	getBGMenuUserProfile(main_menu);
});
