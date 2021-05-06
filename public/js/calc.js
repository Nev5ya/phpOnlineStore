class Calculator {
	constructor() {
		this._outputNode = document.querySelector('.calculator-output');
		this._buttonsNode = document.querySelector('.calculator-buttons');
		this._calcOutput = document.querySelector('.calculator-output_input');
		this._output = this._calcOutput.value;
		this._maxLengthOfInput = 20;

		// this._submitButton = document.getElementById('submit');
		// this._url = '/calculate';
		// this._form = document.getElementById('form');
	}

	init() {
		this._buttonsNode.addEventListener('click', e => this._eventHandler(e));
		// this._form.addEventListener('submit', e => {
		// 	e.preventDefault();
		// 	this._postData(e);
		// });
	}

	_eventHandler(event) {
		
		const eventText = event.target.textContent;

		if (eventText === '=' || eventText.length > 1) return;
		if(this._output.length > this._maxLengthOfInput) return;
		if(event.target.id === 'delete') { this._delete(); return; }

		const reg = new RegExp("[+\\-*\\/]", "g");

		this._output += eventText;
		if ((this._output.match(reg) || []).length > 1) {
			this._output = this._output.slice(0, this._output.length - 1);
		}
		this._render();
	}

	_delete() {
		this._output = this._calcOutput.value = this._outputNode.textContent = this._outputNode.textContent.slice(0,-1);
	}

	_render(){
		this._outputNode.textContent = this._output;
		this._calcOutput.value = this._output;
	}
}

(new Calculator).init();