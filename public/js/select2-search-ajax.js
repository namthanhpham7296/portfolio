function select2Search(domeHtml, url, displayField, valueField, extra){

	return $(domeHtml).select2({
		theme: "classic",
		ajax: {
			url: url,
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {

				var queryParameters = {
					q: params.term,
					extra: extra
				};
				return queryParameters;
			},

			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item[displayField],
							id: item[valueField]
						}
					})
				};
			},
			cache: false
		},
	});
}

function select2SearchModal(domeHtml, url, displayField, valueField, extra, modal){

    return $(domeHtml).select2({
        theme: "classic",
        dropdownParent: modal,
        // tags: true,
        ajax: {
            url: url,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {

                var queryParameters = {
                    q: params.term,
                    extra: extra
                };
                return queryParameters;
            },

            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item[displayField],
                            id: item[valueField]
                        }
                    })
                };
            },
            cache: false
        },
    });
}

function select2SearchCountry(domeHtml, url, displayField, valueField, extra, ajaxCallback){
	return $(domeHtml).select2({
		theme: "classic",
		ajax: {
			url: url,
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {

				var queryParameters = {
					q: params.term,
					extra: extra
				};
				return queryParameters;
			},

			processResults: function (data) {
				ajaxCallback && ajaxCallback(data);
				return {
					results: $.map(data, function (item) {
						return {
							text: item[displayField],
							id: item[valueField]
						}
					})
				};
			},
			cache: false
		},
		//escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 0,

	});
}

function select2SearchValueLarge(domeHtml, url, displayField, valueField, extra, minimumInputLength){
	return $(domeHtml).select2({
		theme: "classic",
		ajax: {
			url: url,
			type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {

				var queryParameters = {
					q: params.term,
					extra: extra
				};
				return queryParameters;
			},

			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item[displayField],
							id: item[valueField]
						}
					})
				};
			},
			cache: false
		},
		//escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: minimumInputLength,
	});
}















