'use strict';
class bsTemplate{

	constructor(prelimiter, delimiter){

		this.prelimiter = typeof prelimiter !== "undefined" ? prelimiter : "{{";
		this.delimiter = typeof delimiter !== "undefined" ? delimiter : "}}";

		//todo: create this.regex from argument list instead of using var regex in parse().

	}

	parse(html, data){

		// var string = html.outerHTML;

		var string = html;

		console.log(string);
		var regex = /{{([^}}]+)?}}/g;
		var match = string.match(regex);

		// for(let i = 0; i < match.length; i++){
			for(var key in data){
				string = string.replace(regex, function(matched, text, urlId){
					if(key === text){
						return data[key];
					} else {
						return matched;
					}
				});
			}
		// }

		return string;
	}
}