var observer = new MutationObserver(function (mutations) {
    for (var i = 0; mutations[i]; ++i) {
        if (mutations[i].addedNodes[0].nodeName == "SCRIPT" && mutations[i].addedNodes[0].src.match(/\/AuthenticationService.Authenticate?/g)) {
            var str = mutations[i].addedNodes[0].src.match(/[?&]callback=.*[&$]/g);
            if (str) {
                if (str[0][str[0].length - 1] == "&") {
                    str = str[0].substring(10, str[0].length - 1);
                } else {
                    str = str[0].substring(10);
                }

                var split = str.split(".");
                window[split[0]][split[1]] = null;
            }

            observer.disconnect();
        }
    }
});

observer.observe(document.head, { attributes: true, childList: true, characterData: true });

var lojas = [{
    id: 1,
    latitude: -23.5840569,
    longitude: -46.6749722,
    endereco: "Rua Joaquim Floriano",
    numero: "466",
    bairro: "Itaim Bibi",
    cep: "04534-002",
    cidade: "São Paulo",
    uf: "SP",
    telefone: "(11) 3074-0360",
    funcionamento: "De Segunda a Sábado das 10h00 ás 22h00<br />Domingos e feriados das 14h00 ás 21h00"
}, {
    id: 2,
    latitude: -23.648003,
    longitude: -46.532468,
    endereco: "Av. Industrial",
    numero: "600",
    bairro: "Centro",
    cep: "09080-500",
    cidade: "Santo André",
    uf: "SP",
    telefone: "(11) 4433-4230",
    funcionamento: "De Segunda a Sexta das 8h00 ás 20h00"
}, {
    id: 3,
    latitude: -21.182487,
    longitude: -47.808207,
    endereco: "Rua São José",
    numero: "933",
    bairro: "Higienópolis",
    cep: "14010-160",
    cidade: "Ribeirão Preto",
    uf: "SP",
    telefone: "(16) 3519-3730",
    funcionamento: "De Segunda a Sábado das 10h00 às 22h00<br>Domingos e feriados das 14h00 às 20h00"
}];

$(document).ready(function () {
    var map = new google.maps.Map($("#map-canvas").get(0), {
        center: new google.maps.LatLng(-23.5840569, -46.6749722),
        zoom: 5
    });

    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(400, 200)
    });

    $(lojas).each(function () {
        var loja = this;
        loja.marker = new google.maps.Marker({
            position: { lat: loja.latitude, lng: loja.longitude },
            map: map,
            title: "Loja"
        });

        google.maps.event.addListener(loja.marker, "click", function () {
            map.setCenter(loja.marker.position);
            map.setZoom(15);

            var html = $("<div>").addClass("map-info");

            $("<h3>").text("Food 4FIT").appendTo(html);

            $("<p>").append(loja.endereco).append(", ").append(loja.numero).append(" - ").append(loja.bairro).appendTo(html);

            $("<p>").append("CEP: ").append(loja.cep).append(" - ").append(loja.cidade).append(" - ").append(loja.uf).appendTo(html);

            $("<p>").append($("<span>").text("Telefone: ")).append(loja.telefone).appendTo(html);

            $("<span>").text("Horário de funcionamento: ").appendTo(html);

            $("<p>").append().append(loja.funcionamento).appendTo(html);

            infowindow.setContent(html.prop("outerHTML"));
            infowindow.open(map, this);
        });
    });

    $("[data-f4f-shop-view]").click(function () {
        var id = $(this).closest("[data-f4f-shop-id]").data("f4f-shop-id");
        var loja = lojas.find(function (loja) {
            return loja.id == id;
        });
        if (loja) {
            new google.maps.event.trigger(loja.marker, "click");
        }
    });
});
