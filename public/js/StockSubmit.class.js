'use strict';

class StockSubmit {

	constructor(data, options){

		var ajax = new XMLHttpRequest();

		var api = window.location.protocol+"//"+window.location.hostname+"/api/php/adpush/facebook/user/StockSubmit";

		console.log(api);

		ajax.open("POST", api);
		ajax.onload = function(e){
			if(ajax.status !== 200) return;

console.log(ajax.responseText);
			return ajax.responseText;
		}
		ajax.send(data);
	}

}