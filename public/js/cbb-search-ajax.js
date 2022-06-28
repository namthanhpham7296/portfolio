function comboboxSearchAjax(domeHtml, url, displayField, value, params){
	params = params || {};
	params.q =  "{{{q}}}";
	var options = {
		requestDelay: 1000,
		ajax: {
			url: url,
			type: "POST",
			dataType: "json",
			// Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
			// automatically replace it with the value of the search query.

			data: params
		},
		locale: {
			emptyTitle: "Vui lòng gõ từ khóa"
		},
		log: 3,
		preprocessData: function(data) {

			var list = data;
			var i,
				l = list.length,
				array = [];
			if (l) {
				for (i = 0; i < l; i++) {
					array.push(
						$.extend(true, data[i], {
							text: list[i][displayField],
							value: list[i][value]

						})
					);
				}
			}
			// You must always return a valid array when processing data. The
			// data argument passed is a clone and cannot be modified directly.
			return array;
		}
	};

	$(domeHtml)
		.selectpicker({
			liveSearch: true,
			size: 5
		})
		.filter(".with-ajax")
		.ajaxSelectPicker(options);

	$(domeHtml).trigger("change");
}




