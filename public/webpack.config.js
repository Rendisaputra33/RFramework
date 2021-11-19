const path = require('path');

module.exports = {
	watch: true,
	mode: 'production',
	entry: ['./recource/app.js'],
	output: {
		path: path.resolve(__dirname, 'recource'),
		filename: 'main.chunk.js',
	},
	module: {
		rules: [
			{
				test: /\.m?js$/,
				exclude: path.resolve(__dirname, 'node_modules'),
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'],
					},
				},
			},
		],
	},
};
