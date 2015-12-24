<?php
/**
 * User: Awan Tengah
 * Date: 24/12/2015
 * Time: 19:28
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        .box {
            width: 900px;
            margin: 0 auto;
        }
        .box-child {
            display: inline-table;
            margin-left: 1rem;
        }

        .box-form {
            padding: 0.5rem;
            margin: 0.5rem;
        }

        .box-form input, select {
            display: block;
            width: 100%;
            height: 30px;
        }
    </style>
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>
<div class="box">
    <div class="box-child">
        <h1>Aplikasi cek ongkir sederhana</h1>
        <fieldset>
            <div class="box-form">
                <label>Provinsi Asal
                    <select name="province_origin" id="province_origin" class="all_province" onchange="get_city_origin(this);">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Kota/Kabupaten Asal
                    <select name="city_origin" id="city_origin">
                        <option value="">Pilih Kota</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Provinsi Tujuan
                    <select name="province_destination" id="province_destination" class="all_province" onchange="get_city_destination(this);">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Kota/Kabupaten Tujuan
                    <select name="city_destination" id="city_destination">
                        <option value="">Pilih Kota</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <label>Berat (gram)
                    <input type="number" name="weight" id="weight" placeholder="Berat (gram)">
                </label>
            </div>
            <div class="box-form">
                <label>Kurir
                    <select name="courier" id="courier">
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS</option>
                    </select>
                </label>
            </div>
            <div class="box-form">
                <input type="submit" value="Submit" onclick="get_cost(city_origin.value, city_destination.value, weight.value, courier.value);">
            </div>
        </fieldset>
    </div>
    <div class="box-child">
        <h2>Biaya:</h2>
        <table border="1">
            <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Biaya</th>
                <th>Estimasi</th>
                <th>Catatan</th>
            </tr>
            </thead>
            <tbody id="detail">

            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.getJSON("province.php", function (all_province) {
            if (all_province) {
                $(".all_province").html("<option value=''>Pilih Provinsi</option>");
                $.each(all_province['rajaongkir']['results'], function (key, value) {
                    $(".all_province").append(
                        "<option value='" + value.province_id + "'>" + value.province + "</option>"
                    );
                });
            }
        });
    });

    function get_city_origin(sel) {
        $.getJSON("city.php?id=" + sel.value, function (get_city) {
            if (get_city) {
                $("#city_origin").html("<option value=''>Pilih Kota</option>");
                $.each(get_city['rajaongkir']['results'], function (key, value) {
                    $("#city_origin").append(
                        "<option value='" + value.city_id + "'>" + value.type + " - " + value.city_name + "</option>"
                    );
                });
            }
        });
    }

    function get_city_destination(sel) {
        $.getJSON("city.php?id=" + sel.value, function (get_city) {
            if (get_city) {
                $("#city_destination").html("<option value=''>Pilih Kota</option>");
                $.each(get_city['rajaongkir']['results'], function (key, value) {
                    $("#city_destination").append(
                        "<option value='" + value.city_id + "'>" + value.type + " - " + value.city_name + "</option>"
                    );
                });
            }
        });
    }

    function get_cost(city_origin, city_destination, weight, courier) {
        if(city_origin != '' && city_destination != '' && weight != '' && courier != '') {
            $.getJSON("cost.php?city_origin=" + city_origin + "&city_destination=" + city_destination + "&weight=" + weight + "&courier=" + courier, function (cost) {
                if(cost) {
                    $.each(cost['rajaongkir']['results'], function (key, value) {
                        $("#cost").append(
                            "<strong>" + value.name + "</strong>"
                        );
                    });
                    if(cost['rajaongkir']['results'][0]['costs'].length > 0) {
                        $.each(cost['rajaongkir']['results'][0]['costs'], function(key, value) {
                            $("#detail").append(
                                "<tr>" +
                                "<td>" + value.service + "</td>" +
                                "<td>" + value.description + "</td>" +
                                "<td>" + value.cost[0]['value'] + "</td>" +
                                "<td>" + value.cost[0]['etd'] + "</td>" +
                                "<td>" + value.cost[0]['note'] + "</td>" +
                                "</tr>"
                            );
                        });
                    }
                }
            });
        }
    }

</script>
</body>
</html>