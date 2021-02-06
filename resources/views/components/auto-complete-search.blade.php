<div class="auto-complete box w-100">
    <select @if(!$single) multiple @endif class="form-control" name="{{ $name }}" id="{{ $id }}">
        {{-- @foreach ($options as $option)

		@php
		$value = $option->getOptionValue();
		$text = $option->getOptionText();
		@endphp

		<option @if(in_array($value, $defaults)) selected @endif value="{{ $value }}">
        {{ $text }}
        </option>

        @endforeach --}}
    </select>

</div>

@push('add_scripts')

<script>
    $(function() {

		const selectId = '#{{ $id }}',
		route = '{{ $route }}',
		placeholder = '{{ __(" Select an option... ") }}',
		ignore = @json($ignore)

		$(selectId).select2({
			allowClear: true,
			placeholder,
			ajax: {
				url: route,
				dataType: 'json',
				delay: 1000,
				data: function (params) {
    	  		var query = {
    	  		  search: params.term,
    	  		  page: params.page || 1,
				  ignore
    	  		}

    	  		// Query parameters will be ?search=[term]&page=[page]
    	  		return query;
    		}
		},
		// debug: true,
		// dir: "rtl",

	});

	// const keyCodes = {
	// 		enter: 13,
	// 		arrowUp: 38,
	// 		arrowDown: 40
	// 	},
    //     searchInputId = '#{{ $id }}',
    //     defaults = @json($defaults),
    //     ignore_more = @json($ignore),
	// 	searchInput = $(searchInputId),
	// 	listWrapper = $('#list-wrapper'),
	// 	formSelect = $('#form-select'),
	// 	isSingle = Boolean("{{ $single }}")

	// load_selected_entries(defaults)

	// searchInput.on('keyup focus', filter_search_items)

	// listWrapper.on('click', '.list-group-item', add_item)

	// $(document).on('click', '.btn-select', function() {

    //     $this = $(this)

    //     $('#' + $this.data('option')).remove()

	// 	$this.remove()

	// 	if(isSingle && !select_form_has_options()) {
	// 		searchInput.attr('disabled', false)
	// 		reset_search()
	// 	}
	// })

	// $(document).on('click', function() {
	// 	reset_search()
	// })

	// $(document).on('submit keydown', 'form', function(ev) {
	// 	if (ev.key == 'Enter') return false
	// })

	// // $(document).on('blur', searchInputId,function() {
	// // 	reset_search()
	// // })

	// function load_selected_entries(selected_arr) {
	// 	if (!selected_arr || selected_arr.length < 1) return

	// 	$.ajax({
	// 		url: '{{ $route }}',
	// 		method: 'GET',
	// 		data: {
	// 			selected_arr
	// 		},
	// 		success: (response) => {
	// 			response.forEach((item) => {
	// 				add_select_option(item.id, item[item.key])
	// 			})
	// 		}
	// 	})
	// }

	// function filter_search_items(ev) {
	// 	const list_group = $('#list-wrapper .list-group'),
	// 		currentKeyCode = ev.keyCode

	// 	if (
	// 		currentKeyCode == keyCodes.arrowDown ||
	// 		currentKeyCode == keyCodes.arrowUp
	// 	) {
	// 		let active_tab = list_group.find('.active')

	// 		if (active_tab.length < 1) {
	// 			list_group
	// 				.children()
	// 				.first()
	// 				.addClass('active')
	// 		} else {
	// 			if (currentKeyCode == keyCodes.arrowDown)
	// 				active_tab
	// 					.removeClass('active')
	// 					.next()
	// 					.addClass('active')
	// 			else
	// 				active_tab
	// 					.removeClass('active')
	// 					.prev()
	// 					.addClass('active')
	// 		}

	// 		return 0
	// 	}

	// 	if (currentKeyCode == keyCodes.enter) {
	// 		let active_tab = list_group.find('.active')

	// 		if (active_tab.length > 0) {
	// 			add_item(active_tab[0])
	// 		}
	// 	}

	// 	setTimeout(search_request, 1000)
	// }

	// function add_item(el) {
	// 	let $this = null

	// 	if (el.dataset?.value) $this = $(el)
	// 	else $this = $(el.target)

	// 	if (!$this) return

	// 	add_select_option($this.data('value'), $this.text())

	// 	$this.remove()
	// }

	// function reset_search() {
	// 	listWrapper.html('')
	// 	listWrapper.fadeOut()
	// }

	// function add_select_option(value, name) {
	// 	const option_id = 'option_' + value,
	// 	 option = document.createElement('option')
	// 	option.value = value
	// 	option.id = option_id
	// 	option.selected = true

	// 	formSelect.append(option)

	// 	var button = document.createElement('button')
	// 	button.classList = 'm-2 btn btn-info btn-select'
	// 	button.dataset.option = option_id
	// 	button.innerHTML = `<i class="fa fa-close"></i> ${name}`
	// 	$('#selected-view').append(button)

	// 	if(select_form_has_options() && isSingle) {

	// 		searchInput.attr('disabled', true)
	// 	}
	// }

	// function select_form_has_options() {
	// 	reset_search()
	// return formSelect.find("option").length > 0
	// }

	// function search_request() {
	// 	var query = searchInput.val()
	// 	var _token = $('input[name="_token"]').val()

	// 	ignore = []

	// 	current = Array.from($('#form-select option'))

	// 	current.forEach((item) => {
	// 		ignore.push(item.value)
	// 	})

	// 	ignore = ignore.concat(ignore_more)

	// 	$.ajax({
	// 		url: '{{ $route }}',
	// 		method: 'GET',
	// 		data: {
	// 			ignore: ignore,
	// 			query: query
	// 		},
	// 		success: search_success_handler
	// 	})
	// }

	// function search_success_handler(data) {
	// 	listWrapper.html('')

	// 	listWrapper.fadeIn()

	// 	var ul = document.createElement('ul')
	// 	ul.classList.add('list-group')
	// 	ul.classList.add('bg-white')
	// 	ul.classList.add('list-group-auto-complete')

	// 	listWrapper.append(ul)

	// 	data.forEach(function(datum) {
	// 		var li = document.createElement('li')
	// 		li.classList.add('list-group-item')
	// 		li.style.backgroundColor = 'transparent'
	// 		key = datum.key
	// 		li.innerHTML = datum[key] // key => modle appends key
	// 		li.dataset.value = datum.id
	// 		ul.append(li)
	// 	})
	// }
})

</script>

@endpush