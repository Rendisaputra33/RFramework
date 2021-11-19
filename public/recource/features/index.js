import { useState } from './hooks/useState.js';

export function Comoponent1(parent) {
	const [state, setState] = useState(0, parent);
	parent.innerHTML = state();
	const child = document.createElement('button');
	child.innerHTML = '+';
	child.style.width = '80px';
	child.id = 'btn-1';
	document.getElementById('button-container').appendChild(child);

	document.querySelector('#btn-1').addEventListener('click', () => {
		setState(state() + 1);
	});
}

export function Component2(parent) {
	const [state, setState] = useState(0, parent);
	parent.innerHTML = state();
}
