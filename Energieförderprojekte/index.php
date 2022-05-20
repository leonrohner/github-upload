<!doctype html>
<!--
    Created on : 04/26/2021
    Author     : jpmou
-->

<html lang="de">

<head>

    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Bootstrap V4.6.0 Template für IMS Frauenfeld" name="description">
    <meta content="Jean-Pierre Mouret" name="author">

    <!-- Title -->
    <title>Energieförderprojekte</title>

    <!-- Bootstrap CSS by CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/Page14.css">
    <!-- Custom CSS -->

    <!-- Favicons created with realfavicongenerator.net -->
    <link href="favicons/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="favicons/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="favicons/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
    <link href="favicons/site.webmanifest" rel="manifest">
    <link color="#5bbad5" href="favicons/safari-pinned-tab.svg" rel="mask-icon">
    <link href="favicons/favicon.ico" rel="shortcut icon">
    <meta content="#2d89ef" name="msapplication-TileColor">
    <meta content="favicons/browserconfig.xml" name="msapplication-config">
    <meta content="#ffffff" name="theme-color">

    <meta name="viewport" content="width=650", user-scalable=yes">

    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
            integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
            crossorigin=""></script>
    <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="http://d3js.org/topojson.v1.min.js"></script>
    <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
 

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.2/leaflet.css" />

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js" integrity="sha512-SGWgwwRA8xZgEoKiex3UubkSkV1zSE1BS6O4pXcaxcNtUlQsOmOmhVnDwIvqGRfEmuz83tIGL13cXMZn6upPyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datasource@0.1.0"></script>
    <script type="text/javascript" src=https://www.gstatic.com/charts/loader.js></script>
    
    
</head>

<body>

    <main>  
        <header><h2><b>Energieförderprojekte des Kanton Thurgau (2008-2020)</b></h2></header>
    <nav></nav>
    <br><br>
    <div id="map"></div> <br><br>
    <script src="js/map.js"></script>
        <?php
        error_reporting(0);
        if (($handle = fopen("daten/daten.csv", "r")) !== FALSE) {
            # Set the parent multidimensional array key to 0.
            $nn = 0;
            $daten = "";
            
            while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
                # Erste Zeile überspringen
                if ($data[0] == 'jahr') {
                    continue;
                }
                # Count the total keys in the row.
                $c = count($data);
                # Populate the multidimensional array.
                for ($x = $c-1; $x < $c; $x++) {
                    $daten = $daten.$data[$x].";";
                    $gemeinde = $gemeinde.$data[$x-23].";";
                }
                $nn++;
            }
            # Close the File.
            fclose($handle);
            $data_array_raw = explode(";", $daten);
            $gemeinde_array_raw = explode(";", $gemeinde);
            $data_array = array();
            $gemeinde_array = array();
            for ($i = 0; $i < count($data_array_raw); $i += 13){
                array_push($data_array, $data_array_raw[$i] + $data_array_raw[$i+1] + $data_array_raw[$i+2] + $data_array_raw[$i+3] + $data_array_raw[$i+4] + $data_array_raw[$i+5] + $data_array_raw[$i+6] + $data_array_raw[$i+7] + $data_array_raw[$i+8] + $data_array_raw[$i+9] + $data_array_raw[$i+10] + $data_array_raw[$i+11] + $data_array_raw[$i+12]);
                array_push($gemeinde_array, $gemeinde_array_raw[$i]);
            }
            $data_string = implode(";", $data_array);
            $gem_string = implode(";", $gemeinde_array);
        }
        ?>
    
    

        <?php
            if (($handle2 = fopen("daten/daten2.csv", "r")) !== FALSE) {
                # Set the parent multidimensional array key to 0.
                $counter2 = 0;

                while (($data2 = fgetcsv($handle2, 10000, ",")) !== FALSE) {
                    # Erste Zeile überspringen
                    if ($data2[0] == 'jahr') {
                        continue;
                    }
                    # Count the total keys in the row.
                    $c2 = count($data2);
                    # Populate the multidimensional array.
                    for ($x2 = 0; $x2 < $c; $x2++) {
                        if ($x2 == 2) {
                            continue;
                        }
                        $csvarray2[$counter2][$x2] = (int) $data2[$x2];
                    }
                    $counter2++;
                }
                # Close the File.
                fclose($handle2);

        }
        ?>
        
    
       
    
        <script type="text/javascript" scr="js/map.js">var data_array = <?php echo json_encode(explode(";", $data_string));?></script>
        <script type="text/javascript" scr="js/map.js">var gem_array = <?php echo json_encode(explode(";", $gem_string));?>;</script>
        <script>var jsarray = <?php echo json_encode($csvarray2); ?>;</script>
        <script type="text/javascript">var totale_daten = <?php echo json_encode(explode(";", $daten)); ?>;</script>
        
        
            <a id="form"></a>
            <br><br><br>
            <form action="#form" method="GET">
                <select id="gemeinde" name="Gemeinden" value="<?php echo $_GET['Gemeinden']?>">
                    <option>Aadorf
                    </option>
                    <option>Affeltrangen
                    </option>
                    <option>Altnau
                    </option>
                    <option>Amlikon-Bissegg
                    </option>
                    <option>Amriswil
                    </option>
                    <option>Arbon
                    </option>
                    <option>Basadingen-Schlattingen
                    </option>
                    <option>Berg (TG)
                    </option>
                    <option>Berlingen
                    </option>
                    <option>Bettwiesen
                    </option>
                    <option>Bichelsee-Balterswil
                    </option>
                    <option>Birwinken
                    </option>
                    <option>Bischofszell
                    </option>
                    <option>Bottighofen
                    </option>
                    <option>Braunau
                    </option>
                    <option>Bürglen (TG)
                    </option>
                    <option>Bussnang
                    </option>
                    <option>Diessenhofen
                    </option>
                    <option>Dozwil
                    </option>
                    <option>Egnach
                    </option>
                    <option>Erlen
                    </option>
                    <option>Ermatingen
                    </option>
                    <option>Eschenz
                    </option>
                    <option>Eschlikon
                    </option>
                    <option>Felben-Wellhausen
                    </option>
                    <option>Fischingen
                    </option>
                    <option>Frauenfeld
                    </option>
                    <option>Gachnang
                    </option>
                    <option>Gottlieben
                    </option>
                    <option>Güttingen
                    </option>
                    <option>Hauptwil-Gottshaus
                    </option>
                    <option>Hefenhofen
                    </option>
                    <option>Herdern
                    </option>
                    <option>Hohentannen
                    </option>
                    <option>Homburg
                    </option>
                    <option>Horn
                    </option>
                    <option>Hüttlingen
                    </option>
                    <option>Hüttwilen
                    </option>
                    <option>Kemmental
                    </option>
                    <option>Kesswil
                    </option>
                    <option>Kradolf-Schönenberg
                    </option>
                    <option>Kreuzlingen
                    </option>
                    <option>Langrickenbach
                    </option>
                    <option>Lengwil
                    </option>
                    <option>Lommis
                    </option>
                    <option>Mammern
                    </option>
                    <option>Märstetten
                    </option>
                    <option>Matzingen
                    </option>
                    <option>Müllheim
                    </option>
                    <option>Münchwilen (TG)
                    </option>
                    <option>Münsterlingen
                    </option>
                    <option>Neunforn
                    </option>
                    <option>Pfyn
                    </option>
                    <option>Raperswilen
                    </option>
                    <option>Rickenbach (TG)
                    </option>
                    <option>Roggwil (TG)
                    </option>
                    <option>Romanshorn
                    </option>
                    <option>Salenstein
                    </option>
                    <option>Salmsach
                    </option>
                    <option>Schlatt (TG)
                    </option>
                    <option>Schönholzerswilen
                    </option>
                    <option>Sirnach
                    </option>
                    <option>Sommeri
                    </option>
                    <option>Steckborn
                    </option>
                    <option>Stettfurt
                    </option>
                    <option>Sulgen
                    </option>
                    <option>Tägerwilen
                    </option>
                    <option>Thundorf
                    </option>
                    <option>Tobel-Tägerschen
                    </option>
                    <option>Uesslingen-Buch
                    </option>
                    <option>Uttwil
                    </option>
                    <option>Wagenhausen
                    </option>
                    <option>Wäldi
                    </option>
                    <option>Wängi
                    </option>
                    <option>Warth-Weiningen
                    </option>
                    <option>Weinfelden
                    </option>
                    <option>Wigoltingen
                    </option>
                    <option>Wilen (TG)
                    </option>
                    <option>Wuppenau
                    </option>
                    <option>Zihlschlacht-Sitterdorf
                    </option>
                </select>

                <select id="jahr" name="Jahr">
                    <option>2008</option>
                    <option>2009</option>
                    <option>2010</option>
                    <option>2011</option>
                    <option>2012</option>
                    <option>2013</option>
                    <option>2014</option>
                    <option>2015</option>
                    <option>2016</option>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                </select>
                

                <input class="button_cakechart1" type="submit" value="Bestätigen"/>
            <script>
                function addedCart(){
                    $('form').submit(function(e){


                        $.ajax({ 
                            success:function(data){

                          },
                          error:function(err){
                              console.log(err);
                          }
                        });

                    });
                }; 
            </script>  
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
            
          
            <select class="dropdown_chart2_2"name="Jahr2">

                <option>2008</option>
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
            </select>

        
            <select class="dropdown_chart2_1"name="attribute">
                <option>Gebäudehülle</option> 
                <option>Geak Sanierung</option>
                <option>Minergie Sanierung</option> 
                <option>Minergie Neubau</option> 
                <option>Holz bis 70</option> 
                <option>Holz ab 70</option> 
                <option>Wärmepumpe</option> 
                <option>Wärmenetzanschluss</option>
                <option>Wärmenetzprojekt</option> 
                <option>Solarthermieanlage</option> 
                <option>Solarstromanlage</option> 
                <option>Batteriespeicher</option> 
                <option>Energieeffizienz</option>
                <option>Komfortlüftung</option> 
                <option>Elektrofahrzeug</option> 
                <option>Ladeinfrastruktur</option> 
                <option>Geak Plus</option> 
                <option>Energieanalyse</option>
                <option>WKK</option> 
                <option>Biogasanlage</option> 
                <option>Sonstige</option> 
                <option>Total</option> 
            </select>

            


            </select>
        </form>
            <br>
            <div class="chart" id="pieChart_div"></div>
            <div class="chart" id="pieCharttwo_div" ></div>
        
        <?php
        $gemeinde = ($_GET['Gemeinden']);
        $jahr = ($_GET['Jahr']);
        $jahr2 = ($_GET['Jahr2']);
        $attribute = ($_GET['attribute']);
        ?>
        <script>
            var jsgemeinde = <?php echo json_encode($gemeinde); ?>;
            var jsjahr = <?php echo json_encode($jahr); ?>;
            var jsattribut = <?php echo json_encode($attribute); ?>;
            var jsjahr2 = <?php echo json_encode($jahr2); ?>;

        </script>

        <script type="text/javascript">
            var gemeindeId = 0;
            var gemeinden2 = ["Aadorf", "Affeltrangen", "Altnau", "Amlikon-Bissegg", "Amriswil", "Arbon", "Basadingen-Schlattingen", "Berg (TG)", "Berlingen", "Bettwiesen", "Bichelsee-Balterswil", "Birwinken", "Bischofszell", "Bottighofen", "Braunau", "Bürglen (TG)", "Bussnang", "Diessenhofen", "Dozwil", "Egnach", "Erlen", "Ermatingen", "Eschenz", "Eschlikon", "Felben-Wellhausen", "Fischingen", "Frauenfeld", "Gachnang", "Gottlieben", "Güttingen", "Hauptwil-Gottshaus", "Hefenhofen", "Herdern", "Hohentannen", "Homburg", "Horn", "Hüttlingen", "Hüttwilen", "Kemmental", "Kesswil", "Kradolf-Schönenberg", "Kreuzlingen", "Langrickenbach", "Lengwil", "Lommis", "Mammern", "Märstetten", "Matzingen", "Müllheim", "Münchwilen (TG)", "Münsterlingen", "Neunforn", "Pfyn", "Raperswilen", "Rickenbach (TG)", "Roggwil (TG)", "Romanshorn", "Salenstein", "Salmsach", "Schlatt (TG)", "Schönholzerswilen", "Sirnach", "Sommeri", "Steckborn", "Stettfurt", "Sulgen", "Tägerwilen", "Thundorf", "Tobel-Tägerschen", "Uesslingen-Buch", "Uttwil", "Wagenhausen", "Wäldi", "Wängi", "Warth-Weiningen", "Weinfelden", "Wigoltingen", "Wilen (TG)", "Wuppenau", "Zihlschlacht-Sitterdorf"];
            var gem_nummer2 = ["4551", "4711", "4641", "4881", "4461", "4401", "4536", "4891", "4801", "4716", "4721", "4901", "4471", "4643", "4723", "4911", "4921", "4545", "4406", "4411", "4476", "4646", "4806", "4724", "4561", "4726", "4566", "4571", "4651", "4656", "4486", "4416", "4811", "4495", "4816", "4421", "4590", "4821", "4666", "4426", "4501", "4671", "4681", "4683", "4741", "4826", "4941", "4591", "4831", "4746", "4691", "4601", "4841", "4846", "4751", "4431", "4436", "4851", "4441", "4546", "4756", "4761", "4446", "4864", "4606", "4506", "4696", "4611", "4776", "4616", "4451", "4871", "4701", "4781", "4621", "4946", "4951", "4786", "4791", "4511"];
            var gem2 = jsgemeinde;
            var temp2 = 0;
            for (var i2 = 0; i2 < gemeinden2.length; i2++) {
                if (gem2 == gemeinden2[i2]) {
                    temp2 = i2;
                    
                }
            }
            var gemeindeNummer2 = gem_nummer2[temp2];
          
            for (var a2 = 0; a2 < jsarray.length; a2++) {
                if (gemeindeNummer2 == jsarray[a2][1]) {
                    if (jsjahr == jsarray[a2][0]) {
                        gemeindeId = a2;
                        break;
                    }
                }
            }
            var attributsId = 6;
            
            if (jsattribut == null){
                
                jsattribut = "Gebäudehülle";
            }
            if (jsjahr2 == null){
                jsjahr2 = 2008;
            }
                        
            if (jsgemeinde == null){
                
                jsgemeinde = "Aadorf";
            }
            if (jsjahr == null){
                jsjahr = 2008;
            }
            
            
            var attributsarray = ["Gebäudehülle","Geak Sanierung","Minergie Sanierung", "Minergie Neubau", "Holz bis 70", "Holz ab 70", "Wärmepumpe", "Wärmenetzanschluss","Wärmenetzprojekt", "Solarthermieanlage", "Solarstromanlage", "Batteriespeicher", "Energieeffizienz","Komfortlüftung", "Elektrofahrzeug", "Ladeinfrastruktur", "Geak Plus", "Energieanalyse","WKK", "Biogasanlage", "Sonstige","Total"];
    
    

            var temparray = [];

                    for(var b = 0; b < 25; b++){
                        if(jsattribut == attributsarray[b]){
                            attributsId = b+3;
                        }
                    }

            
            for (var a = 0; a < jsarray.length; a++) {
                
                if (jsjahr2 == jsarray[a][0]) {
                    if (jsarray[a][1] == 4551) {
                        temparray[0] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4711) {
                        temparray[1] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4641) {
                        temparray[2] = jsarray[a][attributsId];
                    }
                    else if(jsarray[a][1] == 4881) {
                        temparray[3] = jsarray[a][attributsId];
                    }
                    else if(jsarray[a][1] == 4461) {
                        temparray[4] = jsarray[a][attributsId];
                    }
                    else if(jsarray[a][1] == 4401) {
                        temparray[5] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4536) {
                        temparray[6] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4891) {
                        temparray[7] = jsarray[a][attributsId];
                    } 
                    else if (jsarray[a][1] == 4801) {
                        temparray[8] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4716) {
                        temparray[9] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4721) {
                        temparray[10] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4901) {
                        temparray[11] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4471) {
                        temparray[12] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4643) {
                        temparray[13] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4723) {
                        temparray[14] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4911) {
                        temparray[15] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4921) {
                        temparray[16] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4545) {
                        temparray[17] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4406) {
                        temparray[18] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4411) {
                        temparray[19] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4476) {
                        temparray[20] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4646) {
                        temparray[21] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4806) {
                        temparray[22] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4724) {
                        temparray[23] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4561) {
                        temparray[24] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4726) {
                        temparray[25] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4566) {
                        temparray[26] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4571) {
                        temparray[27] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4651) {
                        temparray[28] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4656) {
                        temparray[29] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4486) {
                        temparray[30] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4416) {
                        temparray[31] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4811) {
                        temparray[32] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4495) {
                        temparray[33] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4816) {
                        temparray[34] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4421) {
                        temparray[35] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4590) {
                        temparray[36] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4821) {
                        temparray[37] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4666) {
                        temparray[38] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4426) {
                        temparray[39] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4501) {
                        temparray[40] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4671) {
                        temparray[41] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4681) {
                        temparray[42] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4683) {
                        temparray[43] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4741) {
                        temparray[44] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4826) {
                        temparray[45] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4941) {
                        temparray[46] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4591) {
                        temparray[47] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4831) {
                        temparray[48] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4746) {
                        temparray[49] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4691) {
                        temparray[50] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4601) {
                        temparray[51] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4841) {
                        temparray[52] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4846) {
                        temparray[53] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4751) {
                        temparray[54] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4431) {
                        temparray[55] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4436) {
                        temparray[56] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4851) {
                        temparray[57] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4441) {
                        temparray[58] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4546) {
                        temparray[59] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4756) {
                        temparray[60] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4761) {
                        temparray[61] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4446) {
                        temparray[62] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4864) {
                        temparray[63] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4606) {
                        temparray[64] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4506) {
                        temparray[65] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4696) {
                        temparray[66] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4611) {
                        temparray[67] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4776) {
                        temparray[68] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4616) {
                        temparray[69] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4451) {
                        temparray[70] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4871) {
                        temparray[71] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4701) {
                        temparray[72] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4781) {
                        temparray[73] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4621) {
                        temparray[74] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4946) {
                        temparray[75] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4951) {
                        temparray[76] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4786) {
                        temparray[77] = jsarray[a][attributsId];
                    }
                    else if (jsarray[a][1] == 4791) {
                        temparray[78] = jsarray[a][attributsId];
                    }
                    else {
                        temparray[79] = jsarray[a][attributsId];
                    }
                }
            }

            

            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages': ['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawPieChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawPieChart() {

                // Create the data table.
                var data2 = new google.visualization.DataTable();

                data2.addColumn('string', 'Topping');
                data2.addColumn('number', 'Slices');
                data2.addRows([
                    ['Gebäudehülle', jsarray[gemeindeId][3]],
                    ['Geak Sanierung', jsarray[gemeindeId][4]],
                    ['Minergie Sanierung', jsarray[gemeindeId][5]],
                    ['Minergie Neubau', jsarray[gemeindeId][6]],
                    ['Holz bis 70', jsarray[gemeindeId][7]],
                    ['Holz ab 70', jsarray[gemeindeId][8]],
                    ['Wärmepumpe', jsarray[gemeindeId][9]],
                    ['Wärmenetzanschluss', jsarray[gemeindeId][10]],
                    ['Wärmenetzprojekt', jsarray[gemeindeId][11]],
                    ['Solarthermieanlage', jsarray[gemeindeId][12]],
                    ['Solarstromanlage', jsarray[gemeindeId][13]],
                    ['Batteriespeicher', jsarray[gemeindeId][14]],
                    ['Energieeffizienz', jsarray[gemeindeId][15]],
                    ['Komfortlüftung', jsarray[gemeindeId][16]],
                    ['Elektrofahrzeug', jsarray[gemeindeId][17]],
                    ['Ladeinfrastruktur', jsarray[gemeindeId][18]],
                    ['Geak Plus', jsarray[gemeindeId][19]],
                    ['Energieanalyse', jsarray[gemeindeId][20]],
                    ['WKK', jsarray[gemeindeId][21]],
                    ['Biogasanlage', jsarray[gemeindeId][22]],
                    ['Sonstige', jsarray[gemeindeId][23]]
                ]);
                var datatwo = new google.visualization.DataTable();
                datatwo.addColumn('string', 'Topping');
                datatwo.addColumn('number', 'Slices');
                datatwo.addRows([
                    
                    ['Aadorf', temparray[0]], 
                    ['Affeltrangen', temparray[1]], 
                    ['Altnau', temparray[2]], 
                    ['Amlikon-Bissegg', temparray[3]], 
                    ['Amriswil', temparray[4]], 
                    ['Arbon', temparray[5]], 
                    ['Basadingen-Schlattingen', temparray[6]],
                    ['Berg (TG)', temparray[7]], 
                    ['Berlingen',temparray[8]], ['Bettwiesen', temparray[9]],
                    ['Bichelsee-Balterswil', temparray[10]], 
                    ['Birwinken', temparray[11]], 
                    ['Bischofszell', temparray[12]], 
                    ['Bottighofen', temparray[13]], 
                    ['Braunau', temparray[14]], 
                    ['Bürglen (TG)', temparray[15]], 
                    ['Bussnang', temparray[16]], 
                    ['Diessenhofen', temparray[17]],
                    ['Dozwil', temparray[18]], 
                    ['Egnach', temparray[19]],
                    ['Erlen', temparray[20]], 
                    ['Ermatingen', temparray[21]], 
                    ['Eschenz', temparray[22]], ['Eschlikon', temparray[23]], ['Felben-Wellhausen', temparray[24]], ['Fischingen', temparray[25]], ['Frauenfeld', temparray[26]], ['Gachnang', temparray[27]], ['Gottlieben', temparray[28]], ['Güttingen', temparray[29]], ['Hauptwil-Gottshaus', temparray[30]], ['Hefenhofen', temparray[31]], ['Herdern', temparray[32]], ['Hohentannen', temparray[33]], ['Homburg', temparray[34]], ['Horn', temparray[35]], ['Hüttlingen', temparray[36]], ['Hüttwilen', temparray[37]], ['Kemmental', temparray[38]], ['Kesswil', temparray[39]], ['Kradolf-Schönenberg', temparray[40]], ['Kreuzlingen', temparray[41]], ['Langrickenbach', temparray[42]], ['Lengwil', temparray[43]], ['Lommis', temparray[44]], ['Mammern', temparray[45]], ['Märstetten', temparray[46]], ['Matzingen', temparray[47]], ['Müllheim', temparray[48]], ['Münchwilen (TG)', temparray[49]], ['Münsterlingen', temparray[50]], ['Neunforn', temparray[51]], ['Pfyn', temparray[52]], ['Raperswilen', temparray[53]], ['Rickenbach (TG)', temparray[54]], ['Roggwil (TG)', temparray[55]], ['Romanshorn', temparray[56]], ['Salenstein', temparray[57]], ['Salmsach', temparray[58]], ['Schlatt (TG)', temparray[59]], ['Schönholzerswilen', temparray[60]], ['Sirnach', temparray[61]], ['Sommeri', temparray[62]], ['Steckborn', temparray[63]], ['Stettfurt', temparray[64]], ['Sulgen', temparray[65]], ['Tägerwilen', temparray[66]], ['Thundorf', temparray[67]], ['Tobel-Tägerschen', temparray[68]], ['Uesslingen-Buch', temparray[69]], ['Uttwil', temparray[70]], ['Wagenhausen', temparray[71]], ['Wäldi', temparray[72]], ['Wängi', temparray[73]], ['Warth-Weiningen', temparray[74]], ['Weinfelden', temparray[75]], ['Wigoltingen', temparray[76]], ['Wilen (TG)', temparray[77]], ['Wuppenau', temparray[78]], ['Zihlschlacht-Sitterdorf', temparray[79]]
                ]);

                var options2 = {'title': jsgemeinde +" im Jahr " +jsjahr,
                    'width': 700,
                    'height': 350,
                    is2D: true
                };
                var options3 = {'title': attributsarray[attributsId-3] + " im Jahr " + jsjahr2,
                    'width': 700,
                    'height': 350,
                    is2D: true
                };

                // Instantiate and draw our chart, passing in some options.
                var chart2 = new google.visualization.PieChart(document.getElementById('pieChart_div'));
//                var charttwo = new google.visualization.PieChart(document.getElementById('pieCharttwo_div'));
                chart2.draw(data2, options2);
//                charttwo.draw(data, options);
                var charttwo = new google.visualization.PieChart(document.getElementById('pieCharttwo_div'));
                charttwo.draw(datatwo, options3);

            }

        </script>
        
        
        <br><br><br><br><br><br><br><br><br><br><a id="form2"></a><br><br><br><br>
        
        
        <div class="dropdown">
        
        <form method="GET" action="#form2">
                <select id="gemeinde_graph" name="Gemeinden_graph">
                    <option>Aadorf
                    </option>
                    <option>Affeltrangen
                    </option>
                    <option>Altnau
                    </option>
                    <option>Amlikon-Bissegg
                    </option>
                    <option>Amriswil
                    </option>
                    <option>Arbon
                    </option>
                    <option>Basadingen-Schlattingen
                    </option>
                    <option>Berg (TG)
                    </option>
                    <option>Berlingen
                    </option>
                    <option>Bettwiesen
                    </option>
                    <option>Bichelsee-Balterswil
                    </option>
                    <option>Birwinken
                    </option>
                    <option>Bischofszell
                    </option>
                    <option>Bottighofen
                    </option>
                    <option>Braunau
                    </option>
                    <option>Bürglen (TG)
                    </option>
                    <option>Bussnang
                    </option>
                    <option>Diessenhofen
                    </option>
                    <option>Dozwil
                    </option>
                    <option>Egnach
                    </option>
                    <option>Erlen
                    </option>
                    <option>Ermatingen
                    </option>
                    <option>Eschenz
                    </option>
                    <option>Eschlikon
                    </option>
                    <option>Felben-Wellhausen
                    </option>
                    <option>Fischingen
                    </option>
                    <option>Frauenfeld
                    </option>
                    <option>Gachnang
                    </option>
                    <option>Gottlieben
                    </option>
                    <option>Güttingen
                    </option>
                    <option>Hauptwil-Gottshaus
                    </option>
                    <option>Hefenhofen
                    </option>
                    <option>Herdern
                    </option>
                    <option>Hohentannen
                    </option>
                    <option>Homburg
                    </option>
                    <option>Horn
                    </option>
                    <option>Hüttlingen
                    </option>
                    <option>Hüttwilen
                    </option>
                    <option>Kemmental
                    </option>
                    <option>Kesswil
                    </option>
                    <option>Kradolf-Schönenberg
                    </option>
                    <option>Kreuzlingen
                    </option>
                    <option>Langrickenbach
                    </option>
                    <option>Lengwil
                    </option>
                    <option>Lommis
                    </option>
                    <option>Mammern
                    </option>
                    <option>Märstetten
                    </option>
                    <option>Matzingen
                    </option>
                    <option>Müllheim
                    </option>
                    <option>Münchwilen (TG)
                    </option>
                    <option>Münsterlingen
                    </option>
                    <option>Neunforn
                    </option>
                    <option>Pfyn
                    </option>
                    <option>Raperswilen
                    </option>
                    <option>Rickenbach (TG)
                    </option>
                    <option>Roggwil (TG)
                    </option>
                    <option>Romanshorn
                    </option>
                    <option>Salenstein
                    </option>
                    <option>Salmsach
                    </option>
                    <option>Schlatt (TG)
                    </option>
                    <option>Schönholzerswilen
                    </option>
                    <option>Sirnach
                    </option>
                    <option>Sommeri
                    </option>
                    <option>Steckborn
                    </option>
                    <option>Stettfurt
                    </option>
                    <option>Sulgen
                    </option>
                    <option>Tägerwilen
                    </option>
                    <option>Thundorf
                    </option>
                    <option>Tobel-Tägerschen
                    </option>
                    <option>Uesslingen-Buch
                    </option>
                    <option>Uttwil
                    </option>
                    <option>Wagenhausen
                    </option>
                    <option>Wäldi
                    </option>
                    <option>Wängi
                    </option>
                    <option>Warth-Weiningen
                    </option>
                    <option>Weinfelden
                    </option>
                    <option>Wigoltingen
                    </option>
                    <option>Wilen (TG)
                    </option>
                    <option>Wuppenau
                    </option>
                    <option>Zihlschlacht-Sitterdorf
                    </option>
                </select>
            
            <select id="gemeinde_graph" name="Gemeinden_graph2">
                    <option>Aadorf
                    </option>
                    <option>Affeltrangen
                    </option>
                    <option>Altnau
                    </option>
                    <option>Amlikon-Bissegg
                    </option>
                    <option>Amriswil
                    </option>
                    <option>Arbon
                    </option>
                    <option>Basadingen-Schlattingen
                    </option>
                    <option>Berg (TG)
                    </option>
                    <option>Berlingen
                    </option>
                    <option>Bettwiesen
                    </option>
                    <option>Bichelsee-Balterswil
                    </option>
                    <option>Birwinken
                    </option>
                    <option>Bischofszell
                    </option>
                    <option>Bottighofen
                    </option>
                    <option>Braunau
                    </option>
                    <option>Bürglen (TG)
                    </option>
                    <option>Bussnang
                    </option>
                    <option>Diessenhofen
                    </option>
                    <option>Dozwil
                    </option>
                    <option>Egnach
                    </option>
                    <option>Erlen
                    </option>
                    <option>Ermatingen
                    </option>
                    <option>Eschenz
                    </option>
                    <option>Eschlikon
                    </option>
                    <option>Felben-Wellhausen
                    </option>
                    <option>Fischingen
                    </option>
                    <option>Frauenfeld
                    </option>
                    <option>Gachnang
                    </option>
                    <option>Gottlieben
                    </option>
                    <option>Güttingen
                    </option>
                    <option>Hauptwil-Gottshaus
                    </option>
                    <option>Hefenhofen
                    </option>
                    <option>Herdern
                    </option>
                    <option>Hohentannen
                    </option>
                    <option>Homburg
                    </option>
                    <option>Horn
                    </option>
                    <option>Hüttlingen
                    </option>
                    <option>Hüttwilen
                    </option>
                    <option>Kemmental
                    </option>
                    <option>Kesswil
                    </option>
                    <option>Kradolf-Schönenberg
                    </option>
                    <option>Kreuzlingen
                    </option>
                    <option>Langrickenbach
                    </option>
                    <option>Lengwil
                    </option>
                    <option>Lommis
                    </option>
                    <option>Mammern
                    </option>
                    <option>Märstetten
                    </option>
                    <option>Matzingen
                    </option>
                    <option>Müllheim
                    </option>
                    <option>Münchwilen (TG)
                    </option>
                    <option>Münsterlingen
                    </option>
                    <option>Neunforn
                    </option>
                    <option>Pfyn
                    </option>
                    <option>Raperswilen
                    </option>
                    <option>Rickenbach (TG)
                    </option>
                    <option>Roggwil (TG)
                    </option>
                    <option>Romanshorn
                    </option>
                    <option>Salenstein
                    </option>
                    <option>Salmsach
                    </option>
                    <option>Schlatt (TG)
                    </option>
                    <option>Schönholzerswilen
                    </option>
                    <option>Sirnach
                    </option>
                    <option>Sommeri
                    </option>
                    <option>Steckborn
                    </option>
                    <option>Stettfurt
                    </option>
                    <option>Sulgen
                    </option>
                    <option>Tägerwilen
                    </option>
                    <option>Thundorf
                    </option>
                    <option>Tobel-Tägerschen
                    </option>
                    <option>Uesslingen-Buch
                    </option>
                    <option>Uttwil
                    </option>
                    <option>Wagenhausen
                    </option>
                    <option>Wäldi
                    </option>
                    <option>Wängi
                    </option>
                    <option>Warth-Weiningen
                    </option>
                    <option>Weinfelden
                    </option>
                    <option>Wigoltingen
                    </option>
                    <option>Wilen (TG)
                    </option>
                    <option>Wuppenau
                    </option>
                    <option>Zihlschlacht-Sitterdorf
                    </option>
                </select>
            
            <select id="gemeinde_graph" name="Gemeinden_graph3">
                    <option>Aadorf
                    </option>
                    <option>Affeltrangen
                    </option>
                    <option>Altnau
                    </option>
                    <option>Amlikon-Bissegg
                    </option>
                    <option>Amriswil
                    </option>
                    <option>Arbon
                    </option>
                    <option>Basadingen-Schlattingen
                    </option>
                    <option>Berg (TG)
                    </option>
                    <option>Berlingen
                    </option>
                    <option>Bettwiesen
                    </option>
                    <option>Bichelsee-Balterswil
                    </option>
                    <option>Birwinken
                    </option>
                    <option>Bischofszell
                    </option>
                    <option>Bottighofen
                    </option>
                    <option>Braunau
                    </option>
                    <option>Bürglen (TG)
                    </option>
                    <option>Bussnang
                    </option>
                    <option>Diessenhofen
                    </option>
                    <option>Dozwil
                    </option>
                    <option>Egnach
                    </option>
                    <option>Erlen
                    </option>
                    <option>Ermatingen
                    </option>
                    <option>Eschenz
                    </option>
                    <option>Eschlikon
                    </option>
                    <option>Felben-Wellhausen
                    </option>
                    <option>Fischingen
                    </option>
                    <option>Frauenfeld
                    </option>
                    <option>Gachnang
                    </option>
                    <option>Gottlieben
                    </option>
                    <option>Güttingen
                    </option>
                    <option>Hauptwil-Gottshaus
                    </option>
                    <option>Hefenhofen
                    </option>
                    <option>Herdern
                    </option>
                    <option>Hohentannen
                    </option>
                    <option>Homburg
                    </option>
                    <option>Horn
                    </option>
                    <option>Hüttlingen
                    </option>
                    <option>Hüttwilen
                    </option>
                    <option>Kemmental
                    </option>
                    <option>Kesswil
                    </option>
                    <option>Kradolf-Schönenberg
                    </option>
                    <option>Kreuzlingen
                    </option>
                    <option>Langrickenbach
                    </option>
                    <option>Lengwil
                    </option>
                    <option>Lommis
                    </option>
                    <option>Mammern
                    </option>
                    <option>Märstetten
                    </option>
                    <option>Matzingen
                    </option>
                    <option>Müllheim
                    </option>
                    <option>Münchwilen (TG)
                    </option>
                    <option>Münsterlingen
                    </option>
                    <option>Neunforn
                    </option>
                    <option>Pfyn
                    </option>
                    <option>Raperswilen
                    </option>
                    <option>Rickenbach (TG)
                    </option>
                    <option>Roggwil (TG)
                    </option>
                    <option>Romanshorn
                    </option>
                    <option>Salenstein
                    </option>
                    <option>Salmsach
                    </option>
                    <option>Schlatt (TG)
                    </option>
                    <option>Schönholzerswilen
                    </option>
                    <option>Sirnach
                    </option>
                    <option>Sommeri
                    </option>
                    <option>Steckborn
                    </option>
                    <option>Stettfurt
                    </option>
                    <option>Sulgen
                    </option>
                    <option>Tägerwilen
                    </option>
                    <option>Thundorf
                    </option>
                    <option>Tobel-Tägerschen
                    </option>
                    <option>Uesslingen-Buch
                    </option>
                    <option>Uttwil
                    </option>
                    <option>Wagenhausen
                    </option>
                    <option>Wäldi
                    </option>
                    <option>Wängi
                    </option>
                    <option>Warth-Weiningen
                    </option>
                    <option>Weinfelden
                    </option>
                    <option>Wigoltingen
                    </option>
                    <option>Wilen (TG)
                    </option>
                    <option>Wuppenau
                    </option>
                    <option>Zihlschlacht-Sitterdorf
                    </option>
                </select>
        
                <input class="button_chart" type="submit" value="Bestätigen"/>
            </form>
            </div>
            <br>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([

            </script>
        
           
        <?php
        $gemeinde_graph = ($_GET['Gemeinden_graph']);
        $gemeinde_graph2 = ($_GET['Gemeinden_graph2']);
        $gemeinde_graph3 = ($_GET['Gemeinden_graph3']);
        ?>
        <script>
            var jsgemeinde_graph = <?php echo json_encode($gemeinde_graph); ?>;
            var jsgemeinde_graph2 = <?php echo json_encode($gemeinde_graph2); ?>;
            var jsgemeinde_graph3 = <?php echo json_encode($gemeinde_graph3); ?>;
        </script>

        
        
        
        
        


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          
            
    
            var gemeinden3 = ["Aadorf", "Affeltrangen", "Altnau", "Amlikon-Bissegg", "Amriswil", "Arbon", "Basadingen-Schlattingen", "Berg (TG)", "Berlingen", "Bettwiesen", "Bichelsee-Balterswil", "Birwinken", "Bischofszell", "Bottighofen", "Braunau", "Bürglen (TG)", "Bussnang", "Diessenhofen", "Dozwil", "Egnach", "Erlen", "Ermatingen", "Eschenz", "Eschlikon", "Felben-Wellhausen", "Fischingen", "Frauenfeld", "Gachnang", "Gottlieben", "Güttingen", "Hauptwil-Gottshaus", "Hefenhofen", "Herdern", "Hohentannen", "Homburg", "Horn", "Hüttlingen", "Hüttwilen", "Kemmental", "Kesswil", "Kradolf-Schönenberg", "Kreuzlingen", "Langrickenbach", "Lengwil", "Lommis", "Mammern", "Märstetten", "Matzingen", "Müllheim", "Münchwilen (TG)", "Münsterlingen", "Neunforn", "Pfyn", "Raperswilen", "Rickenbach (TG)", "Roggwil (TG)", "Romanshorn", "Salenstein", "Salmsach", "Schlatt (TG)", "Schönholzerswilen", "Sirnach", "Sommeri", "Steckborn", "Stettfurt", "Sulgen", "Tägerwilen", "Thundorf", "Tobel-Tägerschen", "Uesslingen-Buch", "Uttwil", "Wagenhausen", "Wäldi", "Wängi", "Warth-Weiningen", "Weinfelden", "Wigoltingen", "Wilen (TG)", "Wuppenau", "Zihlschlacht-Sitterdorf"];
            
            var gem3 = jsgemeinde_graph;
            var temp3 = 0;
            for (var i2 = 0; i2 < gemeinden3.length; i2++) {
                if (gem3 == gemeinden3[i2]) {
                    temp3 = i2;
                }
            }
            
            var gem4 = jsgemeinde_graph2;
            var temp4 = 0;
            for (var i2 = 0; i2 < gemeinden3.length; i2++) {
                if (gem4 == gemeinden3[i2]) {
                    temp4 = i2;
                }
            }
            
            var gem5 = jsgemeinde_graph3;
            var temp5 = 0;
            for (var i2 = 0; i2 < gemeinden3.length; i2++) {
                if (gem5 == gemeinden3[i2]) {
                    temp5 = i2;
                }
            }
            
            var start_index = temp3 * 13;
            var start_index2 = temp4 * 13;
            var start_index3 = temp5 * 13;

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Year', gemeinden3[temp3], gemeinden3[temp4], gemeinden3[temp5]],
              ['2008',  parseInt(totale_daten[start_index]), parseInt(totale_daten[start_index2]), parseInt(totale_daten[start_index3])],
              ['2009',  parseInt(totale_daten[start_index+1]), parseInt(totale_daten[start_index2+1]), parseInt(totale_daten[start_index3+1])],
              ['2011',  parseInt(totale_daten[start_index+2]), parseInt(totale_daten[start_index2+2]), parseInt(totale_daten[start_index3+2])],
              ['2012',  parseInt(totale_daten[start_index+3]), parseInt(totale_daten[start_index2+3]), parseInt(totale_daten[start_index3+3])],
              ['2013',  parseInt(totale_daten[start_index+4]), parseInt(totale_daten[start_index2+4]), parseInt(totale_daten[start_index3+4])],
              ['2014',  parseInt(totale_daten[start_index+5]), parseInt(totale_daten[start_index2+5]), parseInt(totale_daten[start_index3+5])],
              ['2015',  parseInt(totale_daten[start_index+6]), parseInt(totale_daten[start_index2+6]), parseInt(totale_daten[start_index3+6])],
              ['2016',  parseInt(totale_daten[start_index+7]), parseInt(totale_daten[start_index2+7]), parseInt(totale_daten[start_index3+7])],
              ['2017',  parseInt(totale_daten[start_index+8]), parseInt(totale_daten[start_index2+8]), parseInt(totale_daten[start_index3+8])],
              ['2018',  parseInt(totale_daten[start_index+9]), parseInt(totale_daten[start_index2+9]), parseInt(totale_daten[start_index3+9])],
              ['2019',  parseInt(totale_daten[start_index+10]), parseInt(totale_daten[start_index2+10]), parseInt(totale_daten[start_index3+10])],
              ['2020',  parseInt(totale_daten[start_index+11]), parseInt(totale_daten[start_index2+11]), parseInt(totale_daten[start_index3+11])],
              
            ]);

            var options = {
              title: 'Energieförderprojekte',
              hAxis: {title: 'Jahre',  titleTextStyle: {color: 'gray'}},
              vAxis: {minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
         <body>
            <div id="chart_div" style="width: 100%; height: 500px;"></div>
        </body>
        <br><br><br><br><br><br><br>
        <footer>
        
        <p><a href="https://opendata.swiss/de/dataset/energieforderprogramm-im-kanton-thurgau-umgesetzte-projekte-in-den-thurgauer-gemeinden"><img src="img/swissdata.png" width="400" height="100"/></a></p>
    </footer>
    </main>
    



<!-- Custom file -->
<script src="js/myscripts.js"></script>

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>


<!-- Icons from ionic -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</body>

</html>

