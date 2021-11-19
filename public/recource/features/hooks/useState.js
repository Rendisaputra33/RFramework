export const useState = (init, parent) => {
	let state = init;

	const getState = () => {
		return state ? state : init;
	};

	const setState = val => {
		state = val;
		parent.innerHTML = val;
	};

	return [getState, setState];
};
