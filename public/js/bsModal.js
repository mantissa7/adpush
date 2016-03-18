'use strict';
class bsModal {
	constructor(ids, options){
		//ids = array
		//options = object

		
		this.options = options;

		if(options.dev){
			this.dev = true;
		}else {
			this.dev = false;
		}

		this._parse();
	}

	_parse(){
		//parse all data-bsmodal tags and add event listeners and link to popup div

		//void
	}

	_create(id){
		var shadow = document.createElement('div');
		shadow.classList.add("bsmodal-shadow");

		shadow.addEventListener('click', function(e){
			e.stopPropagation();
			shadow.parentElement.removeChild(this);
			console.log("shadow");
			return false;
		});

		var div = document.createElement("div");
		div.id = "bsmodal-"+id;
		div.classList.add("bsmodal");

		div.addEventListener('click', function(e){
			e.stopPropagation();
			return false;
		});

		shadow.appendChild(div);
		document.body.appendChild(shadow);
	}

	open(id, options){
		//open specific div by id

		var prefix = "bsmodal-";

		//check if modal has been registered, else create it
		if(!document.getElementById(prefix+id))
			this._create(id);


		//add content
		var content = null;

		switch(options.type){
			case "ajax": 
				content = this.open_url(options.url);
				break;
			case "div":
				content = this.open_div(options.id);
				break;
			case "inline": 
				content = this.open_inline(id);
				break;

		}

		//get element
		var el = document.getElementById(prefix+id);

		//set content
		if(content){
			var parser = new bsTemplate();
			var parser = parser.parse(content.innerHTML, options.data);

			el.innerHTML = parser;
		} else {
			if(this.dev){
				console.log("No content, is this intentional?");
			}
		}
		
		//show element
		el.classList.add("show");

		//void
	}

	close(id){
		if(id === 'all'){}
	}

	open_url(id){}

	open_div(id){
		var div = document.getElementById(id);

		return div;

	}

	open_inline(id){}
}