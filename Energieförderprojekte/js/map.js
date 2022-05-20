var map = new L.Map("map", {center: [47.535, 9.075], zoom: 11})
//start of the map

map.options.minZoom = 11;
map.options.maxZoom = 11;
//zoom per doubleclick


var svg = d3.select(map.getPanes().overlayPane).append("svg"),
    g = svg.append("g").attr("class", "leaflet-zoom-hide");


var gemeinden = ["Aadorf", "Affeltrangen", "Altnau", "Amlikon-Bissegg", "Amriswil", "Arbon", "Basadingen-Schlattingen", "Berg (TG)", "Berlingen", "Bettwiesen", "Bichelsee-Balterswil", "Birwinken", "Bischofszell", "Bottighofen", "Braunau", "Bürglen (TG)", "Bussnang", "Diessenhofen", "Dozwil", "Egnach", "Erlen", "Ermatingen", "Eschenz", "Eschlikon", "Felben-Wellhausen", "Fischingen", "Frauenfeld", "Gachnang", "Gottlieben", "Güttingen", "Hauptwil-Gottshaus", "Hefenhofen", "Herdern", "Hohentannen", "Homburg", "Horn", "Hüttlingen", "Hüttwilen", "Kemmental", "Kesswil", "Kradolf-Schönenberg", "Kreuzlingen", "Langrickenbach", "Lengwil", "Lommis", "Mammern", "Märstetten", "Matzingen", "Müllheim", "Münchwilen (TG)", "Münsterlingen", "Neunforn", "Pfyn", "Raperswilen", "Rickenbach (TG)", "Roggwil (TG)", "Romanshorn", "Salenstein", "Salmsach", "Schlatt (TG)", "Schönholzerswilen", "Sirnach", "Sommeri", "Steckborn", "Stettfurt", "Sulgen", "Tägerwilen", "Thundorf", "Tobel-Tägerschen", "Uesslingen-Buch", "Uttwil", "Wagenhausen", "Wäldi", "Wängi", "Warth-Weiningen", "Weinfelden", "Wigoltingen", "Wilen (TG)", "Wuppenau", "Zihlschlacht-Sitterdorf"];

var tip = d3.tip()
    .attr('class', 'd3-tip')

    .offset([25, 0])
    .html(function(d) {
        console.log(d);
		var gem = d.properties.name;
		var temp = 0;
		for (var i = 0; i < gem_array.length; i++){
			if (gem == gemeinden[i]){
				temp = i;
				continue;
			}
		}
        return "<strong>Gemeinde:</strong> <span> " + d.properties.name + "<br>" + "Totalanzahl: " + data_array[temp] + "</span>"; //hier kann totalanzahl eingefügt werden
    })


svg.call(tip);
svg.style('fill-opacity', 0.4)

d3.json("json/tg-municipalities.json", function(error, tg) {
    if (error) throw error;

    function projectPoint(x, y) {
        var point = map.latLngToLayerPoint(new L.LatLng(y, x));
        this.stream.point(point.x, point.y);
    }

    tg = topojson.feature(tg, tg.objects.municipalities);
    var transform = d3.geo.transform({point: projectPoint}),
        path = d3.geo.path().projection(transform);

    var feature = g.selectAll("path")
        .data(tg.features)
        .enter().append("path")
        .on('click', tip.show)
        .on('', tip.hide);


//einzelne gemeinden werden farbig
    svg.selectAll('path')
        .style('fill', function(d) {
	    return "lightgreen";
	})



    map.on("zoom", reset);
    reset();

    function reset() {
        var bounds = path.bounds(tg),
            topLeft = bounds[0],
            bottomRight = bounds[1];

        svg.attr("width", bottomRight[0] - topLeft[0])
            .attr("height", bottomRight[1] - topLeft[1])
            .style("left", topLeft[0] + "px")
            .style("top", topLeft[1] + "px");

        g.attr("transform", "translate(" + ( -topLeft[0]) + "," + ( -topLeft[1]) + ")");

        feature.attr("d", path);
    }
});