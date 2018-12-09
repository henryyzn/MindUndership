var FLAGS = {
    elo: {
        regexpBin: /^401178|^401179|^431274|^438935|^451416|^457393|^457631|^457632|^504175|^627780|^636297|^636368|^(506699|5067[0-6]\d|50677[0-8])|^(50900\d|5090[1-9]\d|509[1-9]\d{2})|^65003[1-3]|^(65003[5-9]|65004\d|65005[0-1])|^(65040[5-9]|6504[1-3]\d)|^(65048[5-9]|65049\d|6505[0-2]\d|65053     [0-8])|^(65054[1-9]|6505[5-8]\d|65059[0-8])|^(65070\d|65071[0-8])|^65072[0-7]|^(65090[1-9]|65091\d|650920)|^(65165[2-9]|6516[6-7]\d)|^(65500\d|65501\d)|^(65502[1-9]|6550[3-4]\d|65505[0-8])/,
        regexpFull: /^(401178|401179|431274|438935|451416|457393|457631|457632|504175|627780|636297|636368|(506699|5067[0-6]\d|50677[0-8])|(50900\d|5090[1-9]\d|509[1-9]\d{2})|65003[1-3]|(65003[5-9]|65004\d|65005[0-1])|(65040[5-9]|6504[1-3]\d)|(65048[5-9]|65049\d|6505[0-2]\d|65053[0-8])|(65054[1-9]| 6505[5-8]\d|65059[0-8])|(65070\d|65071[0-8])|65072[0-7]|(65090[1-9]|65091\d|650920)|(65165[2-9]|6516[6-7]\d)|(65500\d|65501\d)|(65502[1-9]|6550[3-4]\d|65505[0-8]))[0-9]{10,12}/,
        image: "assets/images/cards/elo.png"
    },

    discover: {
        regexpBin: /^6(?:011|5[0-9]{2})/,
        regexpFull: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
        image: "assets/images/cards/discover.png"
    },

    hipercard: {
        regexpBin: /^3841[046]0|^60/,
        regexpFull: /^(38[0-9]{17}|60[0-9]{14})$/,
        image: "assets/images/cards/hipercard.png"
    },

    diners: {
        regexpBin: /^3(?:0[0-5]|[68][0-9])/,
        regexpFull: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
        image: "assets/images/cards/diners.png",
        mask: "0000 000000 0000"
    },

    jcb: {
        regexpBin: /^(?:2131|1800|35\d{3})/,
        regexpFull: /^(?:2131|1800|35\d{3})\d{11}$/,
        image: "assets/images/cards/jcb.png"
    },

    aura: {
        regexpBin: /^50[0-9]/,
        regexpFull: /^50[0-9]{14,17}$/,
        image: "assets/images/cards/aura.png",
        mask: "000000 0000000000 000"
    },

    amex: {
        regexpBin: /^3[47]/,
        regexpFull: /^3[47][0-9]{13}$/,
        regexpCvv: /^\d{3,4}$/,
        image: "assets/images/cards/amex.png",
        mask: "0000 000000 00000",
        maskCvv: "000Z"
    },

    mastercard: {
        regexpBin: /^5[1-5]|^2(2(2[1-9]|[3-9])|[3-6]|7([01]|20))/,
        regexpFull: /^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/,
        image: "assets/images/cards/mastercard.png"
    },

    visa: {
        regexpBin: /^4/,
        regexpFull: /^4[0-9]{12}(?:[0-9]{3})?$/,
        image: "assets/images/cards/visa.png"
    },

    "default": {
        regexpBin: /^.*/,
        regexpFull: /^.*/,
        image: "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=",
        regexpCvv: /^\d{3}$/,
        mask: "0000 0000 0000 0000",
        maskCvv: "000",
        invalid: true
    }
};

var CardValidator = {
 	validateBin: function(card, num) {
    	return card.regexpBin.test(Number(num));
    },

 	validateCard: function(card, num) {
    	return card.regexpFull.test(Number(num));
    },

    checkFlag: function(num) {
		for (var flag in FLAGS) {
			if (CardValidator.validateBin(FLAGS[flag], num)) {
				return FLAGS[flag];
			}
		}

 		return FLAGS.default;
	},

 	checkFullCard: function(num) {
		for (var flag in FLAGS) {
			if (CardValidator.validateCard(FLAGS[flag], num)) {
				return true;
			}
		}

 		return false;
	}
};

$(document).ready(function() {
    var cardInstance = $("[data-card-form]");
    var cardContainer = $("[data-card-container]");

    function updateDate() {
        var month = ("0" + cardInstance.find("[data-card-month]").val()).slice(-2);
        var year = cardInstance.find("[data-card-year]").val() % 1000;
        cardContainer.find("#card-expiration+p").text(month + "/" + year);
    }

    cardInstance.find("[data-card-number]").mask(FLAGS.default.mask);
    cardInstance.find("[data-card-code]").mask(FLAGS.default.maskCvv, {translation:  {Z: {pattern: /[0-9]/, optional: true}}});
    updateDate();

    cardInstance.find("[data-card-number], [data-card-holder], [data-card-month], [data-card-year]").on("focus", function() {
        cardContainer.removeClass("flipped");
    });

    cardInstance.find("[data-card-code]").on("focus", function() {
        cardContainer.addClass("flipped");
    });

    cardInstance.find("[data-card-number]").on("input", function() {
        var flag = CardValidator.checkFlag($(this).cleanVal());
        cardContainer.find(".flag").attr("src", flag.image || FLAGS.default.image);

        var value = $(this).mask(flag.mask || FLAGS.default.mask).masked($(this).val());
        cardContainer.find("#card-number-p").text(value || "0123 4567 8910 1112");

        cardInstance.find("[data-card-code]").mask(flag.maskCvv || FLAGS.default.maskCvv, {translation:  {Z: {pattern: /[0-9]/, optional: true}}});
    });

    cardInstance.find("[data-card-holder]").on("input", function() {
        cardContainer.find("#card-cardholder-name+p, .security-column-one>span").text($(this).val() || "João F. Silva");
    });

    cardInstance.find("[data-card-code]").on("input", function() {
        cardContainer.find(".security-column-two>span").text($(this).val() || "687");
    });

    cardInstance.find("[data-card-month], [data-card-year]").on("change", function() {
        updateDate();
    });
});
