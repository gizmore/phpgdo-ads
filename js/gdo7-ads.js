"use strict";
window.GDO = window.GDO||{};
window.GDO.Ads = {};
window.GDO.Ads.cycle = function() {
	console.log('Ads.cycle()');
};
setTimeout(window.GDO.Ads.cycle, 30000);
