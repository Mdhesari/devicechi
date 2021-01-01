jQuery(function($) {
	$.widget.bridge('uibutton', $.ui.button)
})

function formatMoney(amount, decimalCount = 0, decimal = '.', thousands = ',') {
	decimalCount = Math.abs(decimalCount)
	decimalCount = isNaN(decimalCount) ? 0 : decimalCount

	const negativeSign = amount < 0 ? '-' : ''

	let i = parseInt(
		(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount))
	).toString()
	let j = i.length > 3 ? i.length % 3 : 0

	return (
		negativeSign +
		(j ? i.substr(0, j) + thousands : '') +
		i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands) +
		(decimalCount
			? decimal +
			  Math.abs(amount - i)
					.toFixed(decimalCount)
					.slice(2)
			: '')
	)
}

function formatPrice(price, dec) {
	if (price.length < 1) return price

	return (price = Math.abs(price).toFixed(dec || 0))
}

function calcPrice(price) {
	if (isNaN(price)) return null

	if (Number(price) > 0) {
		price = formatPrice(price)

		let result = formatMoney(price) + ' تومان'

		return result
	}

	return false
}
