import { useState } from './hooks/useState.js';

function count(id, setState, state) {
	return document.querySelector(id).addEventListener('click', () => {
		setState(state() + 1);
	});
}

export function Comoponent1(parent) {
	const [state, setState] = useState(0, parent);
	parent.innerHTML = state();
	const child = document.createElement('button');
	child.innerHTML = '+';
	child.style.display = '80px';
	child.id = 'btn-1';
	document.getElementById('button-container').appendChild(child);

	count('btn-1', setState, state);
}

export function Component2(parent) {
	const [state, setState] = useState(0, parent);
	parent.innerHTML = state();
}
